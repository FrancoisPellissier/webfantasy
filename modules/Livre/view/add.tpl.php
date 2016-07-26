<form method="post">
    <p>Titre VO <input type="text" name="data[titre_vo]" value="" /></p>
    <p>Titre VF <input type="text" name="data[titre_vf]" value="" /></p>

    <p>Date VO <input type="text" name="data[date_vo]" value="" /></p>
    <p>Date VF <input type="text" name="data[date_vf]" value="" /></p>

    <p>Cycle : <select name="data[cycleid]">
    	<?php
    	foreach($cycles AS $id => $name) {
    		echo "\n\t\t\t".'<option value="'.$id.'">'.$name.'</option>';
    	}
    	?>
    </select></p>
	<p>Tome <input type="text" name="data[cycleordre]" value="" /></p>


    <p>Description :</p>
    <textarea name="data[description]" cols="70" rows="20" ></textarea>

    <p><input type="submit" value="Créer"></p>
</form>
