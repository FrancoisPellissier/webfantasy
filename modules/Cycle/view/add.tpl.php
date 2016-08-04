<?php
echo "\n\t".$form->start("post");

echo "\n\t".'<p>Titre VO : '.$form->HTMLinput("text", "titre_vo", 30).'</p>';
echo "\n\t".'<p>Titre VF : '.$form->HTMLinput("text", "titre_vf", 30).'</p>';

echo "\n\t\t\t".'<p>Cycle : <input type="radio" id="is_cycle_oui" name="data[is_cycle]" value="1" /> <label for="is_cycle_oui">Oui</label> / <input type="radio" id="is_cycle_non" name="data[is_cycle]" value="0" /> <label for="is_cycle_non">Non</label></p>';

echo "\n\t".'<p>Description</p>'.$form->HTMLtextarea("description", 70, 20).'</p>';

echo "\n\t".$form->HTMLsubmit('Modifier');
echo "\n\t".$form->end();
?>