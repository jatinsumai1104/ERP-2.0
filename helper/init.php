<?php
session_start();

require_once(__DIR__."/requirements.php");

$di = new DependencyInjector();
$di->set("Database", new Database());
$di->set("Hash", new Hash($di));
$di->set("ErrorHandler", new ErrorHandler($di));
$di->set("Auth", new Auth($di));
$di->set("TokenHandler", new TokenHandler($di));
$di->set("UserHelper", new UserHelper($di));
$di->set("Mail", MailConfigHelper::getMailer());
$di->set("Validator", new Validator($di));
$di->set("Product", new Product($di));
$di->set("Supplier", new Supplier($di));
$di->set("Category", new Category($di));
$di->set("Purchase", new Purchase($di));

$di->get("TokenHandler")->build();
