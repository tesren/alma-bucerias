<!DOCTYPE html>

<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Mensaje de ALMA Bucerías </title>
    </head>

    @php
        $lang = $user->lang;
        App::setLocale($lang);

        //primeras 3 letras del nombre
        $generatedPass = substr($user->name, 0, 3);

        //gion bajo y primeras 2 letras del correo
        $generatedPass .= '_'.substr($user->email, 0, 2);

        //lenguage en mayusculas y año actual
        $generatedPass .= strtoupper($user->lang).date('Y');

        //simbolo en caso de que no haya pais
        $generatedPass .= '&';
    @endphp

    <body>


        @if($lang == 'es')
            <h1 style="text-align: center;">
                {{__('BIENVENIDO')}} <br>
                {{__('Pre-Venta Privada Especial')}}
            </h1>

            <h2>Estimado(a) {{$user->name}}</h2>

            <p>Esperamos que al recibir este correo, usted y su familia se encuentren muy bien.</p>
            
            <p>
                En Domus nos enorgullece informarle que ha llegado el momento de iniciar la preventa privada de “ALMA Bucerías”, que es exclusiva para las personas que, así como usted, solicitaron ser incluidos en este exclusivo evento.
                
            </p> 

            <p>
                A partir de este momento, usted podrá ingresar al sitio especial ALMA Bucerías {{ url('/login') }}, en donde podrá encontrar información detallada del proyecto, así como de las unidades disponibles, de manera que usted pueda seleccionar y comprar el condominio de su preferencia, usando la siguiente información:
                
            </p> 

            <p>
                Correo: {{ $user->email }}<br>
                Contraseña: {{ $generatedPass }}<br>
            </p>
            
            <h3>El proceso de selección y compra se realizará en dos fases:</h3>
            
            <p>
                FASE #1: Periodo de revisión y selección
                A partir de hoy martes, 4 de junio, usted tendrá 5 (cinco) días naturales para revisar el inventario disponible, analizar y seleccionar las posibles opciones de su preferencia, y tener el contacto necesario con su agente representante de Domus para aclarar cualquier duda que pueda tener.
                
            </p>
            <p>
                Le recomendamos ampliamente que tenga en mente de dos a tres unidades que sean de su preferencia, ya que el proceso de compra será en la modalidad de “el primero que elija y complete el proceso, es el que se queda con la unidad”. Por lo que, mientras más rápido haga su selección y proceda con el formato de Solicitud de Compra, es más probable que adquiera la unidad de su preferencia.
                
            </p> 
            
            <h3>
                FASE #2: Proceso de compra
                
            </h3><p>
                A partir del día lunes, 10 de junio, usted tendrá dos semanas para definir su unidad o unidades para comprar. Es decir, durante estas dos semanas usted deberá de emitir su solicitud de compra y proporcionar la documentación requerida para la elaboración del Contrato de Promesa de Compraventa, mismo que se le estará enviando para revisión.
                
            </p> 
            <p>
                Los contratos deberán ser firmados a más tardar 4 (cuatro) días después de haber ingresado la Solicitud de Compra. Así mismo, el enganche correspondiente también deberá de ser pagado a más tardar 4 (cuatro) días después de haber ingresado la Solicitud de Compra.
                
            </p> 
            <p>
                Si no se cumple el proceso de firma y pago dentro de los 4 (cuatro) días establecidos, no se podrá garantizar la disponibilidad ni precio de la unidad seleccionada.
                
            </p> 
            <p>
                MUY IMPORTANTE: Si usted tuvo oportunidad de revisar la información y aclarar cualquier duda durante el “Periodo de Revisión y Selección” (Fase #1), y ya está decidido por alguna unidad en específico, no es necesario esperar al día 10 de junio para proceder con su compra, puede en cualquier momento solicitar a su agente Domus que proceda con la Solicitud de Compra y elaboración de contrato.
                
            </p> 
            <h3>
                ¿¡CUÁL ES EL BENEFICIO DE LA PREVENTA PRIVADA?!
                
            </h3>

            <p>
                Uno de los beneficios de haberse registrado en la lista de espera es precisamente tener la posibilidad de ser de las primeras personas en elegir, ya que hay mucho inventario disponible, y también se podrá obtener los mejores precios, por lo que es vital que usted concrete su compra en el tiempo establecido.
                
            </p> 

            <p>
                Otro de los beneficios es que estaremos ofreciendo muy atractivos planes de pago, así como descuentos especiales durante este periodo. Una vez que se cumpla con cierto número de unidades vendidas, se eliminará el descuento especial y el desarrollo saldrá a la venta al público.
            </p> 

            <p>
                Es por eso la importancia de asegurar la compra en el tiempo establecido.
                
            </p> 

            <p>
                La información sobre disponibilidad y precios se estará actualizando en tiempo real, por lo que usted podrá ver en todo momento lo que hay disponible.
                
            </p> 
            <p>
                Como podrá darse cuenta, éste será un proceso muy dinámico, por lo que le recomendamos ampliamente aprovechar esta oportunidad única e irrepetible para adquirir un condominio en uno de los mejores desarrollos inmobiliarios en la zona de Marina Vallarta.
                
            </p> 
            <p>
                Usted ya tendrá tiempo para analizar la información a detalle, pero le podemos adelantar que ALMA Bucerías tiene una muy buena variedad de diferentes tipos de unidades, con diferentes rangos de precios para todos los gustos y necesidades, con vistas al mar, al campo de golf, así como a las áreas comunes del desarrollo.
                
            </p> 
            <p>
                Para apoyarlo y guiarlo durante el proceso de revisión, selección y compra, su agente Profesional de Ventas en DOMUS estará presente en todo momento para asegurarse de que tenga una grata experiencia de compra.
                
            </p> 
            <p>
                Esperamos que esta información le sea de utilidad, no sin antes agradecerle por su amable atención a este comunicado, quedando a sus órdenes para cualquier duda o comentario que tenga al respecto.
                
            </p>
            <p>
                Atentamente, <br>
                DOMUS Fine Real Estate
            </p>

            {{-- <div>
                <img width="35px" height="auto" src="{{asset('img/icono-tridenta.jpg')}}" alt="Icono Tridenta">
            </div> --}}
            <hr style="opacity: 1; color:2A345A;">

        @else

            <h2>Dear {{$user->name}}:</h2>

            <p>We hope that upon receiving this email, you and your family are doing very well.</p>
 
            <p>In Domus we are proud to inform you that the time has come to start the private presale of "ALMA Bucerías," which is exclusive for people who, like you, requested to be included in this exclusive event.</p>
            
            <p>From this moment on, you will be able to enter the special site ALMA Bucerías {{ url('/login') }}, where you will be able to find detailed information about the project, as well as the available units, so that you can select and purchase the condominium of your preference, using the following information:</p>

    
            <p>
                Email: {{ $user->email }}<br>
                Password: {{ $generatedPass }}<br>
            </p>
            
            <h2>The selection and purchase process will be carried out in two phases:</h2>
 
            <h3>PHASE #1: Review and Selection Period</h3>
            <p>Starting today, Tuesday, June 4, you will have 5 (five) calendar days to review the available inventory, analyze, and select the possible options of your preference, and have the necessary contact with your Domus representative agent to clarify any doubts you may have.</p>
            
            <p>We strongly recommend that you have two to three units of your preference in mind, since the purchase process will be on a "first come, first serve" basis. Therefore, the faster you make your selection and proceed with the Purchase Request form, the more likely you are to purchase the unit of your choice.</p>
            
            
            <h3>PHASE #2: Purchase Process</h3>
            <p>Starting on Monday, June 10, you will have two weeks to define your unit or units to purchase. That is to say, during these two weeks you must issue your purchase request and provide the required documentation for the preparation of the Promissory Purchase Agreement, which will be sent to you for review.</p>
            
            <p>The contracts must be signed no later than 4 (four) days after submitting the Purchase Request. Likewise, the corresponding down payment must also be paid no later than 4 (four) days after submitting the Purchase Request.</p>
            
            <p>If the signature and payment process is not completed within the established 4 (four) days, the availability and price of the selected unit cannot be guaranteed.</p>
            
            <h4>VERY IMPORTANT: If you had the opportunity to review the information and clarify any doubts during the "Review and Selection Period" (Phase #1), and you have already decided on a specific unit, it is not necessary to wait until June 10th to proceed with your purchase, you can ask your Domus agent to proceed with the Purchase Request and contract preparation at any time.</h4>
            
            <h4> WHAT IS THE BENEFIT OF THE PRIVATE PRESALE?!</h4>
            <p>One of the benefits of having registered on the waiting list is precisely to have the possibility of being one of the first people to choose, since there is a lot of inventory available, and you will also be able to get the best prices, so it is vital that you make your purchase within the established time.</p>
            
            <p>Another benefit is that we will be offering very attractive payment plans, as well as special discounts during this period. Once a certain number of units are sold, the special discount will be eliminated and the development will go on sale to the public.</p>
            
            <p>This is why it is important to secure your purchase in a timely manner.</p>
            
            <p>Availability and pricing information will be updated in real time, so you will be able to see what is available at all times.</p>
            
            <p>As you can see, this will be a very dynamic process, so we strongly recommend you to take advantage of this unique and unrepeatable opportunity to acquire a condominium in one of the best real estate developments in the Marina Vallarta area.</p>
            
            <p>You will already have time to analyze the information in detail, but we can tell you in advance that ALMA Bucerías has a very good variety of different types of units, with different price ranges for all tastes and needs, with views of the ocean, the golf course, and the common areas of the development.</p>
            
            <p>To support and guide you through the review, selection and purchase process, your DOMUS Professional Sales Agent will be present at all times to make sure you have a pleasant buying experience.</p>
            
            <p>We hope this information is useful to you and we thank you for your kind attention to this communication. We remain at your disposal for any questions or comments you may have.</p>

            
            <p>
                Sincerely yours, <br>
                DOMUS Fine Real Estate
            </p>
            
{{--             <div>
                <img width="35px" height="auto" src="{{asset('img/icono-tridenta.jpg')}}" alt="Icono Tridenta">
            </div> --}}
            <hr style="opacity: 1; color:2A345A;">

        @endif
        
    
    </body>

</html>