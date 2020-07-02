<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
    
    <title>{{config('app.name')}} - Notificación</title>    
      
</head>      
<body>    
    <header class="header">
    </header>
    <main class="container">   
        <div class="main-container">
                <h2>Hola, {{$usuario}}</h2>
                <p> Por el presente correo se pasan los datos para ingresar al portal de reportes.</p>
                <p> <b>Usuario:</b> {{$email}}</p>
                <p> <b>Contraseña: </b> {{ $contraseña}}</p>

                <p>Saludos</p>
                <p>Equipo de TI</p>
                
                <hr>
                <p> Para ingresar al sistema, por favor <a href="cityreportes.prv.com.py"> <b> inicia sesión </b>  </a> al sistema de ticket de soporte</p> 
                <p> Su amistoso sistema de soporte </p>

                
                
        </div>
    </main>
    <footer class="footer-container">
        <p class="footer-text">
               <b>© {{ Date('Y') }} |  {{config('app.name')}} | Todos los derechos reservados.</b> 
        </p>
    </footer>
</body>
</html>       