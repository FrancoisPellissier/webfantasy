<form method="post">
    <p>Titre : <input type="text" name="data[titre]" /></p>
    
    <p>Page parent : <select name="data[page_parent_id]">
        <?php
        echo "\n\t\t\t".'<option value="0">(Aucune)</option>';
        foreach($model->infos['pages'] AS $page) {
            echo "\n\t\t\t".'<option value="'.$page->infos['pageid'].'">'.$page->infos['titre'].'</option>';
        }
        ?>
    </select></p>

    <p>Extrait :</p>
    <textarea name="data[extrait]" cols="70" rows="4" ></textarea>

    <p>Texte complet :</p>
    <textarea name="data[texte]" cols="70" rows="20" ></textarea>

    <p>Source : <input type="text" name="data[source]" /></p>
    <p>Traducteur : <input type="text" name="data[traducteur]" /></p>

    <p><input type="submit" value="Ajouter"></p>
</form>
<?php
dump($user);