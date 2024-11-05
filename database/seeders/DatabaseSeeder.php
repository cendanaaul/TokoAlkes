<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'name' => 'Admin',
            'email' => 'Admin@gmail.com',
            'password' => bcrypt('123'),
            'notel' => '085815997598',
            'birth' => now(),
            'city' => 'Mojokerto',
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('123'),
            'notel' => '0858159975',
            'birth' => now(),
            'city' => 'Surabaya',
            'role' => 'costumer'
        ]);

        Category::create([
            'name' => 'Alat Diagnostik',
            'desk' => 'Alat-alat yang digunakan untuk mendiagnosis kondisi kesehatan pasien, seperti termometer, tensimeter, glucometer, dan stetoskop.'
        ]);

        Category::create([
            'name' => 'Alat Terapi',
            'desk' => 'Alat-alat yang mendukung perawatan dan pemulihan kesehatan pasien, seperti nebulizer dan alat terapi fisik.'
        ]);

        Category::create([
            'name' => 'Alat Bedah',
            'desk' => 'Peralatan yang digunakan dalam prosedur bedah seperti pisau bedah dan gunting bedah.'
        ]);

        Category::create([
            'name' => 'Alat Kesehatan Rumah Tangga',
            'desk' => 'Alat-alat kesehatan yang dapat digunakan di rumah untuk pemantauan kesehatan dasar, seperti alat cek tekanan darah dan glucometer.'
        ]);

        Category::create([
            'name' => 'Alat Kebersihan Medis',
            'desk' => 'Alat yang digunakan untuk menjaga kebersihan dan sterilisasi dalam lingkungan medis, seperti alat sterilisasi dan desinfektan.'
        ]);

        Category::create([
            'name' => 'Alat Bantu Mobilitas',
            'desk' => 'Alat-alat yang membantu pergerakan pasien, seperti kursi roda dan tongkat bantu jalan.'
        ]);

        Category::create([
            'name' => 'Peralatan Laboratorium Medis',
            'desk' => 'Peralatan yang digunakan dalam laboratorium medis untuk analisis dan penelitian, seperti mikroskop dan centrifuge.'
        ]);

        Category::create([
            'name' => 'Alat Pelindung Diri (APD)',
            'desk' => 'Perlengkapan yang digunakan oleh tenaga medis untuk melindungi diri, seperti masker N95, faceshield, dan pakaian pelindung.'
        ]);

        Category::create([
            'name' => 'Alat Pemantau Pasien',
            'desk' => 'Peralatan untuk pemantauan kondisi vital pasien, seperti monitor jantung dan oksimeter.'
        ]);
    }
}