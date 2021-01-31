<?php include(dirname(__DIR__).'/Common/checkPermissions.php'); ?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link rel="Stylesheet" type="text/css" href="../Public/Style/bootstrap.css" />
    <link rel="Stylesheet" type="text/css" href="../Public/Style/style.css" />
    <link rel="Stylesheet" type="text/css" href="../Public/Style/add.css" />
    
    <title>Job4You</title>
</head>
<body>
<?php include(dirname(__DIR__).'/Common/navbar.php'); ?>
<div class="container">
        <form action="?page=add" method="POST" class="add">
            <?php include(dirname(__DIR__).'/Common/messages.php'); ?>
            <h1 style="font-size:40px;text-align:center;color:black">DODAJ OGŁOSZENIE</h1><br>
            <input name="title" type="text" placeholder="Tytuł">
            <input name="agreement" type="text" placeholder="Typ umowy">
            <input name="company" type="text" placeholder="Nazwa firmy">
            <input name="town" type="text" placeholder="Miasto">
            <textarea class="text" name="content" placeholder="Treść ogłoszenia" rows="5"></textarea>
            <button type="submit">Dodaj ogłoszenie</button>
        </form>
</div>
</body>
</html>