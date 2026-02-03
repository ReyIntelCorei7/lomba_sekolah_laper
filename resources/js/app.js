import './bootstrap';
import Alpine from 'alpinejs'
import intersect from '@alpinejs/intersect' // Pastikan baris ini ada
 
Alpine.plugin(intersect) // Pastikan plugin didaftarkan sebelum Alpine.start()
 
window.Alpine = Alpine
Alpine.start()