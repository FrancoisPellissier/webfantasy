<?php
echo "\n\t".$form->start("post");

echo "\n\t".'<p>Titre VO : '.$form->HTMLinput("text", "titre_vo", 30).'</p>';
echo "\n\t".'<p>Titre VF : '.$form->HTMLinput("text", "titre_vf", 30).'</p>';

$radio = array();
$radio[1] = 'Oui';
$radio[0] = 'Non';

echo "\n\t\t\t".'<p>Cycle : '.$form->HTMLradio('is_cycle', $radio, ' / ').'</p>';

echo "\n\t".'<p>Description</p>'.$form->HTMLtextarea("description", 70, 20).'</p>';

echo "\n\t".$form->HTMLsubmit('Modifier');
echo "\n\t".$form->end();
?>