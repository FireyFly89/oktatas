<?php
session_start();
define("ROOT_DIR", __DIR__);
require_once "includes/Utilities.php";
require_once "includes/Traits/UnderscoreColumns.php";
require_once "includes/Helpers/DatabaseManager.php";
require_once "includes/Models/Model.php";
require_once "includes/Models/User.php";
require_once "includes/Models/UserMeta.php";
require_once "includes/Helpers/SessionManager.php";
require_once "includes/Helpers/ErrorSessionManager.php";
require_once "includes/Helpers/Validation.php";
require_once "includes/Helpers/ValidationError.php";
require_once "includes/Helpers/Sanitize.php";
require_once "includes/Controllers/UserController.php";

function handleMessage(array $data) {
    $message = $data['message'];
    $dbManager = new DatabaseManager();
    DatabaseManager::create([
        'sender_id' => 1,
        'receiver_id' => 2,
        'message' => $message,
    ]);
    
    echo json_encode(DatabaseManager::read());
}

function init() {
    $userController = new UserController();
    $user = $userController->login($_POST);
    $messages = [];

    if (!empty($_GET)) {
        $parsedUrl = parse_url($_SERVER['REQUEST_URI']);
        $pathData = array_filter(explode('/', $parsedUrl['path']));
        $requestType = $pathData[1];
        $requester = $pathData[2];

        if ($requestType === 'messages') {
            $messages = DatabaseManager::read('*', 
                sprintf('sender_id = "%1$s" or receiver_id = "%1$s"', $requester), 
                'chat'
            );

            echo getTemplatePart('messages',  $messages);
            die();
        }
    }

    echo getTemplatePart('header');

    if (!empty($_POST)) {
        if (array_key_exists('message', $_POST)) {
            handleMessage($_POST);
        }
        die();
    } else {
        $dbManager = new DatabaseManager();
        $messages = DatabaseManager::read('*', '', 'chat');
    }

    if ($user->isLoggedIn()) {
        echo getTemplatePart('messages',  $messages);
        echo getTemplatePart('chat');
    } else {
        echo getTemplatePart('login',  $messages);
    }

    echo getTemplatePart('footer');
}

init();