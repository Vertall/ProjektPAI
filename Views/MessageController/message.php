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
    <link rel="Stylesheet" type="text/css" href="../Public/Style/post.css" />
    <script>
        $(document).ready(function(){
            $("input").on({
                mouseenter: function(){
                    $(this).css("text-decoration", "underline");
                },
                mouseleave: function(){
                    $(this).css("text-decoration", "none");
                }
            });
        });
    </script>

    <title>Job4You</title>
</head>
<body>
<?php include(dirname(__DIR__).'/Common/navbar.php'); ?>
<div class="container">
    <div class="post">
        Nadawca
        <div class='box'>
            <?= $senderFullName ?>
        </div>
        Odbiorca
        <div class='box'>
        <?= $receiverFullName ?>
        </div>
        Data
        <div class='box'>
        <?= $messages[0]->getTime() ?>
        </div>
        Ogłoszenie
        
        <div class='box'>
        <form action="" method="GET" id="post">
                
                <input type="submit" name="button" id="button" value=<?= $postTitle ?> />
                <input type="hidden" name="page" value="goToPost">
                <input type="hidden" name="id" value=<?= $messages[0]->getPostID() ?>>
            </form>
        </div>
        Treść wiadomości
        <div class='box'>
        <p style="white-space: pre-line"><?= $messages[0]->getContent() ?></p>
        </div>
    </div>
</div>
</body>
</html>