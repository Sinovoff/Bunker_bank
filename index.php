<!DOCTYPE HTML>
<html>

<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-158811797-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-158811797-1');
	</script>

	<title>Inicio Bunker Escape Room Valladolid</title>
	<meta name="description" content="&iquest;Ser&aacute;s capaz de atracar nuestro bunker en 60 minuto y conseguir escapar sin ser atrapado? ">
	<meta name="keywords" content="Bunker juego escape room niños Valladolid sala alquiler roombate competicion hall escape cumpleaños despedidas celebraciones empresas">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="assets/css/main.css" />
    <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	
		    <!-- script para el banner de cookies -->
    <script type="text/javascript"> 
		function controlCookies2(){
		// Si ya se ha aceptado la politica de cookies en la sesión, se oculta
			if (sessionStorage.avisoleido >0){
				cookie1.style.display="none"; // Esconde la política de cookies
				cookie2.style.display="none"; // Esconde la política de cookies	
			}
		}
		function controlCookies() {
			// si variable no existe se crea (al clicar en Aceptar)
			sessionStorage.avisoleido = (sessionStorage.avisoleido || 0);
			sessionStorage.avisoleido++;
			cookie1.style.display="none"; // Esconde la política de cookies
			cookie2.style.display="none"; // Esconde la política de cookies	
		}
   </script>
   
</head>
    <script>
        var num0=0;
        var num1=0;
        var num2=0;
        var num3=0;
        var num4=0;
        var num5=0;
        var num6=0;
        function cambiar(img) {
            if(img.id == "img1"){
                img.src = "images/candado1b.png";
                num1 = 1;
            } else if(img.id == "img2"){
                img.src = "images/candado2b.png";
                num2 = 1;
            } else if(img.id == "img3"){
                img.src = "images/candado3b.png";
                num3 = 1;
            } else if(img.id == "img4"){
                img.src = "images/candado4b.png";
                num4 = 1;
            } else if(img.id == "img5"){
                img.src = "images/candado5b.png";
                num5 = 1;
            } else if(img.id == "img6"){
                img.src = "images/candado6b.png";
                num6 = 1;
            } else if(img.id == "img0"){
                num0 = 6;
            }
            if(num0+num1+num2+num3+num4+num5+num6 >= 6){
                window.location="inicio.php";
            }
        }
    </script>
<style type="text/css">
    @media screen and (max-width: 700px){ body{ font-size:8px; } }
    #pagina {
        position: absolute;
        left: 0;
        top: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
        background: 50% 50% no-repeat;
        background-image: url("images/fondo.jpg");
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        opacity: 1;
        filter: alpha(opacity=100);
    }
    
    #candado {
        position: fixed;
        top: 50%;
        left: 50%;
        width: 50em;
        height: 30em;
        margin-top: -15em;
        /*set to a negative number 1/2 of your height*/
        margin-left: -25em;
        /*set to a negative number 1/2 of your width*/
        background-image: url("images/bunker.png");
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        opacity: 1;
        filter: alpha(opacity=100);
    }
    
    #cero {
        float: left;
        height: 100%;
        width: auto;
        overflow: hidden;
    }
    
    #uno {
        float: left;
        width: 200px;
        background: #fc0;
        background-image: url("images/candado1a.png");
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        opacity: 1;
        filter: alpha(opacity=100);
    }
</style>

<body onload="controlCookies2()">

	<!-- Banner de aviso de cookies -->
	<div class="caja_cookie1" id="cookie1">
		Esta web utiliza cookies, puedes ver nuestra <a href="politica-cookies.php"><span id="stcookie">pol&iacute;tica de cookies, aqu&iacute;</span></a>
		Si continuas navegando est&aacute;s acept&aacute;ndola
		<button onclick="controlCookies()">Aceptar</button>
		<div class="caja_cookie2" id="cookie2">Pol&iacute;tica de cookies </div>
	</div>
	<!-- Fin de cookies -->
	
    <div id="pagina">
        <div id="candado">
            <div id="cero">
                <a href="#" class=""><img src="images/seguir.png" alt="" height="100%" id="img0" onclick="cambiar(this);"></a>
            </div>
            <div id="cero">
                <a href="#" class=""><img src="images/candado0.png" alt="" height="100%"></a>
            </div>
            <div id="cero">
                <a href="#" class=""><img src="images/candado1a.png" alt="" height="100%" id="img1" onclick="cambiar(this);"></a>
            </div>
            <div id="cero">
                <a href="#" class=""><img src="images/candado2a.png" alt="" height="100%" id="img2" onclick="cambiar(this);"></a>
            </div>
            <div id="cero">
                <a href="#" class=""><img src="images/candado3a.png" alt="" height="100%" id="img3" onclick="cambiar(this);"></a>
            </div>
            <div id="cero">
                <a href="#" class=""><img src="images/candado4a.png" alt="" height="100%" id="img4" onclick="cambiar(this);"></a>
            </div>
            <div id="cero">
                <a href="#" class=""><img src="images/candado5a.png" alt="" height="100%" id="img5" onclick="cambiar(this);"></a>
            </div>
            <div id="cero">
                <a href="#" class=""><img src="images/candado6a.png" alt="" height="100%" id="img6" onclick="cambiar(this);"></a>
            </div>
            <div id="cero">
                <a href="#" class=""><img src="images/candado00.png" alt="" height="100%"></a>
            </div>
        </div>

    </div>

</body>

</html>