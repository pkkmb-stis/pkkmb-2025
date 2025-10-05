import "./bootstrap";

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster:  import.meta.env.VITE_PUSHER_APP_CLUSTER,
    encrypted: true
});

document.addEventListener('DOMContentLoaded', function() {
    // Pastikan Laravel Echo sudah siap
    if (window.Echo) {
        window.Echo.private('pengaduan')
            .listen('PengaduanUpdated', (event) => {
                const pengaduanNotif = document.getElementById('pengaduanNotif');

                if (pengaduanNotif) {
                    if (event.pengaduanCount > 0) {
                        pengaduanNotif.innerText = event.pengaduanCount;
                        pengaduanNotif.style.display = 'flex'; // atau 'block'
                    } else {
                        pengaduanNotif.style.display = 'none';
                    }
                }
                
                // Beri tahu komponen Livewire lain bahwa data telah diperbarui
                Livewire.emit('pengaduanUpdated', event.pengaduanCount);
            });
    } else {
        console.error('Laravel Echo (Badge Listener) not initialized.');
    }
});


