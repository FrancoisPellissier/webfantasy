<div id="right">
    <div id="contenu-right">
        <div id="arbo">
            <?php
            // Affichage du fil d'Ariane
            echo "\n\t".'<a href="'.WWW_ROOT.'">Accueil</a>';
            foreach($fil_ariane AS $ariane) {
                echo ' > <a href="'.$ariane['url'].'">'.$ariane['title'].'</a>';
            }
            ?>
        </div>
<?php
// Contenu du site
require_once($view);
?>
        </div>
    </div>
    </div>
</div>
<span class="spacer">-</span>