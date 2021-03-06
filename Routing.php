<?php

require_once 'Controllers//BoardController.php';
require_once 'Controllers//SecurityController.php';
require_once 'Controllers//MessageController.php';

class Routing {
    private $routes = [];

    public function __construct()
    {
        $this->routes = [
            'board' => [
                'controller' => 'BoardController',
                'action' => 'getLatestPosts'
            ],
            'login' => [
                'controller' => 'SecurityController',
                'action' => 'login'
            ],
            'logout' => [
                'controller' => 'SecurityController',
                'action' => 'logout'
            ],
            'register' => [
                'controller' => 'SecurityController',
                'action' => 'register'
            ],
            'add' => [
                'controller' => 'BoardController',
                'action' => 'addPost'
            ],
            'yourPosts' => [
                'controller' => 'BoardController',
                'action' => 'getYourPosts'
            ],
            'goToPost' => [
                'controller' => 'BoardController',
                'action' => 'goToPost'
            ],
            'searchPost' => [
                'controller' => 'BoardController',
                'action' => 'searchPost'
            ],
            'settings' => [
                'controller' => 'SecurityController',
                'action' => 'changeSettings'
            ],
            'sendMessagePage' => [
                'controller' => 'MessageController',
                'action' => 'sendMessagePage'
            ],
            'sendMessage' => [
                'controller' => 'MessageController',
                'action' => 'sendMessage'
            ],
            'messages' => [
                'controller' => 'MessageController',
                'action' => 'yourMessagesReceived'
            ],
            'messagesSent' => [
                'controller' => 'MessageController',
                'action' => 'yourMessagesSent'
            ],
            'goToMessage' => [
                'controller' => 'MessageController',
                'action' => 'goToMessage'
            ],
            'deletePost' => [
                'controller' => 'BoardController',
                'action' => 'deletePost'
            ]
        ];
    }

    public function run()
    {
        $page = isset($_GET['page']) ? $_GET['page'] : 'login';

        if (isset($this->routes[$page])) {
            $controller = $this->routes[$page]['controller'];
            $action = $this->routes[$page]['action'];

            $object = new $controller;
            $object->$action();
        }
    }
}
