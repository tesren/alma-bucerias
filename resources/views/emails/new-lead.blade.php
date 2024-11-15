<!DOCTYPE html>

<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Mensaje del sitio web de ALMA Bucerías</title>
    </head>

    <body>
        <p>
            Mensaje recibido del sitio web de ALMA Bucerías
        </p>
        
        <p>Referido por: Punto401</p> <br>
    
        <p>Mensaje de: <strong>{{$msg->name}}</strong></p>
        <p>Correo: <strong>{{$msg->email}}</strong></p>
        <p>Telêfono: <strong>{{$msg->phone ?? 'Sin especificar'}}</strong></p>
    
        <p>Contenido: <strong>{{$msg->content ?? 'Sin Contenido'}}</strong></p> <br>
    
        <p>Enviado el: {{$msg->created_at}}</p>
        <p>Desde: {{$msg->url}}</p>
    
        
        <p>Este mensaje fue enviado desde un formulario de contacto en el sitio web de ALMA Bucerías</p>
       
    
    </body>

</html>