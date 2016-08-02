<?php
include('assets/config/menu.php');


?>
<div id="site">
    <div id="header"></div>
    <div id="sous-header">
        <div id="mh">
            <?php
            foreach($menuItems[$domaine] AS $menuItem) {
                echo "\n\t\t\t".'<a href="'.$menuItem['url'].'">'.$menuItem['title'].'</a>';
            }
            ?>
        </div>
    </div>