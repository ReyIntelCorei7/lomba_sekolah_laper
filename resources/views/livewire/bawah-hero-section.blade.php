<div class="bg-white">
    <div 
        x-data="{
            activeSlide: 1,
            init() {
                // Setup observer untuk setiap section gambar
                const sections = this.$el.querySelectorAll('[data-slide-section]');
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const slideNumber = parseInt(entry.target.getAttribute('data-slide-section'));
                            if (!isNaN(slideNumber)) {
                                this.activeSlide = slideNumber;
                            }
                        }
                    });
                }, { threshold: 0.5 });
                
                sections.forEach(section => {
                    observer.observe(section);
                });
            }
        }" 
        class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12"
    >
        <div class="flex flex-col lg:flex-row gap-12">
            
            <div class="w-full lg:w-1/2">
                <div class="lg:sticky lg:top-24 lg:h-[70vh] flex flex-col justify-center">
                    
                    <h2 class="text-4xl font-bold text-gray-900 mb-8">About Our School</h2>

                    <div class="relative min-h-[250px] sm:min-h-[200px]">
                        
                        <!-- Slide 1 -->
                        <div 
                            class="transition-all duration-500 ease-in-out absolute inset-0"
                            :class="activeSlide === 1 ? 'opacity-100 z-10' : 'opacity-0 z-0 pointer-events-none'"
                        >
                            <p class="text-gray-600 text-lg leading-relaxed">
                                <span class="font-bold text-blue-600 text-2xl block mb-2">01. Sejarah</span>
                                <span class="font-bold text-blue-600">SMK Metland</span> didirikan oleh Yayasan Pendidikan Metland (YPM). 
                                Ini adalah awal mula perjalanan kami di kawasan Metland Transyogi Bogor. 
                                Fasilitas kami dirancang untuk standar internasional sejak awal berdiri.
                            </p>
                        </div>

                        <!-- Slide 2 -->
                        <div 
                            class="transition-all duration-500 ease-in-out absolute inset-0"
                            :class="activeSlide === 2 ? 'opacity-100 z-10' : 'opacity-0 z-0 pointer-events-none'"
                        >
                            <p class="text-gray-600 text-lg leading-relaxed">
                                <span class="font-bold text-blue-600 text-2xl block mb-2">02. Pengembangan</span>
                                Keberhasilan pengembangan selama <span class="font-bold text-blue-600">10 tahun</span> 
                                mendorong kami mengembangkan sayap ke kawasan Perumahan Metland Cibitung. 
                                Kami terus berkomitmen mencetak lulusan yang siap kerja dan kompeten.
                            </p>
                        </div>

                        <!-- Slide 3 -->
                        <div 
                            class="transition-all duration-500 ease-in-out absolute inset-0"
                            :class="activeSlide === 3 ? 'opacity-100 z-10' : 'opacity-0 z-0 pointer-events-none'"
                        >
                            <p class="text-gray-600 text-lg leading-relaxed">
                                <span class="font-bold text-blue-600 text-2xl block mb-2">03. Fasilitas Modern</span>
                                Pada tahun 2021, hal ini ditandai dengan didirikannya bangunan sekolah dengan 
                                <span class="font-bold text-blue-600">fasilitas lengkap</span> dan modern. 
                                Gedung bertingkat dengan lapangan olahraga yang memadai menjadi pusat aktivitas siswa kami.
                            </p>
                        </div>

                    </div>
                    
                    <!-- Indicator Dots -->
                    <div class="flex space-x-3 mt-10">
                        <template x-for="i in 3" :key="i">
                            <button 
                                @click="activeSlide = i; 
                                         document.querySelector(`[data-slide-section='${i}']`)?.scrollIntoView({ behavior: 'smooth', block: 'center' });"
                                class="h-2 rounded-full transition-all duration-300 focus:outline-none"
                                :class="activeSlide === i ? 'w-8 bg-blue-600' : 'w-4 bg-gray-200 hover:bg-gray-300'"
                                :aria-label="'Go to slide ' + i"
                            ></button>
                        </template>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/2 flex flex-col space-y-[30vh] lg:space-y-[50vh] pb-24">
                
                <!-- Image 1 -->
                <div 
                    data-slide-section="1"
                    class="min-h-[50vh] flex items-center justify-center"
                >
                    <div class="relative overflow-hidden rounded-3xl shadow-2xl transition-transform duration-300 hover:scale-[1.02] w-full">
                        <img src="{{ asset('image/sekolahsmkmetland.png') }}" alt="Gedung Utama Transyogi" class="w-full h-full object-cover max-h-[500px]">
                        <div class="absolute bottom-0 left-0 bg-gradient-to-t from-black/70 to-transparent text-white p-6 w-full">
                            <p class="font-bold text-xl">Gedung Utama Transyogi</p>
                        </div>
                    </div>
                </div>

                <!-- Image 2 -->
                <div 
                    data-slide-section="2"
                    class="min-h-[50vh] flex items-center justify-center"
                >
                    <div class="relative overflow-hidden rounded-3xl shadow-2xl transition-transform duration-300 hover:scale-[1.02] w-full">
                        <img src="{{ asset('image/sekolahsmkmetland3.png') }}" alt="Ekspansi Cibitung" class="w-full h-full object-cover max-h-[500px]">
                        <div class="absolute bottom-0 left-0 bg-gradient-to-t from-black/70 to-transparent text-white p-6 w-full">
                            <p class="font-bold text-xl">Ekspansi Cibitung</p>
                        </div>
                    </div>
                </div>

                <!-- Image 3 -->
                <div 
                    data-slide-section="3"
                    class="min-h-[50vh] flex items-center justify-center"
                >
                    <div class="relative overflow-hidden rounded-3xl shadow-2xl transition-transform duration-300 hover:scale-[1.02] w-full">
                        <img src="{{ asset('image/sekolahsmkmetland4.png') }}" alt="Fasilitas Olahraga" class="w-full h-full object-cover max-h-[500px]">
                        <div class="absolute bottom-0 left-0 bg-gradient-to-t from-black/70 to-transparent text-white p-6 w-full">
                            <p class="font-bold text-xl">Fasilitas Olahraga</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>