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
            },
            
            set(lang) {
                this.current = lang;
                localStorage.setItem('lang', this.current);
            },
            
            t(key) {
                return window.t ? window.t(key, this.current) : key;
            }
        });
    });
</script>
