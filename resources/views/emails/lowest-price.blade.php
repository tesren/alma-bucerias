<!DOCTYPE html>

<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Nuevo precio mínimo</title>

        <style>
            body{
                font-size: 14px;
            }
        </style>
    </head>

    <body>

        <p>
            Mensaje recibido del sitio web de <strong>ALMA Bucerías</strong>
        </p>
        
        <p>Se le informa que ahora hay un nuevo precio mínimo de <strong>ALMA Bucerías</strong></p>

        <p>Precio sin descuento: <strong>${{ number_format($unit->price) }} {{$unit->currency}}</strong></p>

        <p>Unidad: {{$unit->name}} - Torre {{$unit->tower->name}}</p>
       
    
    </body>

</html>