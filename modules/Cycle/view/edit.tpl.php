<form method="post">
    <p>Titre VO <input type="text" name="data[titre_vo]" value="<?php echo $model->infos['titre_vo']; ?>" /></p>
    <p>Titre VF <input type="text" name="data[titre_vf]" value="<?php echo $model->infos['titre_vf']; ?>" /></p>
    <p>Cycle : <input type="radio" id="is_cycle_oui" name="data[is_cycle]" value="1"<?php echo ($model->infos['is_cycle'] ? ' checked' : ''); ?> /> <label for="is_cycle_oui">Oui</label> / <input type="radio" id="is_cycle_non" name="data[is_cycle]" value="0"<?php echo (!$model->infos['is_cycle'] ? ' checked' : ''); ?> /> <label for="is_cycle_non">Non</label></p>

    <p>Description :</p>
    <textarea name="data[description]" cols="70" rows="20" ><?php echo $model->infos['description']; ?></textarea>

    <p><input type="submit" value="Modifier"></p>
</form>
