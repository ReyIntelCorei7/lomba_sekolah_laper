{{-- resources/views/livewire/scroll-progress.blade.php --}}
<div 
    x-data="{
        progress: 0,
        init() {
            // Update progress saat scroll
            window.addEventListener('scroll', () => {
                const winHeight = window.innerHeight;
                const docHeight = document.documentElement.scrollHeight;
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                const trackLength = docHeight - winHeight;
                this.progress = Math.floor((scrollTop / trackLength) * 100);
                
                // Kirim ke Livewire component jika perlu
                @this.set('progress', this.progress);
            });
        }
    }"
    x-init="init()"
    class="fixed right-0 top-0 h-screen w-4 z-50 hidden md:block"
>
    <!-- Scroll Track -->
    <div class="absolute right-0 top-0 h-full w-px bg-gray-200 dark:bg-gray-700"></div>
    
    <!-- Progress Indicator -->
    <div 
        x-bind:style="`height: ${progress}%`"
        class="absolute right-0 top-0 w-full bg-blue-500 dark:bg-blue-400 transition-all duration-300"
    ></div>
    
    <!-- Current Position Marker -->
    <div 
        x-bind:style="`top: ${progress}%`"
        class="absolute right-0 transform -translate-y-1/2 w-4 h-4 rounded-full bg-blue-600 dark:bg-blue-300 border-2 border-white dark:border-gray-800 shadow-lg transition-all duration-300"
    ></div>
</div>

<!-- Optional: Minimal Scrollbar untuk Mobile -->
<style>
    /* Sembunyikan scrollbar default */
    ::-webkit-scrollbar {
        width: 0px;
        background: transparent;
    }
    
    /* Custom thin scrollbar */
    .thin-scrollbar::-webkit-scrollbar {
        width: 3px;
    }
    
    .thin-scrollbar::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    
    .thin-scrollbar::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }
</style>