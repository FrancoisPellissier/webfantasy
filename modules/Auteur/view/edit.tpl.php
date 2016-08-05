<?php
echo "\n\t".$form->start("post");

echo "\n\t".'<p>Prénom : '.$form->HTMLinput("text", "firstname", 30).'</p>';
echo "\n\t".'<p>Nom : '.$form->HTMLinput("text", "lastname", 30).'</p>';

echo "\n\t".'<p>Description</p>'.$form->HTMLtextarea("description", 70, 20).'</p>';

echo "\n\t".$form->HTMLsubmit('Modifier');
echo "\n\t".$form->end();
?>