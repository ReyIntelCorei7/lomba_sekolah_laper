<div id="about" 
     x-data="{
        activeSlide: 1,
        isMobile: window.innerWidth < 1024,
        getSlides() {
            const lang = $store.lang.current;
            return [
                {
                    number: 1,
                    title: lang === 'en' ? '01. History' : '01. Sejarah',
                    keyword: 'SMK Metland',
                    description: lang === 'en' ? 'was established by the Metland Education Foundation (YPM). This is the beginning of our journey in the Metland Transyogi Bogor area. Our facilities were designed to international standards from the very beginning.' : 'didirikan oleh Yayasan Pendidikan Metland (YPM). Ini adalah awal mula perjalanan kami di kawasan Metland Transyogi Bogor. Fasilitas kami dirancang untuk standar internasional sejak awal berdiri.',
                    image: '{{ asset('image/sekolahsmkmetland.png') }}',
                    imageLabel: lang === 'en' ? 'Early History' : 'Sejarah Awal'
                },
                {
                    number: 2,
                    title: lang === 'en' ? '02. Development' : '02. Pengembangan',
                    keyword: lang === 'en' ? '10 years' : '10 tahun',
                    description: lang === 'en' ? 'The success of development over the years drove us to expand our wings to the Metland Cibitung Housing area. We are committed to producing work-ready and competent graduates.' : 'Keberhasilan pengembangan selama mendorong kami mengembangkan sayap ke kawasan Perumahan Metland Cibitung. Kami terus berkomitmen mencetak lulusan yang siap kerja dan kompeten.',
                    image: '{{ asset('image/sekolahsmkmetland3.png') }}',
                    imageLabel: 'SMK Metland School'
                },
                {
                    number: 3,
                    title: lang === 'en' ? '03. Generation of Achievement Love' : '03. Generasi Cinta Prestasi',
                    keyword: lang === 'en' ? 'Love' : 'Cinta',
                    description: lang === 'en' ? 'Making SMK Metland School students a generation that loves achievements - loving good, positive things and being accomplished.' : 'Menjadikan Siswa siswi SMK Metland School sebagai generasi yang cinta akan prestasi - prestasi. akan hal - hal baik, positif dan berprestasi.',
                    image: '{{ asset('image/sekolahsmkmetland4.png') }}',
                    imageLabel: lang === 'en' ? 'Cultural Values' : 'Nilai Budaya'
                }
            ];
        },
        get slides() {
            return this.getSlides();
        },
        init() {
            window.addEventListener('resize', () => {
                this.isMobile = window.innerWidth < 1024;
            });
            
            // Watch for language changes
            window.addEventListener('languageChanged', () => {
                this.$forceUpdate && this.$forceUpdate();
            });
            
            // For desktop: Set up intersection observer
            if (!this.isMobile) {
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
        }
     }"
     class="transition-colors duration-1000 ease-in-out"
     :style="activeSlide === 2 ? 'background-color: #ffffff;' : 'background-color: #1E2188;'">
     
    <!-- MOBILE LAYOUT: Tabbed interface -->
    <div class="lg:hidden max-w-7xl mx-auto px-4 py-12">
        <!-- Title -->
        <h2 class="text-2xl sm:text-3xl font-bold mb-6 text-center transition-colors duration-500"
            :class="activeSlide === 2 ? 'text-gray-900' : 'text-white'"
            x-text="$store.lang.t('about_our_school')">
            About Our School
        </h2>
        
        <!-- Tab Buttons -->
        <div class="flex justify-center gap-2 mb-6">
            <template x-for="slide in slides" :key="slide.number">
                <button @click="activeSlide = slide.number"
                        class="px-3 py-2 rounded-full text-xs sm:text-sm font-medium transition-all duration-300"
                        :class="activeSlide === slide.number 
                            ? (activeSlide === 2 ? 'bg-blue-600 text-white' : 'bg-white text-[#1E2188]') 
                            : (activeSlide === 2 ? 'bg-gray-200 text-gray-600 hover:bg-gray-300' : 'bg-white/20 text-white/80 hover:bg-white/30')"
                        x-text="slide.title.split('. ')[1]">
                </button>
            </template>
        </div>
        
        <!-- Content Area -->
        <div class="relative min-h-[120px] mb-6">
            <template x-for="slide in slides" :key="slide.number">
                <div class="transition-all duration-500 ease-in-out"
                     :class="activeSlide === slide.number ? 'opacity-100' : 'opacity-0 absolute inset-0 pointer-events-none'">
                    <p class="text-base leading-relaxed transition-colors duration-500"
                       :class="activeSlide === 2 ? 'text-gray-600' : 'text-blue-50'">
                        <span class="font-bold text-xl block mb-2 transition-colors duration-500"
                              :class="activeSlide === 2 ? 'text-blue-600' : 'text-white'"
                              x-text="slide.title">
                        </span>
                        <span class="font-bold" :class="activeSlide === 2 ? 'text-blue-600' : 'text-white'" x-text="slide.keyword"></span>
                        <span x-text="slide.description"></span>
                    </p>
                </div>
            </template>
        </div>
        
        <!-- Image -->
        <div class="relative overflow-hidden rounded-2xl shadow-2xl border-4 border-white/20">
            <template x-for="slide in slides" :key="slide.number">
                <div class="transition-all duration-500"
                     :class="activeSlide === slide.number ? 'opacity-100' : 'opacity-0 absolute inset-0'">
                    <img :src="slide.image" class="w-full h-[250px] sm:h-[300px] object-cover">
                    <div class="absolute bottom-0 left-0 bg-gradient-to-t from-black/80 to-transparent text-white p-4 w-full">
                        <p class="font-bold text-lg tracking-wide" x-text="slide.imageLabel"></p>
                    </div>
                </div>
            </template>
        </div>
        
        <!-- Dot Indicators -->
        <div class="flex justify-center gap-2 mt-6">
            <template x-for="slide in slides" :key="slide.number">
                <button @click="activeSlide = slide.number"
                        class="w-2.5 h-2.5 rounded-full transition-all duration-300"
                        :class="activeSlide === slide.number 
                            ? (activeSlide === 2 ? 'bg-blue-600 scale-125' : 'bg-white scale-125') 
                            : (activeSlide === 2 ? 'bg-gray-300' : 'bg-white/30')">
                </button>
            </template>
        </div>
    </div>

    <!-- DESKTOP LAYOUT: Original scroll-based layout -->
    <div class="hidden lg:block max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="flex flex-row gap-12">
            
            <div class="w-1/2">
                <div class="sticky top-32 h-[60vh] flex flex-col justify-center">
                    
                    <h2 class="text-4xl font-bold mb-8 transition-colors duration-500"
                        :class="activeSlide === 2 ? 'text-gray-900' : 'text-white'"
                        x-text="$store.lang.t('about_our_school')">
                        About Our School
                    </h2>

                    <div class="relative min-h-[200px]">
                        
                        <!-- Slide 1 -->
                        <div class="transition-all duration-500 ease-in-out absolute inset-0"
                             :class="activeSlide === 1 ? 'opacity-100 z-10' : 'opacity-0 z-0 pointer-events-none'">
                            <p class="text-lg leading-relaxed transition-colors duration-500"
                               :class="activeSlide === 2 ? 'text-gray-600' : 'text-blue-50'">
                                <span class="font-bold text-2xl block mb-2 transition-colors duration-500"
                                      :class="activeSlide === 2 ? 'text-blue-600' : 'text-white border-l-4 border-white pl-3'"
                                      x-text="$store.lang.current === 'en' ? '01. History' : '01. Sejarah'">
                                      01. Sejarah
                                </span>
                                <span class="font-bold" :class="activeSlide === 2 ? 'text-blue-600' : 'text-white'">SMK Metland</span> 
                                <span x-text="$store.lang.t('about_history_desc')">didirikan oleh Yayasan Pendidikan Metland (YPM). Ini adalah awal mula perjalanan kami di kawasan Metland Transyogi Bogor. Fasilitas kami dirancang untuk standar internasional sejak awal berdiri.</span>
                            </p>
                        </div>

                        <!-- Slide 2 -->
                        <div class="transition-all duration-500 ease-in-out absolute inset-0"
                             :class="activeSlide === 2 ? 'opacity-100 z-10' : 'opacity-0 z-0 pointer-events-none'">
                            <p class="text-lg leading-relaxed transition-colors duration-500"
                               :class="activeSlide === 2 ? 'text-gray-600' : 'text-blue-50'">
                                <span class="font-bold text-2xl block mb-2 transition-colors duration-500"
                                      :class="activeSlide === 2 ? 'text-blue-600' : 'text-white border-l-4 border-white pl-3'"
                                      x-text="$store.lang.current === 'en' ? '02. Development' : '02. Pengembangan'">
                                      02. Pengembangan
                                </span>
                                <span x-text="$store.lang.t('about_development_desc')">Keberhasilan pengembangan selama mendorong kami mengembangkan sayap ke kawasan Perumahan Metland Cibitung. Kami terus berkomitmen mencetak lulusan yang siap kerja dan kompeten.</span>
                            </p>
                        </div>

                        <!-- Slide 3 -->
                        <div class="transition-all duration-500 ease-in-out absolute inset-0"
                             :class="activeSlide === 3 ? 'opacity-100 z-10' : 'opacity-0 z-0 pointer-events-none'">
                            <p class="text-lg leading-relaxed transition-colors duration-500"
                               :class="activeSlide === 2 ? 'text-gray-600' : 'text-blue-50'">
                                <span class="font-bold text-2xl block mb-2 transition-colors duration-500"
                                      :class="activeSlide === 2 ? 'text-blue-600' : 'text-white border-l-4 border-white pl-3'"
                                      x-text="$store.lang.current === 'en' ? '03. Generation of Achievement Love' : '03. Generasi Cinta Prestasi'">
                                    03. Generasi Cinta Prestasi
                                </span>
                                <span x-text="$store.lang.t('about_gcp_desc')">Menjadikan Siswa siswi SMK Metland School sebagai generasi yang cinta akan prestasi - prestasi. akan hal - hal baik, positif dan berprestasi.</span>
                            </p>
                        </div>

                    </div>
                    
                    <!-- Indicator Dots -->
                    <div class="flex space-x-3 mt-10">
                        <template x-for="i in 3" :key="i">
                            <button @click="activeSlide = i; document.querySelector(`[data-slide-section='${i}']`)?.scrollIntoView({ behavior: 'smooth', block: 'center' });"
                                    class="h-2 rounded-full transition-all duration-300 focus:outline-none"
                                    :class="activeSlide === i 
                                        ? (activeSlide === 2 ? 'w-8 bg-blue-600' : 'w-8 bg-white') 
                                        : (activeSlide === 2 ? 'w-4 bg-gray-300 hover:bg-gray-400' : 'w-4 bg-white/30 hover:bg-white/50')"
                                    :aria-label="'Go to slide ' + i">
                            </button>
                        </template>
                    </div>
                </div>
            </div>

            <div class="w-1/2 flex flex-col space-y-[50vh] pb-24">
                
                <!-- Image 1 -->
                <div data-slide-section="1" class="min-h-[50vh] flex items-center justify-center">
                    <div class="relative overflow-hidden rounded-3xl shadow-2xl transition-transform duration-300 hover:scale-[1.02] w-full border-4 border-white/20">
                        <img src="{{ asset('image/sekolahsmkmetland.png') }}" class="w-full h-full object-cover max-h-[500px]">
                        <div class="absolute bottom-0 left-0 bg-gradient-to-t from-black/80 to-transparent text-white p-8 w-full">
                            <p class="font-bold text-xl tracking-wide">Sejarah Awal</p>
                        </div>
                    </div>
                </div>

                <!-- Image 2 -->
                <div data-slide-section="2" class="min-h-[50vh] flex items-center justify-center">
                    <div class="relative overflow-hidden rounded-3xl shadow-2xl transition-transform duration-300 hover:scale-[1.02] w-full border-4 border-white/20">
                        <img src="{{ asset('image/sekolahsmkmetland3.png') }}" class="w-full h-full object-cover max-h-[500px]">
                        <div class="absolute bottom-0 left-0 bg-gradient-to-t from-black/80 to-transparent text-white p-8 w-full">
                            <p class="font-bold text-xl tracking-wide">SMK Metland School</p>
                        </div>
                    </div>
                </div>

                <!-- Image 3 -->
                <div data-slide-section="3" class="min-h-[50vh] flex items-center justify-center">
                    <div class="relative overflow-hidden rounded-3xl shadow-2xl transition-transform duration-300 hover:scale-[1.02] w-full border-4 border-white/20">
                        <img src="{{ asset('image/sekolahsmkmetland4.png') }}" class="w-full h-full object-cover max-h-[500px]">
                        <div class="absolute bottom-0 left-0 bg-gradient-to-t from-black/80 to-transparent text-white p-8 w-full">
                            <p class="font-bold text-xl tracking-wide">Nilai Budaya</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>