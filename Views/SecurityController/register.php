<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="Stylesheet" type="text/css" href="../Public/Style/style.css" />
    <link rel="Stylesheet" type="text/css" href="../Public/Style/login.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="./Public/js/validateEmail.js" defer></script>

    <title>Job4You</title>
</head>
<body>
<div class="container">
    <div class="logo">
        <img src="../Public\Views\logo.svg">
        <img src="../Public\Views\Job4You.svg">
    </div>
    <div class="register">
        <form action="?page=register" name="form1" id="form1" method="POST">
            <?php include(dirname(__DIR__).'/Common/messages.php'); ?>
            <input name="name" type="text" placeholder="Imię">
            <input name="surname" type="text" placeholder="Nazwisko">
            <input name="email" type="text" placeholder="E-mail">
            <input name="password" type="password" placeholder="Hasło">
            <input name="password2" type="password" placeholder="Potwierdź hasło">
            <input type="button" id="validate" value="ZAREJESTRUJ SIĘ" onclick="ValidateEmail(document.form1.email)"/>
        </form>
        <button type="submit" onClick='location.href="?page=login"'>POWRÓT</button>
    </div>
</div>
</body>
</html>