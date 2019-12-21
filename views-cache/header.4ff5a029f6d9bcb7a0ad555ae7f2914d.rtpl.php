<?php if(!class_exists('Rain\Tpl')){exit;}?><html>
	<head>
        <meta charset="utf-8">
		<meta name="viewport" content="device-width, initial-scale=1">
        <title>Eleições 2022</title>
        <link rel="stylesheet" href="res/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="res/owl-carousel2/assets/owl.carousel.css">
        <link ref="stylesheet" href="res/owl-carousel2/assets/owl.theme.default.min.css">
        <link rel="stylesheet" href="res/css/stylesheet.css">
		<link rel="stylesheet" href="res/css/stylesheet-mobile.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet"> 
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
		<script src="https://kit.fontawesome.com/bb415f76f1.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <header>
                <div id="menu">
					<i class="fa fa-bars"></i>
                    <ul>
                        <li><a href="/eleicoes2022">INICIO</a></li>
                        <?php if( checkLogin()==1 ){ ?>

                        <li>Olá <?php echo userNome(); ?> - (<a href="sair">Sair</a>)</li>
                        <?php }else{ ?>

                        <li><a href="cadastre">Cadastre-se</a></li>
                        <li><a href="login">Entrar</a></li>
                        <?php } ?>

                        <li><a href="politica-de-privacidade">Política de Privacidade</a></li>
                    </ul>
                </div>
               
            </header>
        