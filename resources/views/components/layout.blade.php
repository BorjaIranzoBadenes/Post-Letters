<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title ?? 'Aulab Post'}}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://kit.fontawesome.com/02d3b7b3e8.js" crossorigin="anonymous"></script>
</head>
<body>
    
    <x-navbar />

    <a href="#"><i class="fa-solid fa-arrow-up up-page"></i></a>

    <div style="padding-bottom: 150px">
        {{$slot}}
    </div>
    
    <x-footer />
    
</body>
</html>