<?php
if($_SERVER['SERVER_NAME'] == 'localhost') {
    define('ROOT', 'C:/xampp/htdocs/webfantasy_vf/');
    define('PUN_ROOT', ROOT.'forum/');
    define('WWW_ROOT', 'http://localhost/webfantasy_vf/');
    }
else if($_SERVER['SERVER_NAME'] == 'mymoviewall.com') {
    define('ROOT', '/homepages/4/d185183764/htdocs/');
    define('PUN_ROOT', ROOT.'forum/');
    define('WWW_ROOT', 'http://www.mymoviewall.com/');
}
else {
    define('ROOT', 'C:/xampp/htdocs/webfantasy_vf/');
    define('PUN_ROOT', ROOT.'forum/');
    define('WWW_ROOT', 'http://localhost/webfantasy_vf/');
}

require PUN_ROOT.'include/common.php';
require PUN_ROOT.'include/parser.php';

global $pun_user;

// Inclusions
require_once('library/autoload.php');

// Constantes
define('FOLDER_IMAGES', 'img');

// Timezone to date
date_default_timezone_set('Europe/Paris');
