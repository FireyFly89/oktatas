<?php
session_start();
CONST ROOT_DIR = "/var/www/secondproject/oktatas_3/";
require_once("includes/classes/FormHandler.php");
if (!empty($_POST)) {
    $formHandler = new FormHandler();
}

require_once("includes/utilities.php");
require_once("includes/formHandler.php");
require_once("includes/fileHandler.php");

if (!empty($_POST)) {
    $formHandler->processUserData($_POST);
}

//$assistanceUser = new AssistanceUser();
//$assistanceUser->delete();