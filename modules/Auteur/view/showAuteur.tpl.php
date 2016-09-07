<?php

echo "\n\t".'<h1>'.$model->infos['fullname'].'</h1>';

echo parse_message($model->infos['description'], 0);

if($user->checkRight()) {
    echo "\n\t".'<p>Administration : <a href="'.$model->getSlug().'/edit">Modifier</a> |  <a href="cycle/'.$model->infos['auteurid'].'/add">Ajouter un cycle</a> | <a href="livre/'.$model->infos['auteurid'].'/add">Ajouter un livre</a> - <a href="'.$model->getSlug().'/edit/image">Choisir image</a></p>';
}