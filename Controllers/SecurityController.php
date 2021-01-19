<?php

require_once 'AppController.php';
require_once __DIR__.'//..//Models//User.php';
require_once __DIR__.'//..//Models//UserMapper.php';

class SecurityController extends AppController {

    public function login()
    {
        $mapper = new UserMapper();

        $user = null;

        if ($this->isPost()) {

            $user = $mapper->getUser($_POST['email']);

            if($user==null) {
                $this->render('login', ['messages' => ['Użytkownik nie istnieje!']]);
                return;
            }

            if ($user->getPassword() !== md5($_POST['password'])) {
                $this->render('login', ['messages' => ['Złe hasło!']]);
                return;
            } else {

                $_SESSION["id"] = $user->getID();
                $_SESSION["role"] = $user->getRole();

                $url = "http://$_SERVER[HTTP_HOST]/";
                header("Location: {$url}?page=board");
                return;
            }
        }

        $this->render('login');
    }

    public function logout()
    {
        session_unset();
        session_destroy();

        $this->render('login', ['messages' => ['Zostałeś wylogowany']]);
    }

    public function register()
    {
        $mapper = new UserMapper();
        $user = null;
        
        if ($this->isPost()) {
            if($_POST['email']==""){
                $this->render('register', ['messages' => ['Podaj e-mail']]);
                return;
            }
            if($_POST['name']==""){
                $this->render('register', ['messages' => ['Podaj imię']]);
                return;
            }
            if($_POST['surname']==""){
                $this->render('register', ['messages' => ['Podaj nazwisko']]);
                return;
            }
            if(md5($_POST['password'])==""){
                $this->render('register', ['messages' => ['Podaj hasło']]);
                return;
            }
            if(md5($_POST['password'])!==md5($_POST['password2'])){
                $this->render('register', ['messages' => ['Hasła różnią się od siebie']]);
                return;
            }
            $user = $mapper->getUser($_POST['email']);
            if($user!==null) {
                $this->render('register', ['messages' => ['Użytkownik z tym e-mailem istnieje']]);
                return;
            }
            $user = new User($_POST['email'], md5($_POST['password']), $_POST['name'], $_POST['surname'],0);

            $mapper->setUser($user);
            $this->render('register',['messages' => ['Zostałeś zarejestrowany. Możesz się zalogować']]);
            return;

        }
        $this->render('register');

    }

    public function changeSettings()
    {
        if ($this->isPost()) {
            $mapper = new UserMapper();
            $database = new Database();
            if(isset($_POST['email'])){
                if($_POST['email']==""){
                    $this->render('settings', ['messages' => ['Podaj e-mail']]);
                    return;
                }
                $user = $mapper->getUser($_POST['email']);
                if($user!==null) {
                    $this->render('settings', ['messages' => ['Użytkownik z tym e-mailem istnieje']]);
                    return;
                }              
                $stmt = $database->connect()->prepare('UPDATE user SET email=:email WHERE id = :id_user;');
                $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
                $stmt->bindParam(':id_user', $_SESSION['id'], PDO::PARAM_STR);
                $stmt->execute();
                $this->render('settings', ['messages' => ['Zmieniono e-mail']]);
                return;
            }
            if(isset($_POST['name'])){
                if($_POST['name']==""){
                    $this->render('settings', ['messages' => ['Podaj imię']]);
                    return;
                }
                $stmt = $database->connect()->prepare('UPDATE user SET name=:name WHERE id = :id_user;');
                $stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
                $stmt->bindParam(':id_user', $_SESSION['id'], PDO::PARAM_STR);
                $stmt->execute();
                $this->render('settings', ['messages' => ['Zmieniono imię']]);
                return;
            }
            if(isset($_POST['surname'])){
                if($_POST['surname']==""){
                    $this->render('settings', ['messages' => ['Podaj nazwisko']]);
                    return;
                }
                $stmt = $database->connect()->prepare('UPDATE user SET surname=:surname WHERE id = :id_user;');
                $stmt->bindParam(':surname', $_POST['surname'], PDO::PARAM_STR);
                $stmt->bindParam(':id_user', $_SESSION['id'], PDO::PARAM_STR);
                $stmt->execute();
                $this->render('settings', ['messages' => ['Zmieniono imię']]);
                return;

            }
            if(isset($_POST['password'])){
                if($_POST['password']==""){
                    $this->render('settings', ['messages' => ['Podaj hasło']]);
                    return;
                }
                if(md5($_POST['password'])!==md5($_POST['password2'])){
                    $this->render('settings', ['messages' => ['Hasła różnią się od siebie']]);
                    return;
                }
                $stmt = $database->connect()->prepare('UPDATE user SET password=:password WHERE id = :id_user;');
                $pass = md5($_POST['password']);
                $stmt->bindParam(':password', $pass, PDO::PARAM_STR);
                $stmt->bindParam(':id_user', $_SESSION['id'], PDO::PARAM_STR);
                $stmt->execute();
                $this->render('settings', ['messages' => ['Zmieniono hasło']]);
                return;
            }
        }
        $this->render('settings');
    }
}