<?php
echo "\n\t".$form->start('post');

echo "\n\t".'<p>Titre : '.$form->HTMLinput('text', 'titre', 30).'</p>';
echo "\n\t".'<p>Langue : '.$form->HTMLselect('langid', $edition->langs).'</p>';
echo "\n\t".'<p>Date : '.$form->HTMLinput('date', 'datesortie').'</p>';
echo "\n\t".'<p>Format : '.$form->HTMLselect('formatid', $edition->formats).'</p>';

echo "\n\t".'<p>Editeur : '.$form->HTMLinput('text', 'publisher', 30).'</p>';
echo "\n\t".'<p>Illustrateur : '.$form->HTMLinput('text', 'illustrateur', 30).'</p>';
echo "\n\t".'<p>Nb de pages : '.$form->HTMLinput('number', 'nbpage').'</p>';

echo "\n\t".$form->HTMLsubmit('Modifier');
echo "\n\t".$form->end();
?>