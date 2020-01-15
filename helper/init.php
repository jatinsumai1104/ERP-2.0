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
require_once "{$app}/../classes/helper_classes/DependencyInjector.php";

$di = new DependencyInjector();
$di.set("database", new Database());
$di.set("Hash", new Hash($di));
$di.set("ErrorHandler", new ErrorHandler($di));
$di.set("Auth", new Auth($di));
// $di.set("TokenHandler", new TokenHandler($database, $hash));
$di.set("UserHelper", new UserHelper($i));
// $di.set("Mail", MailConfigHelper::getMailer());

$di.set("Product", new Product($di));
$di.set("Supplier", new Supplier($di));
$di.set("Supplier", new Category($di));

// $tokenHandler->build();
