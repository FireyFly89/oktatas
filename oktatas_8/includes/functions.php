<?php

define("ROOT_DIR", dirname(__DIR__));
require_once "includes/utilities.php";
require_once "includes/fileHandler.php";
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
// TODO: Autoloader
// Framework-ök: Laravel, Symfony, Yii, CakePHP, CodeIgniter
// SQL fajták: PostreSQL, MySQL, MsSQL, OracleDB
// SQL = Structured Query Language
// NoSQL fajták: Elasticsearch, ?
// SQL connector: PDO, MySqli

function init()
{
    if (!empty($_POST)) {
        $user = new UserController($_POST);
    }
}

function getUserData() {
    $dbManager = new DatabaseManager();
    dd($dbManager->read('users'));
}

init();