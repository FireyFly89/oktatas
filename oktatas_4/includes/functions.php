<?php
session_start();
const ROOT_DIR = "/var/www/secondproject/oktatas_3/";
require_once "includes/utilities.php";
require_once "includes/fileHandler.php";
require_once "includes/Models/User.php";
require_once "includes/Helpers/Validation.php";
require_once "includes/Helpers/ValidationError.php";
require_once "includes/Controllers/FormController.php";
// TODO: Autoloader

function init()
{
    if (!empty($_POST)) {
        $user = new FormController($_POST);
    }
}

init();
