<?php
session_start();

$app = __DIR__;

require_once "{$app}/../helper_classes/classes/Database.php";
require_once "{$app}/../helper_classes/classes/Hash.php";
require_once "{$app}/../helper_classes/classes/ErrorHandler.php";
require_once "{$app}/../helper_classes/classes/Validator.php";
require_once "{$app}/../helper_classes/classes/Auth.php";
require_once "{$app}/../helper_classes/classes/TokenHandler.php";
require_once "{$app}/../helper_classes/classes/UserHelper.php";
require_once "{$app}/../helper_classes/classes/MailConfigHelper.php";


$database = new Database();
$hash = new Hash();
$errorHandler = new ErrorHandler();
$auth = new Auth($database, $hash); //this is called as database injection
$tokenHandler = new TokenHandler($database, $hash);
$userHelper = new UserHelper($database, $hash);
$mail = MailConfigHelper::getMailer();

$tokenHandler->build();
$auth->build();