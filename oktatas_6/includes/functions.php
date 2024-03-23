<?php
define("ROOT_DIR", dirname(__DIR__));
require_once "includes/utilities.php";
require_once "includes/fileHandler.php";
require_once "includes/Traits/UnderscoreColumns.php";
require_once "includes/Helpers/DatabaseManager.php";
require_once "includes/Models/User.php";
require_once "includes/Helpers/SessionManager.php";
require_once "includes/Helpers/ErrorSessionManager.php";
require_once "includes/Helpers/Validation.php";
require_once "includes/Helpers/ValidationError.php";
require_once "includes/Controllers/UserController.php";
// TODO: Autoloader
// Framework-ök: Laravel, Symfony, Yii, CakePHP, CodeIgniter
// Mysql connector: PDO, MySqli

function init()
{
    if (!empty($_POST)) {
        $user = new UserController($_POST);
    }
}

init();
