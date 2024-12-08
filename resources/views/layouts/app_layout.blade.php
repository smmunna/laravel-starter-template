<!-- resources/views/layouts/layout.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Include CSS stylesheets or other meta tags -->
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    @stack('styles')
</head>

<body>
    <header>
        <!-- Header content goes here -->
        <h1>This is the Header</h1>
    </header>

    <main>
        <!-- Main content goes here -->
        @yield('content')
    </main>

    <footer>
        <!-- Footer content goes here -->
        <p>&copy; 2024 Your Company</p>
    </footer>

    <!-- Include JavaScript files or other scripts -->
    <!--JQuery for ajax-->
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="sweetalert2@11.js"></script>
    @stack('scripts')
</body>

</html>
