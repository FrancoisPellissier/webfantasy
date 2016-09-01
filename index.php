<?php
require_once('assets/config/config.php');

$app = new library\Application($domaine, $pun_user);
$app->run();
