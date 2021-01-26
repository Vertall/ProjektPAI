<?php

require_once 'AppController.php';
require_once __DIR__.'//..//Models//Message.php';
require_once __DIR__.'//..//Models//Post.php';
require_once __DIR__.'//..//Database.php';

class MessageController extends AppController {

    public function sendMessagePage()
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
            $this->render('sendMessage', ['posts' => $data]);
            return;
        }
        $this->render('sendMessage');
    }

    public function sendMessage()
    {
        $database = new Database();
        $data = [];
        if ($this->isPost()) {
            if($_POST['content']==""){
                $stmt = $database->connect()->prepare('SELECT * FROM post WHERE id_post = :id_post;');
                $stmt->bindParam(':id_post', $_POST['id'], PDO::PARAM_STR);
                $stmt->execute();
                $pos = $stmt->fetch(PDO::FETCH_ASSOC);
                $post = new Post($pos['id_user'], $pos['title'], $pos['town'], $pos['agreement'], $pos['company'], $pos['content'], $pos['id_post']);

                array_push($data, $post);
                $this->render('sendMessage', ['posts' => $data, 'messages' => ['Wpisz wiadomość!']]);
                return;
            }

            try {
                $stmt = $database->connect()->prepare('SELECT * FROM post WHERE id_post = :id_post;');
                $stmt->bindParam(':id_post', $_POST['id'], PDO::PARAM_STR);
                $stmt->execute();
                $pos = $stmt->fetch(PDO::FETCH_ASSOC);
                $post = new Post($pos['id_user'], $pos['title'], $pos['town'], $pos['agreement'], $pos['company'], $pos['content'], $pos['id_post']);
                array_push($data, $post);

                $stmt = $database->connect()->prepare('
                    INSERT INTO `message` (`sender_id`, `receiver_id`, `post_id`, `time`, `content`) 
                    VALUES (:sender_id, :receiver_id, :post_id, :time, :content);
                ');
                $stmt->bindParam(':sender_id', $_SESSION['id'], PDO::PARAM_STR);
                $stmt->bindParam(':receiver_id', $_POST['userID'], PDO::PARAM_STR);
                $stmt->bindParam(':post_id',$_POST['id'], PDO::PARAM_STR);
                $datee = date("Y-m-d H:i:s");
                $stmt->bindParam(':time', $datee, PDO::PARAM_STR);
                $stmt->bindParam(':content', $_POST['content'], PDO::PARAM_STR);
                $stmt->execute();
                $this->render('sendMessage', ['posts' => $data, 'messages' => ['Wiadomość została wysłana']]);
                return;
            }
            catch(PDOException $e) {
                die();
            }
        }
        $this->render('sendMessage');
    }

    public function yourMessagesSent()
    {   
        $database = new Database();
        $stmt = $database->connect()->prepare('SELECT DISTINCT m.id, m.sender_id, m.receiver_id, m.post_id, m.time, m.content, p.title, u.name, u.surname 
        FROM message m
        INNER JOIN post p ON m.receiver_id = p.id_user
        INNER JOIN user u ON p.id_user = u.id
        WHERE sender_id = :sender_id');
        $stmt->bindParam(':sender_id', $_SESSION['id'], PDO::PARAM_STR);
        $stmt->execute();
        $data = [];
        $data2 = [];
        $data3 = [];
        while($row = $stmt->fetch())
        {
            $messagge = new Message($row['id'], $row['sender_id'], $row['receiver_id'], $row['post_id'], $row['time'], $row['content']);
            array_push($data, $messagge);
            $name = $row['name'] . " " . $row['surname'];
            array_push($data2, $name);
            array_push($data3, $row['title']);
        }
        $this->render('yourMessagesSent', ['conversations' => $data, 'names' => $data2, 'titles' => $data3, 'site' => 1]);
    }

    public function yourMessagesReceived()
    {   
        $database = new Database();
        $stmt = $database->connect()->prepare('SELECT DISTINCT m.id, m.sender_id, m.receiver_id, m.post_id, m.time, m.content, p.title, u.name, u.surname 
        FROM message m
        INNER JOIN post p ON m.sender_id = p.id_user
        INNER JOIN user u ON p.id_user = u.id
        WHERE receiver_id = :receiver_id');
        $stmt->bindParam(':receiver_id', $_SESSION['id'], PDO::PARAM_STR);
        $stmt->execute();
        $data = [];
        $data2 = [];
        $data3 = [];
        while($row = $stmt->fetch())
        {
            $messagge = new Message($row['id'], $row['sender_id'], $row['receiver_id'], $row['post_id'], $row['time'], $row['content']);
            array_push($data, $messagge);
            $name = $row['name'] . " " . $row['surname'];
            array_push($data2, $name);
            array_push($data3, $row['title']);
        }
        $this->render('yourMessagesReceived', ['conversations' => $data, 'names' => $data2, 'titles' => $data3, 'site' => 1]);
    }

    public function goToMessage()
    {
        $database = new Database();
        $data = [];
        if ($this->isGET()) {
            $stmt = $database->connect()->prepare('SELECT DISTINCT m.id, m.sender_id, m.receiver_id, m.post_id, 
                m.time, m.content, u.name as sender_name, u.surname as sender_surname, 
                u2.name as receiver_name, u2.surname as receiver_surname, p.title
                FROM message m
                INNER JOIN user u ON m.sender_id = u.id
                INNER JOIN user u2 ON m.receiver_id = u2.id
                INNER JOIN post p ON m.post_id = p.id_post
                WHERE m.id = :id;');
            $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_STR);
            $stmt->execute();
            $mess = $stmt->fetch(PDO::FETCH_ASSOC);
            $message = new Message($mess['id'], $mess['sender_id'], $mess['receiver_id'], $mess['post_id'], $mess['time'], $mess['content']);
            array_push($data, $message);
            $senderFullName = $mess['sender_name'] . ' ' . $mess['sender_surname'];
            $receiverFullName = $mess['receiver_name'] . ' ' . $mess['receiver_surname'];
            $postTitle = $mess['title'];

            $this->render('message', ['messages' => $data, 'senderFullName' => $senderFullName, 'receiverFullName' => $receiverFullName, 'postTitle' => $postTitle]);
            return;
        }
    }
}