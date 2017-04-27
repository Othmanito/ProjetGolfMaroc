<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="<?php echo e(asset('images/golfmaroc.png')); ?>">
        <title>Golf Maroc</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>

            html {

                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;

                -webkit-background-size: cover;
                -moz-background-size: cover;
                -ms-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: black;
                hover:green;
                padding: 0 20px;
                font-size: 25px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            .links > a:hover {
              background-color: #7FFF00;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <?php if(Route::has('login')): ?>
                <div class="top-right links">
                    <?php if(Auth::check()): ?>
                        <a href="<?php echo e(url('/home')); ?>">Home</a>
                    <?php else: ?>
                        <a href="<?php echo e(url('/login')); ?>">Login</a>
                        <a href="<?php echo e(url('/register')); ?>">Register</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="content">

                <img src="images/logo.png" alt="Golf Maroc"></img>




                <div class="links">
                    <a href="<?php echo e(Route('admin.home')); ?>">Administrateur</a>
                    <a href="<?php echo e(Route('direct.home')); ?>">Directeur</a>
                    <a href="">Magasinier</a>
                    <a href="<?php echo e(Route('vendeur.home')); ?>">Vendeur</a>
                </div>
            </div>
        </div>
    </body>
</html>
