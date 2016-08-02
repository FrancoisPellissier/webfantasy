<?php

echo "\n\t".'<h1>'.$model->infos['fullname'].'</h1>';

echo parse_message($model->infos['description'], 0);

echo "\n\t".'<p>Administration : <a href="cycle/'.$model->infos['auteurid'].'/add">Ajouter un cycle</a> | <a href="livre/'.$model->infos['auteurid'].'/add">Ajouter un livre</a></p>';