<?php
if($_SERVER['SERVER_NAME'] == 'localhost') {
    define('ROOT', 'C:/xampp/htdocs/webfantasy/');
    define('PUN_ROOT', ROOT.'forum/');
    define('WWW_ROOT', 'http://localhost/webfantasy/');
    }
else if($_SERVER['SERVER_NAME'] == 'mymoviewall.com') {
    define('ROOT', '/homepages/4/d185183764/htdocs/');
    define('PUN_ROOT', ROOT.'forum/');
    define('WWW_ROOT', 'http://www.mymoviewall.com/');
}
else {
    define('ROOT', 'C:/xampp/htdocs/webfantasy/');
    define('PUN_ROOT', ROOT.'forum/');
    define('WWW_ROOT', 'http://localhost/webfantasy/');
}

// Décommenter pour passer en mode maintenance
define('MAINTENANCE_MOD', false);

require PUN_ROOT.'include/common.php';
require PUN_ROOT.'include/parser.php';

$pun_user;
$domaine = 3;

// Inclusions
require_once('library/autoload.php');

// Constantes
define('FOLDER_IMG', 'img');
define('FOLDER_IMG_CATEGORY', FOLDER_IMG.'/category');

// Timezone to date
date_default_timezone_set('Europe/Paris');
