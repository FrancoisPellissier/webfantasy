<form method="post">
    <p>Titre : <input type="text" name="data[titre]" value="<?php echo $edition->infos['titre']; ?>" /></p>

    <p>Langue : <select name="data[langid]">
        <?php
        foreach($edition->langs AS $id => $name) {
            echo "\n\t\t\t".'<option value="'.$id.'"'.($id == $edition->infos['langid'] ? ' selected="selected"' : '').'>'.$name.'</option>';
        }
        ?>
    </select></p>

    <p>Date : <input type="date" name="data[datesortie]" value="<?php echo $edition->infos['datesortie']; ?>" /></p>

    <p>Format : <select name="data[formatid]">
        <?php
        foreach($edition->formats AS $id => $name) {
            echo "\n\t\t\t".'<option value="'.$id.'"'.($id == $edition->infos['formatid'] ? ' selected="selected"' : '').'>'.$name.'</option>';
        }
        ?>
    </select></p>
    <p>Editeur : <input type="text" name="data[publisher]" value="<?php echo $edition->infos['publisher']; ?>" /></p>
    <p>Illustrateur : <input type="text" name="data[illustrateur]" value="<?php echo $edition->infos['illustrateur']; ?>" /></p>
    <p>Nb de pages : <input type="int" name="data[nbpage]" value="<?php echo $edition->infos['nbpage']; ?>" /></p>

    <p><input type="submit" value="Modifier"></p>
</form>
