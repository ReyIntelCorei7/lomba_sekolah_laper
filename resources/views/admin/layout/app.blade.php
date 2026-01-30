<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Metland School')</title>
    
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- TinyMCE Editor -->
    <script src="https://cdn.tiny.cloud/1/YOUR_API_KEY/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    
    <style>
        [x-cloak] { display: none !important; }
        .sidebar { transition: all 0.3s; }
    </style>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1E2188',
                        'primary-dark': '#151767',
                        'primary-light': '#2A2DB5',
                    }
                }
            }
        }
    </script>
    
    @stack('styles')
</head>
<body class="bg-gray-100">

    @include('admin.partials.sidebar')

    <div class="ml-0 lg:ml-64">

        @include('admin.partials.topbar')
        

        <main class="p-6">
            @include('auth.register')
        </main>
    </div>
    
    <!-- Scripts -->
    <script>
        // Initialize TinyMCE
        tinymce.init({
            selector: '#content',
            plugins: 'link image code table lists',
            toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',
            height: 400,
            menubar: false
        });
    </script>
    
    @stack('scripts')
</body>
</html>