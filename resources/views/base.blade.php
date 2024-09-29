<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dark Theme Layout</title>
    @vite('resources/css/app.css')
</head>
<body class="flex flex-col min-h-screen bg-gray-900 text-gray-100">

<header>
    @yield('header')
</header>


<main class="flex-grow container mx-auto py-8">
    @yield('content')
</main>

<footer class="bg-gray-800 py-4 mt-8">
    <div class="container mx-auto text-center">
        @yield('footer')
    </div>
</footer>

</body>
</html>
