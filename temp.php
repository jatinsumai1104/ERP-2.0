<?php
require_once ("classes/helper_classes/MailConfigHelper.php");

echo "hello";

$ini_array = parse_ini_file("config.ini");

echo $ini_array['username'];

$tp = new MailConfigHelper();

echo $tp->temp();

echo MailConfigHelper::temp();


echo "Hello My name is Jatin Sumai";
?>