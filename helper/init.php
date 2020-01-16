<?php
session_start();

$app = __DIR__;

require_once "{$app}/../classes/helper_classes/Database.php";
require_once "{$app}/../classes/helper_classes/Hash.php";
require_once "{$app}/../classes/helper_classes/ErrorHandler.php";
require_once "{$app}/../classes/helper_classes/Validator.php";
require_once "{$app}/../classes/helper_classes/Auth.php";
// require_once "{$app}/../classes/helper_classes/TokenHandler.php";
require_once "{$app}/../classes/helper_classes/UserHelper.php";
require_once "{$app}/../classes/helper_classes/MailConfigHelper.php";
require_once "{$app}/../classes/Product.class.php";
require_once "{$app}/../classes/Supplier.class.php";
require_once "{$app}/../classes/Category.class.php";
require_once "{$app}/../classes/helper_classes/Util.php";

$database = new Database();
$hash = new Hash();
$errorHandler = new ErrorHandler();
$auth = new Auth($database, $hash); //this is called as database injection
// $tokenHandler = new TokenHandler($database, $hash);
$userHelper = new UserHelper($database, $hash);
//$mail = MailConfigHelper::getMailer();
$supplierObj  = new Supplier($database);
$categoryObj = new Category($database);
// $tokenHandler->build();
