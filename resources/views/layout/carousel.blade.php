<div x-data="carousel()" class="relative mt-4 mx-3">
    <div class="overflow-hidden rounded-lg shadow-lg">
        <div class="flex transition-transform duration-700 ease-in-out"
            x-bind:style="'transform: translateX(-' + (currentIndex * (100 / (images.length + 1))) + '%)'">
            <template x-for="(image, index) in images" :key="index">
                <div class="carousel-item w-full flex-shrink-0">
                    <img :src="image.src" :alt="image.alt" class="w-full h-64 object-cover">
                </div>
            </template>
            <template x-if="images.length > 0">
                <div class="carousel-item w-full flex-shrink-0">
                    <img :src="images[0].src" :alt="images[0].alt" class="w-full h-64 object-cover">
                </div>
            </template>
        </div>
    </div>
    <div class="flex justify-center mt-2">
        <template x-for="(image, index) in images" :key="index % 4">
            <button @click="goTo(index)" class="w-3 h-3 mx-1 rounded-full"
                :class="currentIndex % 4 === index ? 'bg-blue-600' : 'bg-gray-300'"></button>
        </template>
    </div>
</div>

<script>
    function carousel() {
        return {
            currentIndex: 0,
            images: [
                { src: '{{ asset('/asset/image/18.jpg') }}', alt: 'Image 1' },
                { src: '{{ asset('/asset/image/19.jpg') }}', alt: 'Image 2' },
                { src: '{{ asset('/asset/image/20.jpg') }}', alt: 'Image 3' },
                { src: '{{ asset('/asset/image/21.jpg') }}', alt: 'Image 4' },
            ],
            interval: null,

            init() {
                this.startAutoSwitch();
            },
            startAutoSwitch() {
                this.interval = setInterval(() => {
                    this.next();
                }, 3000);
            },
            next() {
                this.currentIndex++;
                if (this.currentIndex > this.images.length) {
                    images[currentIndex +2] = images[currentIndex % 4]
                    images.shift();
                }
            },
            goTo(index) {
                this.currentIndex = index;
            }
        };
    }
</script>