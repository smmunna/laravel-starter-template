<!-- resources/views/layouts/layout.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Include CSS stylesheets or other meta tags -->
    <!--Bootstrap CSS CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!--you can replace it with updated one-->
    @stack('styles')
</head>

<body>
    <header class="bg-warning text-center p-2">
        <!-- Header content goes here -->
        <h4>Welcome to Dashboard Layout</h4>
    </header>

    <main class="min-vh-100">
        <!-- Main content goes here -->
        @yield('content')
    </main>

    <footer class="bg-warning text-center p-2">
        <!-- Footer content goes here -->
        <p>&copy; 2024 Developed by <a href="">Sm.Munna</a></p>
    </footer>

    <!-- Include JavaScript files or other scripts -->
    <!--Bootstrap JS CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!--JQuery for ajax-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    @stack('scripts')
</body>

</html>
