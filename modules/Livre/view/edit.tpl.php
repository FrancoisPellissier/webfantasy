<form method="post">
    <p>Titre VO <input type="text" name="data[titre_vo]" value="<?php echo $model->infos['titre_vo']; ?>" /></p>
    <p>Titre VF <input type="text" name="data[titre_vf]" value="<?php echo $model->infos['titre_vf']; ?>" /></p>

    <p>Date VO <input type="text" name="data[date_vo]" value="<?php echo $model->infos['date_vo']; ?>" /></p>
    <p>Date VF <input type="text" name="data[date_vf]" value="<?php echo $model->infos['date_vf']; ?>" /></p>

    <p>Cycle : <select name="data[cycleid]">
    	<?php
    	foreach($cycles AS $id => $name) {
    		echo "\n\t\t\t".'<option value="'.$id.'"'.($id == $model->infos['cycleid'] ? ' selected="selected"' : '').'>'.$name.'</option>';
    	}
    	?>
    </select></p>
	<p>Tome <input type="text" name="data[cycleordre]" value="<?php echo $model->infos['cycleordre']; ?>" /></p>


    <p>Description :</p>
    <textarea name="data[description]" cols="70" rows="20" ><?php echo $model->infos['description']; ?></textarea>

    <p><input type="submit" value="Modifier"></p>
</form>
