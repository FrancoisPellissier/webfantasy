<form method="post">
    <p>Titre : <input type="text" name="data[titre]" value="<?php echo $page->infos['titre']; ?>" /></p>
    
    <p>Page parent : <select name="data[page_parent_id]">
        <?php
        echo "\n\t\t\t".'<option value="0">(Aucune)</option>';
        foreach($model->infos['pages'] AS $pages) {
            echo "\n\t\t\t".'<option value="'.$pages->infos['pageid'].'"'.($pages->infos['pageid'] == $page->infos['page_parent_id'] ? ' selected="selected"' : '').'>'.$pages->infos['titre'].'</option>';
        }
        ?>
    </select></p>

    <p>Extrait :</p>
    <textarea name="data[extrait]" cols="70" rows="4" ><?php echo $page->infos['extrait']; ?></textarea>

    <p>Texte complet :</p>
    <textarea name="data[texte]" cols="70" rows="20"><?php echo $page->infos['texte']; ?></textarea>

    <p>Source : <input type="text" name="data[source]" value="<?php echo $page->infos['source']; ?>" /></p>
    <p>Traducteur : <input type="text" name="data[traducteur]" value="<?php echo $page->infos['traducteur']; ?>" /></p>

    <p><input type="submit" value="Modifier"></p>
</form>
<?php
dump($user);