import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.PUSHER_APP_KEY, // Same as PUSHER_APP_KEY in .env
    cluster: process.env.PUSHER_APP_CLUSTER, // Same as PUSHER_APP_CLUSTER in .env
    forceTLS: true // Enable this if you are using TLS/SSL
});

// Check if Echo is properly initialized
console.log(window.Echo);

window.Echo.channel('event-management-system') // Same channel name used in broadcastOn()
    .listen('MessageSent', (e) => {
        console.log(e.message); // Logs the message received
        alert('New message: ' + e.message);
    });
