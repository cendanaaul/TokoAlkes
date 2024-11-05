<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Review;
use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;


class AllController extends Controller
{
    //function for show view login
    public function vlogin()
    {
        return view('login', [
            'header' => 'Login',
        ]);
    }

    //function for show view register
    public function vregister()
    {
        return view('register', [
            'header' => 'Register',
        ]);
    }

    //function for login user
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($data)) {
            $user = Auth::user();

            if ($user->role == 'admin') {
                return redirect()->intended('/users')->with('success', "Hello, Admin $user->name");
            } else {
                return redirect()->intended('/')->with('success', "Hello, Welcome $user->name");
            }
        }
        return back()->with('error', 'Username or Password Wrong!!!');
    }

    public function showACC()
    {
        $user = Auth::user();
        $user->formatted_birth = Carbon::parse($user->birth)->format('d M Y');
        return view('akun.index', compact('user'));
    }

    //function for logout account
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->intended('/login');
    }

    //function for register user
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'city' => 'required',
            'birth' => 'required',
            'notel' => 'required',
            'role' => 'costumer'
        ]);

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->intended('/login')->with('success', 'Registration Was Success Full!!!');

    }

    //function for show view category, and also displays products according to category
    public function category(Category $category)
    {
        return view('category', [
            'header' => $category->name,
            'categories' => $category->product
        ]);
    }

    //function for show view products, which contains all products
    public function products()
    {
        return view('products', [
            'header' => 'Products',
            'categories' => Product::all()
        ]);
    }

    //function for show view product which specific product
    public function product(Product $product)
    {
        $reviews = Review::where("product_id", $product->id)->get();
        return view('product', [
            'header' => $product->title,
            'item' => $product,
            'reviews' => $reviews

        ]);
    }

    //fucntion for show view cart
    public function cart()
    {
        return view('cart', [
            'header' => 'Cart',
            'product' => DetailTransaksi::where('user_id', auth()->id())->with('product')->where('status', 'cart')->get()
        ]);
    }

    //function for add product to cart
    public function postcart(Request $request, Product $product)
    {
        $request->validate([
            'total' => 'required'
        ]);

        DetailTransaksi::create([
            'user_id' => Auth::id(),
            'transaksi_id' => null,
            'product_id' => $product->id,
            'qty' => $request->total,
            'status' => 'cart',
            'totalprice' => $product->price * $request->total
        ]);

        return redirect()->route('cart')->with('success', 'Berhasil Memasukkan ke Keranjang');

    }

    //function for delete product in cart
    public function deletecart(int $id)
    {
        // Menghapus detail transaksi berdasarkan ID
        $deleted = DetailTransaksi::where('id', $id)->delete();

        // Cek apakah penghapusan berhasil
        if ($deleted) {
            return redirect()->route('cart')->with('success', 'Berhasil Dihapus Dari Keranjang');
        } else {
            return redirect()->route('cart')->with('error', 'Gagal Menghapus Dari Keranjang');
        }
    }

    //function for show view checkout item
    public function checkout(DetailTransaksi $detailtransaksi)
    {
        return view('checkout', [
            'header' => 'Checkout',
            'item' => $detailtransaksi
        ]);
    }

    //function for checkout product
    public function postcheckout(Request $request, int $id)
    {
        $request->validate([
            'pembayaran' => 'required'
        ]);
        $detailtransaksi = DetailTransaksi::where('id', $id)->first();

        $transaksi = Transaksi::create([
            'user_id' => auth()->id(),
            'totalprice' => $detailtransaksi->totalprice,
            'code' => 'INV' . Str::random(8),
            'pembayaran' => $request->pembayaran
        ]);

        $detailtransaksi->update([
            'transaksi_id' => $transaksi->id,
            'status' => 'checkout'

        ]);

        $detailtransaksi->save();
        return redirect()->route('summary', $detailtransaksi)->with('success', ' successfully.');
    }

    //function for show view summary
    public function summary()
    {
        return view('summary', [
            'header' => 'Summary',
            'product' => DetailTransaksi::where('user_id', auth()->id())->with('product')->where('status', 'checkout')->get()
        ]);
    }

    //function for show view kelola for admin
    public function kelola(Request $request)
    {
        $search = $request->get('search'); // Mengambil input pencarian
        $products = Product::when($search, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%')
                ->orWhereHas('category', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
        })->paginate(3);
        foreach ($products as $product) {
            $product->sold = DetailTransaksi::where('product_id', $product->id)
                ->where(function ($query) {
                    $query->where('status', 'checkout')
                        ->orWhereHas('transaksi', function ($query) {
                            $query->where('status', 'diterima');
                        });
                })
                ->sum('qty');
            $product->profit = DetailTransaksi::where('product_id', $product->id)
                ->where(function ($query) {
                    $query->where('status', 'checkout')
                        ->orWhereHas('transaksi', function ($query) {
                            $query->where('status', 'diterima');
                        });
                })->sum('totalprice');

        }
        return view('kelola', [
            'header' => 'Kelola',
            'products' => $products
        ]);
    }

    //function for show view add product
    public function tambah()
    {
        return view('tambah', [
            'header' => 'Tambah',
            'category' => Category::all()
        ]);
    }

    //function for add product
    public function posttambah(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|file',
            'price' => 'required|numeric',
            'body' => 'required',
            'category' => 'required'
        ]);

        Product::create([
            'title' => $request->title,
            'image' => $request->file('image')->store('image', 'public') ?? $request->image->store('asset/image', 'public'),
            'price' => $request->price,
            'body' => $request->body,
            'category_id' => $request->category,
        ]);

        return redirect()->route('kelola')->with('success', 'Product Berhasil di Tambahkan');

    }

    //function for delete product
    public function deleteproduct(Product $product)
    {
        $product->delete();
        return redirect()->route('kelola')->with('success', 'Product berhasil di Hapus');

    }

    //function for show view edit product
    public function edit(Product $product)
    {
        return view('edit', [
            'header' => 'Edit',
            'product' => $product,
            'category' => Category::all()
        ]);
    }

    //funtion for edit product
    public function postedit(Request $request, Product $product)
    {
        $data = $request->validate([
            'title' => 'required',
            'image' => 'required|file',
            'price' => 'required|numeric',
            'body' => 'required',
            'category_id' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('asset/image', 'public');
        } else {
            unset($data['image']);
        }

        $product->update($data);

        return redirect()->route('kelola')->with('success', 'Data Product Berhasil Diubah');

    }
    public function categoryIndex()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // Menampilkan form untuk membuat kategori baru
    public function categoryCreate()
    {
        return view('categories.create');
    }

    // Menyimpan kategori baru
    public function categoryPost(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'desk' => 'required|string',
        ]);

        Category::create($request->all());
        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }

    // Menampilkan form untuk mengedit kategori
    public function categoryEdit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    // Mengupdate kategori
    public function categoryUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'desk' => 'required|string',
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }

    // Menghapus kategori
    public function categoryDestroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
    }



    public function store(Request $request, $productId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);
        $checkReview = Review::where('product_id', $productId)->where('user_id', Auth::id())->first();
        if ($checkReview) {
            return redirect()->route('summary', $productId)->with('error', 'You have already reviewed this product.');
        }

        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $productId,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('summary', $productId)->with('success', 'Review added successfully.');
    }


    public function pdf(int $item)
    {
        $items = DetailTransaksi::findOrFail($item);
        $pdf = Pdf::loadView('pdf', ['item' => $items]);


        // Mengirimkan PDF sebagai response download
        return $pdf->download('invoice-order-' . $items->id . '.pdf');

    }

    public function statusShow()
    {
        $transaksi = Transaksi::where('status', 'Pengiriman')->get();
        return view('status.index', compact('transaksi'));
    }

    public function statusEdit(int $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update([
            'status' => 'Diterima',
        ]);
        $transaksi->save();
        return redirect()->route('status.index')->with('success', 'Status Berhasil Diubah');
    }

    public function kelolausers(Request $request)
    {
        // Mendapatkan input pencarian jika ada
        $search = $request->get('search', '');

        // Mengambil data pengguna berdasarkan pencarian
        $users = User::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->paginate(10); // Pagination dengan 10 pengguna per halaman

        // Mengirim data pengguna ke view 'users.index'
        return view('akun.kelola', compact('users'));
    }
}