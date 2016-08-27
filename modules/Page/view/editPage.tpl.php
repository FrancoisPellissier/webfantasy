<?php
echo "\n\t".$form->start("post");

echo "\n\t".'<p>Titre : '.$form->HTMLinput("text", "titre", 30).'</p>';
echo "\n\t".'<p>Page parente : '.$form->HTMLselectObject('page_parent_id', $model->infos['pages'], 'pageid', 'titre', array('pageid' => 0, 'titre' => '(Aucune)')).'</p>';

echo "\n\t".'<p>Extrait</p>'.$form->HTMLtextarea("extrait", 70, 4).'</p>';
echo "\n\t".'<p>Texte complet</p>'.$form->HTMLtextarea("texte", 70, 20).'</p>';

echo "\n\t".'<p>Source : '.$form->HTMLinput("text", "source", 70).'</p>';
echo "\n\t".'<p>Traducteur : '.$form->HTMLinput("text", "traducteur", 30).'</p>';

echo "\n\t".$form->HTMLsubmit('Modifier');
echo "\n\t".$form->end();
?>
