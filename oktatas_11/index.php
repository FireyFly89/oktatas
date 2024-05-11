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

    if (array_key_exists('user_to', $data)) {
        DatabaseManager::create([
            'sender_id' => $data['user_to'], // TODO: This is a temporary solution, should be replaced with dynamic solution later
            'receiver_id' => $_SESSION['user']['id'],
            'message' => $message,
        ], 'chat');
    }

    echo json_encode(DatabaseManager::read());
}

function init() {
    $userController = new UserController();
    $userData = [];

    if (!empty($_SESSION['user'])) {
        $userData = $_SESSION['user'];
    }

    $user = new User($userData);

    if (isPostData('action', 'login')) {
        $user = $userController->login($_POST);
        echo json_encode(['success' => true]);
        die();
    }
    
    $messages = [];

    if (!empty($_GET)) {
        $parsedUrl = parse_url($_SERVER['REQUEST_URI']);
        $pathData = array_filter(explode('/', $parsedUrl['path']));
        
        if (!empty($pathData)) {
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
    }

    if (!empty($_POST)) {
        if (isPostData('action', 'new-message')) {
            handleMessage($_POST);
        }
        die();
    } else {
        $dbManager = new DatabaseManager();
        $messages = DatabaseManager::read('*', 
            sprintf('sender_id = "%1$s" or receiver_id = "%1$s"', $user->id), 
            'chat'
        );
    }
    
    echo getTemplatePart('header');
    $jsonUser = json_encode($user);
    echo "<script>const user = $jsonUser;</script>";

    if (!empty($user) && $user->isLoggedIn()) {
        echo getTemplatePart('messages',  $messages);
        echo getTemplatePart('chat');
    } else {
        echo getTemplatePart('login',  $messages);
    }

    echo getTemplatePart('footer');
}

init();