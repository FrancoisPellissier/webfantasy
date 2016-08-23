<?php
echo "\n\t".$form->start("post");

echo "\n\t".'<p>Titre : '.$form->HTMLinput("text", "titre", 30).'</p>';
echo "\n\t".'<p>Catégorie parente : '.$form->HTMLselectObject('category_parentid', $model->infos['categories'], 'categoryid', 'titre', array('categoryid' => 0, 'titre' => '(Aucune)')).'</p>';
echo "\n\t".'<p>Description</p>'.$form->HTMLtextarea("description", 70, 5).'</p>';

echo "\n\t".$form->HTMLsubmit('Ajouter');
echo "\n\t".$form->end();
?>