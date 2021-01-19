<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="Stylesheet" type="text/css" href="../Public/Style/style.css" />
    <link rel="Stylesheet" type="text/css" href="../Public/Style/login.css" />
    <title>Job4You</title>
</head>
<body>
<div class="container">
    <div class="logo">
        <img src="../Public\Views\logo.svg">
        <img src="../Public\Views\Job4You.svg">
    </div>
    <div class="register">
        <form action="?page=register" method="POST">
                <div class="messages">
                        <?php
                            if(isset($messages)){
                                foreach($messages as $message) {
                                    echo $message;
                                }
                            }
                        ?>
                </div>
                <input name="name" type="text" placeholder="Imię">
                <input name="surname" type="text" placeholder="Nazwisko">
                <input name="email" type="text" placeholder="E-mail">
                <input name="password" type="password" placeholder="Hasło">
                <input name="password2" type="password" placeholder="Potwierdź hasło">
                <button type="submit">ZAREJESTRUJ SIE</button>
        </form>
        <button type="submit" onClick='location.href="?page=login"'>POWRÓT</button>
    </div>
</div>
</body>
</html>