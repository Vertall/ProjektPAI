<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="Stylesheet" type="text/css" href="..\Public\Style\style.css" />
    <link rel="Stylesheet" type="text/css" href="..\Public\Style\login.css" />
    <title>Job4You</title>
</head>
<body>

<div class="container">
    <div class="logo">
        <img src="../Public\Views\logo.svg">
        <img src="../Public\Views\Job4You.svg">
    </div>
    <div class="login">
        <form action="?page=login" method="POST">
            <?php include(dirname(__DIR__).'/Common/messages.php'); ?>
            <input name="email" type="text" placeholder="E-mail">
            <input name="password" type="password" placeholder="Hasło">
            <button type="submit">ZALOGUJ SIĘ</button>
        </form>
        <button type="submit" onClick='location.href="?page=register"'>ZAREJESTRUJ SIĘ</button>
    </div>
</div>
</body>
</html>