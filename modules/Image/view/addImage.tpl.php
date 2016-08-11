<?php
echo "\n\t".$form->start("post", "", true);

echo "\n\t".'<p>Titre : '.$form->HTMLinput("text", "title", 30).'</p>';
echo "\n\t".'<p>Fichier : '.$form->HTMLinputFile("req_file").'</p>';
echo "\n\t".'<p>Description</p>'.$form->HTMLtextarea("commentaire", 70, 5).'</p>';

echo "\n\t".$form->HTMLsubmit('Ajouter');
echo "\n\t".$form->end();
?>