<div class="section" id="section-livre-fiche">
    <?php
    echo "\n\t".'<h1>'.$model->infos['titre'].'</h1>';
    ?>
    <table>
        <tr>
            <td class="fiche-left">
        <?php
            echo "\n\t".'<img src="'.$model->infos['image']->getUrl('small').'" />';
        ?>
            </td>
            <td class="fiche-right">
        <?php
            echo "\n\t".'<p><strong>Titre original :</strong> '.$model->infos['titre_vo'].'</p>';
            echo "\n\t".'<p><strong>Titre français :</strong> '.$model->infos['titre_vf'].'</p>';

            // Infos de cycle si fait partie d'un cycle


            echo "\n\t".'<p><strong>Date de sortie originale :</strong> '.$model->infos['date_vo'].'</p>';
            echo "\n\t".'<p><strong>Date de sortie française :</strong> '.$model->infos['date_vf'].'</p>';

            echo "\n\t".'<p><strong>Présentation :</strong><br/>';
            echo parse_message($model->infos['description'], 0);
        ?>
            </td>
        </tr>
    </table>
    <?php
    
    if($user->checkRight()) {
        echo "\n\t".'<p>Administration : <a href="'.$model->getSlug().'/edit">Modifier</a> - <a href="'.$model->getSlug().'/edit/image">Choisir image</a></p>';
    }
    ?>
</div>