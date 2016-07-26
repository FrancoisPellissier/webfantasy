<form method="post">
    <p>Titre VO <input type="text" name="data[titre_vo]" value="<?php echo $model->infos['titre_vo']; ?>" /></p>
    <p>Titre VF <input type="text" name="data[titre_vf]" value="<?php echo $model->infos['titre_vf']; ?>" /></p>

    <p>Description :</p>
    <textarea name="data[description]" cols="70" rows="20" ><?php echo $model->infos['description']; ?></textarea>

    <p><input type="submit" value="Modifier"></p>
</form>
