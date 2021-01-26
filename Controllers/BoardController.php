<?php

require_once 'AppController.php';
require_once __DIR__.'//..//Models//Post.php';
require_once __DIR__.'//..//Database.php';

class BoardController extends AppController {

    public function getLatestPosts()
    {   
        $database = new Database();
        $stmt = $database->connect()->prepare('SELECT * FROM post');
        $stmt->execute();
        $data = [];
        while($row = $stmt->fetch())
        {
            $post = new Post($row['id_user'], $row['title'], $row['town'], $row['agreement'], $row['company'], $row['content'], $row['id_post']);
            array_push($data, $post);
        }
        $this->render('board', ['posts' => $data, 'title' => '', 'town' => '', 'site' => 1]);
    }

    public function getYourPosts()
    {   
        $database = new Database();
        $stmt = $database->connect()->prepare('SELECT * FROM post WHERE id_user = :id_user;');
        $stmt->bindParam(':id_user', $_SESSION['id'], PDO::PARAM_STR);
        $stmt->execute();
        $data = [];
        while($row = $stmt->fetch())
        {
            $post = new Post($row['id_user'], $row['title'], $row['town'], $row['agreement'], $row['company'], $row['content'], $row['id_post']);
            array_push($data, $post);
        }
        if(isset($_GET['site'])) $site = $_GET['site'];
        else $site = 1;
        $this->render('yourPosts', ['posts' => $data, 'site' => $site]);
    }

    public function goToPost()
    {   
        $database = new Database();
        $data = [];
        if ($this->isGET()) {
            $stmt = $database->connect()->prepare('SELECT * FROM post WHERE id_post = :id_post;');
            $stmt->bindParam(':id_post', $_GET['id'], PDO::PARAM_STR);
            $stmt->execute();
            $pos = $stmt->fetch(PDO::FETCH_ASSOC);
            $post = new Post($pos['id_user'], $pos['title'], $pos['town'], $pos['agreement'], $pos['company'], $pos['content'], $pos['id_post']);

            array_push($data, $post);
            $this->render('post', ['posts' => $data]);
            return;
        }
        
        $this->render('post');
    }

    public function searchPost(){
        $database = new Database();
        $data = [];
        
        if ($this->isGet()) {
            if($_GET['title']!=="" && $_GET['town']!=""){
                $stmt = $database->connect()->prepare('SELECT * FROM post WHERE title = :title AND town = :town;');
                $stmt->bindParam(':town', $_GET['town'], PDO::PARAM_STR);
                $stmt->bindParam(':title', $_GET['title'], PDO::PARAM_STR);
                $stmt->execute();
                while($row = $stmt->fetch())
                {
                    $post = new Post($row['id_user'], $row['title'], $row['town'], $row['agreement'], $row['company'], $row['content'], $row['id_post']);
                    array_push($data, $post);
                }
                $this->render('board', ['posts' => $data, 'title' => $_GET['title'], 'town' => $_GET['town'], 'site' => $_GET['site']]);
                return;
            }
            if($_GET['title']!==""){
                $stmt = $database->connect()->prepare('SELECT * FROM post WHERE title = :title;');
                $stmt->bindParam(':title', $_GET['title'], PDO::PARAM_STR);
                $stmt->execute();
                while($row = $stmt->fetch())
                {
                    $post = new Post($row['title'], $row['town'], $row['agreement'], $row['company'], $row['content'], $row['id_post']);
                    array_push($data, $post);
                }
                $this->render('board', ['posts' => $data, 'title' => $_GET['title'], 'town' => $_GET['town'], 'site' => $_GET['site']]);
                return;
            }
            if($_GET['town']!==""){
                $stmt = $database->connect()->prepare('SELECT * FROM post WHERE town = :town;');
                $stmt->bindParam(':town', $_GET['town'], PDO::PARAM_STR);
                $stmt->execute();
                while($row = $stmt->fetch())
                {
                    $post = new Post($row['id_user'], $row['title'], $row['town'], $row['agreement'], $row['company'], $row['content'], $row['id_post']);
                    array_push($data, $post);
                }
                $this->render('board', ['posts' => $data, 'title' => $_GET['title'], 'town' => $_GET['town'], 'site' => $_GET['site']]);
                return;
            }
        }
        $stmt = $database->connect()->prepare('SELECT * FROM post;');
        $stmt->execute();
        while($row = $stmt->fetch())
        {
            $post = new Post($row['id_user'], $row['title'], $row['town'], $row['agreement'], $row['company'], $row['content'], $row['id_post']);
            array_push($data, $post);
        }
        $this->render('board', ['posts' => $data, 'title' => $_GET['title'], 'town' => $_GET['town'], 'site' => $_GET['site']]);
    }

    public function goToPage(){
        $database = new Database();
        $stmt = $database->connect()->prepare('SELECT * FROM post');
        $stmt->execute();
        $data = [];
        $tmp = 0;
        while($row = $stmt->fetch())
        {
            $tmp++;
            if($tmp<=$_GET['site']*5 && $tmp>($_GET['site']-1)*5){
                $post = new Post($row['id_user'], $row['title'], $row['town'], $row['agreement'], $row['company'], $row['content'], $row['id_post']);
                array_push($data, $post);
            }
        }
        $this->render('board', ['posts' => $data]);
    }

    public function addPost(){
        $database = new Database();

        if ($this->isPost()) {
            if($_POST['title']==""){
                $this->render('add', ['messages' => ['Brak tytułu']]);
                return;
            }
            if($_POST['agreement']==""){
                $this->render('add', ['messages' => ['Brak typu umowy']]);
                return;
            }
            if($_POST['company']==""){
                $this->render('add', ['messages' => ['Brak nazwy firmy']]);
                return;
            }
            if($_POST['town']==""){
                $this->render('add', ['messages' => ['Brak miasta']]);
                return;
            }
            if($_POST['content']==""){
                $this->render('add', ['messages' => ['Brak treści']]);
                return;
            }
            $_POST['content'] = str_replace('\n', '<br>', $_POST['content']);
            try {
                $stmt = $database->connect()->prepare('
                    INSERT INTO `post` (`id_user`, `title`, `agreement`, `company`, `town`, `content`) 
                    VALUES (:id_user, :title, :agreement, :company, :town, :content);
                ');
                $stmt->bindParam(':id_user', $_SESSION['id'], PDO::PARAM_STR);
                $stmt->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
                $stmt->bindParam(':agreement',$_POST['agreement'], PDO::PARAM_STR);
                $stmt->bindParam(':company',$_POST['company'], PDO::PARAM_STR);
                $stmt->bindParam(':town', $_POST['town'], PDO::PARAM_STR);
                $stmt->bindParam(':content', $_POST['content'], PDO::PARAM_STR);
                $stmt->execute();
                $this->render('add', ['messages' => ['Ogłoszenie zostało dodane']]);
            }
            catch(PDOException $e) {
                die();
            }
        }
        $this->render('add');
    }
}