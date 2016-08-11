<?php
echo "\n\t".'<h1>'.$model->infos['titre'].'</h1>';

echo parse_message($model->infos['description'], 0);

echo "\n\t".'<p>Administration : <a href="'.$model->getSlug().'/edit">Modifier</a> - <a href="'.$model->getSlug().'/edit/image">Choisir image</a></p>';