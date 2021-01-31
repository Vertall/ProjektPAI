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
<h1 style="font-size:40px;text-align:center">TWOJE OGŁOSZENIA</h1><br>
        <?php $tmp = 0;
        foreach($posts as $post): ?>
            <?php $tmp++;
                if($tmp>$site*5 || $tmp<=($site-1)*5) continue;
            ?>
            <form action="" method="GET" id="post">
                
                <input type="submit" name="button" id="button" value=<?= $post->getTitle() ?> />
                <div class="wraper">
                <div class="agreement"><?= $post->getAgreement() ?></div>
                <div class="company"><?= $post->getCompany() ?></div>
                <div class="town"><?= $post->getTown() ?></div>
                <input type="hidden" name="page" value="goToPost">
                <input type="hidden" name="id" value=<?= $post->getID() ?>>
                
                </div>
            </form>
        <?php endforeach;
        $pages = ceil(count($posts)/5)?>
        <div class="pages">
        <?php for($i=1; $i<=$pages; $i++){?>
            <form action="" method="GET" id="page">
                <input type="submit" name="site" id="getLa" value=<?= $i ?> />
                <input type="hidden" name="page" value="yourPosts">
            </form>
        <?php }?>
</div>
</div>
</body>
</html>