<div id="right">
    <div id="contenu-right">
        <div id="arbo">
            <?php
            echo "\n\t".'<a href="'.WWW_ROOT.'">Accueil</a>';

            // Données tests temporaires
            if(empty($fil_ariane)) {
                $fil_ariane = array(
                    array('url' => '', 'title' => 'Terry Goodkind'),
                    array('url' => '', 'title' => 'L\'Épée de Vérité'),
                    array('url' => '', 'title' => 'La Première Leçon du Sorcier'),
                    array('url' => '', 'title' => 'Éditions')
                    );

                foreach($fil_ariane AS $ariane) {
                    echo ' > <a href="'.$ariane['url'].'">'.$ariane['title'].'</a>';
                }
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