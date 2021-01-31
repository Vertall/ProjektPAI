<?php
    if(!isset($_SESSION['id']) and !isset($_SESSION['role'])) {
        die('You are not logged in!');
    }

    if(!in_array('ROLE_USER', $_SESSION['role'])) {
        die('You do not have permission to watch this page!');
    }
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="Stylesheet" type="text/css" href="../Public/Style/bootstrap.css" />
    <link rel="Stylesheet" type="text/css" href="../Public/Style/style.css" />
    <link rel="Stylesheet" type="text/css" href="../Public/Style/settings.css" />
    
    <title>Job4You</title>
</head>
<body>
<?php include(dirname(__DIR__).'/Common/navbar.php'); ?>
<div class="container">
    <div class="setting">
        <h1 style="font-size:40px;text-align:center;color:black">USTAWIENIA</h1><br>
        <?php include(dirname(__DIR__).'/Common/messages.php'); ?>
        Zmień imię:
        <form action="?page=settings" method="POST">
                <input name="name" type="text" placeholder="Imię">
                <button type="submit">Zmień imię</button>
        </form>
        <br><br>
        Zmień nazwisko:
        <form action="?page=settings" method="POST">
                <input name="surname" type="text" placeholder="Nazwisko">
                <button type="submit">Zmień nazwisko</button>
        </form>
        <br><br>
        Zmień e-mail:
        <form action="?page=settings" method="POST">
                <input name="email" type="text" placeholder="E-mail">
                <button type="submit">Zmień e-mail</button>
        </form>
        <br><br>
        Zmień hasło:
        <form action="?page=settings" method="POST">
                <input name="password" type="password" placeholder="Hasło">
                <input name="password2" type="password" placeholder="Potwierdź hasło">
                <button type="submit">Zmień hasło</button> 
        </form>
    </div>
</div>
</body>
</html>