<?php include(dirname(__DIR__).'/Common/checkPermissions.php'); ?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="Stylesheet" type="text/css" href="../Public/Style/bootstrap.css" />
    <link rel="Stylesheet" type="text/css" href="../Public/Style/style.css" />
    <link rel="Stylesheet" type="text/css" href="../Public/Style/post.css" />
    
    <title>Job4You</title>
</head>
<body>
<?php include(dirname(__DIR__).'/Common/navbar.php'); ?>
<div class="container">
    <div class="post">
        Tytuł
        <div class='box'>
            <?= $posts[0]->getTitle() ?>
        </div>
        Typ umowy
        <div class='box'>
            <?= $posts[0]->getAgreement() ?>
        </div>
        Nazwa firmy
        <div class='box'>
            <?= $posts[0]->getCompany() ?>
        </div>
        Miasto
        <div class='box'>
            <?= $posts[0]->getTown() ?>
        </div>
        Treść ogłoszenia
        <div class='box'>
            <p style="white-space: pre-line"><?= $posts[0]->getContent() ?></p>
        </div>
        <?php if($_SESSION["id"]==$posts[0]->getUserID() || in_array('ROLE_ADMIN', $_SESSION['role'])) { ?>
        <form action="?page=sendMessage" method="GET" id="send">
            <input type="hidden" name="id" value=<?= $posts[0]->getID() ?>>
            <input type="hidden" name="page" value="deletePost">
            <button type="submit">Usuń ogłoszenie</button>
        </form>
        <?php } ?>
        <?php if($_SESSION["id"]!=$posts[0]->getUserID()) { ?>
        <form action="?page=sendMessage" method="GET" id="send">
            <input type="hidden" name="id" value=<?= $posts[0]->getID() ?>>
            <input type="hidden" name="page" value="sendMessagePage">
            <button type="submit">Zgłoś się</button>
        </form>
        <?php } ?>
    </div>
</div>
</body>
</html>