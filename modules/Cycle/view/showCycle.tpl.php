<?php
echo "\n\t".'<h1>'.$model->infos['titre'].'</h1>';

echo "\n\t".nl2br($model->infos['description']);

echo "\n\t".'<p>Administration : <a href="'.$model->getSlug().'/edit">Modifier</p>';