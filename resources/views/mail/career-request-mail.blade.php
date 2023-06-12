<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Career Request</title>
</head>

<body>

    <h1>Hemos recibido tu solicitud</h1>
    <h4>Solicitud para el rol de {{$info['role']}}</h4>
    <p>Recibido de {{$info['email']}}</p>
    <h4>Mensaje: </h4>
    <p>{{$info['message']}}</p>
    
    @if ($info['role'] === 'admin')
        <a href="{{route('admin.make',$info['user'])}}">Aceptar solicitud para administrador</a><br>
    @elseif ($info['role'] === 'revisor')
        <a href="{{route('revisor.make',$info['user'])}}">Aceptar solicitud para revisor</a><br>
    @elseif ($info['role'] === 'writer')
        <a href="{{route('writer.make',$info['user'])}}">Aceptar solicitud para redactor</a><br>
    @endif

</body>
</html>
