<?php

$app = __DIR__;

// Helper Class
require_once "{$app}/../classes/helper_classes/Database.php";
require_once "{$app}/../classes/helper_classes/Hash.php";
require_once "{$app}/../classes/helper_classes/ErrorHandler.php";
require_once "{$app}/../classes/helper_classes/Validator.php";
require_once "{$app}/../classes/helper_classes/Auth.php";
require_once "{$app}/../classes/helper_classes/TokenHandler.php";
require_once "{$app}/../classes/helper_classes/UserHelper.php";
require_once "{$app}/../classes/helper_classes/MailConfigHelper.php";
require_once "{$app}/../classes/helper_classes/Util.php";
require_once "{$app}/../classes/helper_classes/DependencyInjector.php";
require_once "{$app}/../classes/helper_classes/Session.php";



// Project Related Classes
require_once "{$app}/../classes/Product.class.php";
require_once "{$app}/../classes/Supplier.class.php";
require_once "{$app}/../classes/Category.class.php";
require_once "{$app}/../classes/Purchase.class.php";
require_once "{$app}/../classes/Customer.class.php";
