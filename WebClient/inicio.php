<?php
    include 'includes/header.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Inicio</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Raleway');

        $defaultSeconds: 3s;

        . {
            background-color: #222;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Raleway', sans-serif;
        }

        .flex-container {
            position: absolute;
            height: 100vh;
            width: 100%;
            display: -webkit-flex;
            /* Safari */
            display: flex;
            overflow: hidden;

            @media screen and (max-width: 768px) {
                flex-direction: column;
            }
        }

        .flex-title {
            color: #f1f1f1;
            position: relative;
            font-size: 6vw;
            margin: auto;
            text-align: right;
            transform: rotate(90deg);
            top: 15%;
            -webkit-transition: all 500ms ease;
            -moz-transition: all 500ms ease;
            -ms-transition: all 500ms ease;
            -o-transition: all 500ms ease;
            transition: all 500ms ease;

            @media screen and (max-width: 768px) {
                transform: rotate(0deg) !important;
            }
        }

        .flex-about {
            opacity: 0;
            color: #f1f1f1;
            position: relative;
            width: 70%;
            font-size: 2vw;
            padding: 5%;
            top: 20%;
            border: 2px solid #f1f1f1;
            border-radius: 10px;
            line-height: 1.3;
            margin: auto;
            text-align: left;
            transform: rotate(0deg);
            -webkit-transition: all 500ms ease;
            -moz-transition: all 500ms ease;
            -ms-transition: all 500ms ease;
            -o-transition: all 500ms ease;
            transition: all 500ms ease;

            @media screen and (max-width: 768px) {
                padding: 0%;
                border: 0px solid #f1f1f1;
            }
        }


        .flex-slide {
            -webkit-flex: 1;
            /* Safari 6.1+ */
            -ms-flex: 1;
            /* IE 10 */
            flex: 1;
            cursor: pointer;
            -webkit-transition: all 500ms ease;
            -moz-transition: all 500ms ease;
            -ms-transition: all 500ms ease;
            -o-transition: all 500ms ease;
            transition: all 500ms ease;

            @media screen and (max-width: 768px) {
                overflow: auto;
                overflow-x: hidden;
            }
        }

        .flex-slide p {
            @media screen and (max-width: 768px) {
                font-size: 2em;
            }
        }

        .flex-slide ul li {
            @media screen and (max-width: 768px) {
                font-size: 2em;
            }
        }

        .flex-slide:hover {
            -webkit-flex-grow: 3;
            flex-grow: 3;
        }

        .home {
            height: 100vh;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(https://mbsperu.com/wp-content/uploads/2022/04/almacen-scaled.jpg);
            background-size: cover;
            background-position: left left;
            background-attachment: fixed;

            @media screen and (min-width: 768px) {
                animation: aboutFlexSlide $defaultSeconds 1;
                animation-delay: 0s;
            }
        }

        @keyframes aboutFlexSlide {
            0% {
                -webkit-flex-grow: 1;
                flex-grow: 1;
            }

            50% {
                -webkit-flex-grow: 3;
                flex-grow: 3;
            }

            100% {
                -webkit-flex-grow: 1;
                flex-grow: 1;
            }
        }

        .flex-title-home {
            @media screen and (min-width: 768px) {
                transform: rotate(90deg);
                top: 15%;
                animation: aboutFlexSlide $defaultSeconds 1;
                animation-delay: 0s;
            }
        }



        @keyframes homeFlextitle {
            0% {
                transform: rotate(90deg);
                top: 15%;
            }

            50% {
                transform: rotate(0deg);
                top: 15%;
            }

            100% {
                transform: rotate(90deg);
                top: 15%;
            }
        }

        .flex-about-home {
            opacity: 0;

            @media screen and (min-width: 768px) {
                animation: aboutFlexSlide $defaultSeconds 1;
                animation-delay: 0s;
            }
        }

        @keyframes flexAboutHome {
            0% {
                opacity: 0;
            }

            50% {
                opacity: 1;
            }

            100% {
                opacity: 0;
            }
        }



        .about {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(https://uploads-ssl.webflow.com/61bf377670c35e04fe09c0ad/625d868faffa76261bc934ec_Academy%20Sellrs.png);
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
        }

        .contact-form {
            width: 100%;
        }

        input {
            width: 100%;
        }

        textarea {
            width: 100%;
        }

        .contact {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(https://retos-operaciones-logistica.eae.es/wp-content/uploads/2022/12/hub-and-spoke.jpg);
            background-size: cover;
            background-position: right;
            background-attachment: fixed;
        }

        .work {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(https://www.aduaeasy.com/hubfs/inventario-al-dia.jpg);
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
        }



        // Preloader
        .spinner {
            position: fixed;
            top: 0;
            left: 0;
            background: #222;
            height: 100%;
            width: 100%;
            z-index: 11;
            margin-top: 0;
            color: #fff;
            font-size: 1em;
        }

        .cube1,
        .cube2 {
            background-color: #fff;
            width: 15px;
            height: 15px;
            position: absolute;
            top: 0;
            left: 0;

            -webkit-animation: sk-cubemove 1.8s infinite ease-in-out;
            animation: sk-cubemove 1.8s infinite ease-in-out;
        }

        .cube2 {
            -webkit-animation-delay: -0.9s;
            animation-delay: -0.9s;
        }

        @-webkit-keyframes sk-cubemove {
            25% {
                -webkit-transform: translateX(42px) rotate(-90deg) scale(0.5)
            }

            50% {
                -webkit-transform: translateX(42px) translateY(42px) rotate(-180deg)
            }

            75% {
                -webkit-transform: translateX(0px) translateY(42px) rotate(-270deg) scale(0.5)
            }

            100% {
                -webkit-transform: rotate(-360deg)
            }
        }

        @keyframes sk-cubemove {
            25% {
                transform: translateX(42px) rotate(-90deg) scale(0.5);
                -webkit-transform: translateX(42px) rotate(-90deg) scale(0.5);
            }

            50% {
                transform: translateX(42px) translateY(42px) rotate(-179deg);
                -webkit-transform: translateX(42px) translateY(42px) rotate(-179deg);
            }

            50.1% {
                transform: translateX(42px) translateY(42px) rotate(-180deg);
                -webkit-transform: translateX(42px) translateY(42px) rotate(-180deg);
            }

            75% {
                transform: translateX(0px) translateY(42px) rotate(-270deg) scale(0.5);
                -webkit-transform: translateX(0px) translateY(42px) rotate(-270deg) scale(0.5);
            }

            100% {
                transform: rotate(-360deg);
                -webkit-transform: rotate(-360deg);
            }
        }

        .minimalista {
            color: #fff;
            /* Color del texto */
            text-decoration: none;
            /* Elimina subrayado */
            font-size: 65px;
            /* Tamaño de la fuente */
            padding: 5px;
            /* Espaciado interior */
        }
    </style>
</head>

<body>
    <div class="flex-container">

        <div class="flex-slide home">
            <div class="flex-title flex-title-home"><a class="minimalista" href="marca.php">Marca</a></div>
            <div class="flex-about flex-about-home">
            </div>
        </div>
        <div class="flex-slide about">
            <div class="flex-title"><a class="minimalista" href="categoria.php">Categoria</a></div>
            <div class="flex-about">
            </div>
        </div>
        <div class="flex-slide work">
            <div class="flex-title"><a class="minimalista" href="producto.php">Producto</a></div>
            <div class="flex-about">
            </div>
        </div>
        <div class="flex-slide contact">
            <div class="flex-title"><a class="minimalista" href="operadores.php">Operador</a></div>
            <div class="flex-about">
            </div>

        </div>
    </div>


    <script>(function () {
            $('.flex-container').waitForImages(function () {
                $('.spinner').fadeOut();
            }, $.noop, true);

            $(".flex-slide").each(function () {
                $(this).hover(function () {
                    $(this).find('.flex-title').css({
                        transform: 'rotate(0deg)',
                        top: '10%'
                    });
                    $(this).find('.flex-about').css({
                        opacity: '1'
                    });
                }, function () {
                    $(this).find('.flex-title').css({
                        transform: 'rotate(90deg)',
                        top: '15%'
                    });
                    $(this).find('.flex-about').css({
                        opacity: '0'
                    });
                })
            });
        })(); 
    </script>
</body>

</html>