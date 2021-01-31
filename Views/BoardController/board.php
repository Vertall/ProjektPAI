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
    <link rel="Stylesheet" type="text/css" href="../Public/Style/board.css" />
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

<?php include(dirname(__DIR__).'/Common/navbar.php'); ?>
<div class="container">
<div class="board">
<div class="messages">
                        <?php
                            if(isset($messages)){
                                foreach($messages as $message) {
                                    echo $message;
                                }
                            }
                        ?>
                </div>
        <form action="" method="GET" id="search">
                <input type="hidden" name="page" value="searchPost">
                <input name="title" type="text" placeholder="Wpisz nazwę stanowiska...">
                <input name="town" type="text" placeholder="Wpisz nazwę miasta...">
                <input type="hidden" name="site" value=<?= $site ?>>
                <button type="submit">Szukaj</button>
        </form>
        <?php $tmp=0; 
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
                
                <input type="submit" name="site" id="goToPage" value=<?= $i ?> />
                <input type="hidden" name="title" value=<?= $title ?>>
                <input type="hidden" name="town" value=<?= $town ?>>
                <input type="hidden" name="page" value="searchPost">
            </form>
        <?php }?>
        </div>

</div>
</div>
</body>
</html>