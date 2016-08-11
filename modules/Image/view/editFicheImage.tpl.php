<?php
echo "\n\t".$form->start("post");
echo $form->HTMLradio('pictureid', $images, ' | ');
echo "\n\t".$form->HTMLsubmit('Ajouter');
echo "\n\t".$form->end();