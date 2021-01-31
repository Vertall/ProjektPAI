<?php include(dirname(__DIR__).'/Common/checkPermissions.php'); ?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./Public/js/scriptUnderline.js" defer></script>
    
    <link rel="Stylesheet" type="text/css" href="../Public/Style/bootstrap.css" />
    <link rel="Stylesheet" type="text/css" href="../Public/Style/style.css" />
    <link rel="Stylesheet" type="text/css" href="../Public/Style/board.css" />
    
    <title>Job4You</title>
</head>
<body>
<?php include(dirname(__DIR__).'/Common/navbar.php'); ?>
<div class="container">
<div class="board">
    <div class="messagesSites">
    <form action="" method="GET" id="site">
                <button type="submit" id="messageSite" disabled>ODEBRANE</button>
                <input type="hidden" name="page" value="messages">
            </form>
            <form action="" method="GET" id="site">
                <button type="submit" id="messageSite">WYSŁANE</button>
                <input type="hidden" name="page" value="messagesSent">
            </form>
    </div>
    <h1 style="font-size:40px;text-align:center">ODEBRANE WIADOMOŚCI</h1><br>
    <?php if($conversations == NULL) { ?>
    <h1 style="font-size:20px;text-align:center">BRAK</h1><br>
    <?php } ?>
    <?php $max = count($names);
    for($i=0; $i<$max; $i++){ ?>
            <form action="" method="GET" id="post">
                <input type="submit" name="button" id="button" value="Od: <?= $names[$i] ?>" />
                <div class="wraper">
                <div class="title">Nazwa ogłoszenia: <?= $titles[$i] ?></div>
                <div class="time"><?= $conversations[$i]->getTime() ?></div>
                <input type="hidden" name="page" value="goToMessage">
                <input type="hidden" name="id" value=<?= $conversations[$i]->getID() ?>>
                </div>
            </form>
    <?php } ?>
</div>
</div>
</body>
</html>