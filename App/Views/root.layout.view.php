<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--botton menu pri mobile-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Button-->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!--moje css-->
    <link rel="stylesheet" href="public/css.css">
    <!--nav bar-->
    <script src="public/js/navbar.js"></script>
    <!--datum pre reading-->
    <script src="public/js/date.js"></script>
    <!--posuvanie fotiek-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!-- Active buttons -->
    <script src="public/js/activeClassToolbar.js"></script>
    <!-- Game -->
    <script type="module" src="public/js/Game/main.js"></script>
    <!--Chart-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
</head>
<body>
<?php /** @var Array $data */ ?>
<div class="header">
    <div class="row head">
        <h1>PinBook</h1>
    </div>
    <nav class="topnav" id="myTopnav">
        <?php if (App\Auth::isLogged()) { ?>
            <a class="link" href="?c=pin&a=pin">My pins</a>
            <a class="link" href="?c=challenge&a=challenge">My challenges</a>
            <a class="link" href="?c=reading&a=reading">My reading</a>
            <a class="link" href="?c=game&a=game">Game</a>
            <a class="link" href="?c=auth&a=myAccount">My account</a>
            <a class="link" href="?c=auth&a=logout">Logout</a>
        <?php } else { ?>
            <a class="link" href="?c=news&a=news">News</a>
            <a class="link" href="?c=auth&a=loginForm">Login</a>
        <?php } ?>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </nav>
</div>
<div class="container-fluid">
    <?= $contentHTML ?>
</div>
</body>
</html>
