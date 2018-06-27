<?php

//error_reporting(0);

date_default_timezone_set('Africa/Cairo');

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
defined('SITE_ROOT') ? null : define('SITE_ROOT', DS . 'opt' . DS . 'lampp' . DS . 'htdocs' . DS . 'demo1');
defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT . DS . 'includes' . DS);
defined('CON_PATH') ? null : define('CON_PATH', SITE_ROOT . DS . 'controller' . DS);
defined('SITE_NAME_BIG') ? null : define('SITE_NAME_BIG', 'PROPER BRITISH CONTRACTORS EGYPT S.A.E');
defined('SITE_NAME_SMALL') ? null : define('SITE_NAME_SMALL', 'Proper British Contractors Egypt S.A.E');
defined('SITE_NAME_SHORT') ? null : define('SITE_NAME_SHORT', 'PBC Egypt S.A.E');
defined('SITE_NAME_NO_EG') ? null : define('SITE_NAME_NO_EG', 'Proper British Contractors');
defined('SITE_NAME_EG') ? null : define('SITE_NAME_EG', 'Egypt S.A.E');

defined('SITE_MAIL') ? null : define('SITE_MAIL', 'amirhamdy4@gmail.com');

defined('UPLOAD_DIR') ? null : define('UPLOAD_DIR', SITE_ROOT . DS . 'uploads');
defined('PO_NUMBERS_DIR') ? null : define('PO_NUMBERS_DIR', UPLOAD_DIR . DS . 'PO_NUMBERS' . DS);
defined('INVOICES_DIR') ? null : define('INVOICES_DIR', UPLOAD_DIR . DS . 'INVOICES' . DS);

// App Files
//require_once( 'app_config.php');
require_once( 'app_database.php');
require_once( 'app_functions.php');
require_once( 'app_session.php');

//  =============================================


