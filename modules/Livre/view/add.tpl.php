<?php
echo "\n\t".$form->start("post");

echo "\n\t".'<p>Titre VO : '.$form->HTMLinput("text", "titre_vo", 30).'</p>';
echo "\n\t".'<p>Titre VF : '.$form->HTMLinput("text", "titre_vf", 30).'</p>';

echo "\n\t".'<p>Date VO : '.$form->HTMLinput("date", "date_vo").'</p>';
echo "\n\t".'<p>Date VF : '.$form->HTMLinput("date", "date_vf").'</p>';

echo "\n\t".'<p>Cycle : '.$form->HTMLselect('cycleid', $cycles).'</p>';
echo "\n\t".'<p>Tome : '.$form->HTMLinput("number", "cycleordre").'</p>';

echo "\n\t".'<p>Description</p>'.$form->HTMLtextarea("description", 70, 20).'</p>';

echo "\n\t".$form->HTMLsubmit('Ajouter');
echo "\n\t".$form->end();
?>

