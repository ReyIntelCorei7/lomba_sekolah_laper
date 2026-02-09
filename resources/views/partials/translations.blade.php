<!-- Translation System (load before Alpine.js) -->
<script src="{{ asset('js/translations.js') }}"></script>

<!-- Alpine.js Global Store for Language -->
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('lang', {
            current: localStorage.getItem('lang') || 'id',
            
            toggle() {
                this.current = this.current === 'id' ? 'en' : 'id';
                localStorage.setItem('lang', this.current);
                // Dispatch event for auto-translation system
                window.dispatchEvent(new CustomEvent('languageChanged', { 
                    detail: { lang: this.current } 
                }));
                // Also trigger applyTranslations directly for immediate update
                if (window.applyTranslations) {
                    window.applyTranslations(this.current);
                }
            },
            
            set(lang) {
                this.current = lang;
                localStorage.setItem('lang', this.current);
                window.dispatchEvent(new CustomEvent('languageChanged', { 
                    detail: { lang: this.current } 
                }));
                if (window.applyTranslations) {
                    window.applyTranslations(this.current);
                }
            },
            
            t(key) {
                return window.t ? window.t(key, this.current) : key;
            }
        });
    });
</script>
