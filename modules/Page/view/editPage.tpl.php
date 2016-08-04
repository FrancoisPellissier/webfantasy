<?php
echo "\n\t".$form->start("post");

echo "\n\t".'<p>Titre : '.$form->HTMLinput("text", "titre", 30).'</p>';
echo "\n\t".'<p>Page parente : '.$form->HTMLselect('page_parent_id', $model->infos['pages_array']).'</p>';

// echo "\n\t\t\t".'<option value="'.$page->infos['pageid'].'">'.$page->infos['titre'].'</option>';

echo "\n\t".'<p>Extrait</p>'.$form->HTMLtextarea("extrait", 70, 4).'</p>';
echo "\n\t".'<p>Texte complet</p>'.$form->HTMLtextarea("texte", 70, 20).'</p>';

echo "\n\t".'<p>Source : '.$form->HTMLinput("text", "source", 70).'</p>';
echo "\n\t".'<p>Traducteur : '.$form->HTMLinput("text", "traducteur", 30).'</p>';

echo "\n\t".$form->HTMLsubmit('Ajouter');
echo "\n\t".$form->end();
?>
