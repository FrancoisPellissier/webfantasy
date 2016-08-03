<form method="post">
    <p>Titre : <input type="text" name="data[titre]" value="<?php echo $model->infos['titre']; ?>" /></p>

    <p>Langue : <select name="data[langid]">
        <?php
        foreach($edition->langs AS $id => $name) {
            echo "\n\t\t\t".'<option value="'.$id.'">'.$name.'</option>';
        }
        ?>
    </select></p>

    <p>Date : <input type="date" name="data[datesortie]" value="" /></p>

    <p>Format : <select name="data[cycleid]">
        <?php
        foreach($edition->formats AS $id => $name) {
            echo "\n\t\t\t".'<option value="'.$id.'">'.$name.'</option>';
        }
        ?>
    </select></p>
    <p>Editeur : <input type="text" name="data[publisher]" value="" /></p>
    <p>Illustrateur : <input type="text" name="data[illustrateur]" value="" /></p>
    <p>Nb de pages : <input type="int" name="data[nbpage]" value="" /></p>

    <p><input type="submit" value="Créer"></p>
</form>
