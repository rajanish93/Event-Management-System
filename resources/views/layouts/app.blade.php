<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Event Management System')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    @include('partials.navbar')
    <div class="container mt-4">
        @yield('content')
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        // Enable Pusher logging for debugging purposes. Remove or set to false in production.
        Pusher.logToConsole = true;

        // Initialize Pusher with your application key and cluster
        var pusher = new Pusher('f3a4870be40176e8c2a7', {
            cluster: 'ap2' // Change this to your actual cluster
        });

        // Subscribe to a channel
        var channel = pusher.subscribe('event-management-system');

        // Listen for an event on the channel
        channel.bind('MessageSent', function (data) {
            console.log('Data received: ', data); // Log data to console for debugging
            alert(JSON.stringify(data)); // Handle the incoming event data
        });
    </script>
</body>

</html>