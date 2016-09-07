<?php
echo '<h1>'.$category->infos['titre'].'</h1>';

if($user->checkRight()) {
    echo '<p>Administration : <a href="'.$model->getSlug().$category->getSlug().'/image/add">Ajouter une image</a> | <a href="'.$model->getSlug().$category->getSlug().'/edit">Modifier la catégorie</a> | <a href="'.$model->getSlug().$category->getSlug().'/add">Ajouter une catégorie</a>';
}

// On affiche les catégories enfants si elles existent
if(!empty($category->infos['children'])) {
    foreach($category->infos['children'] AS $cat) {

        echo '<p><a href="'.$model->getSlug().$cat->getSlug().'">'.$cat->infos['titre'].'</a></p>';
    }
}
// Sinon on affiche les image
else {
    foreach($category->infos['images'] AS $image) {
        $image->migrate();

        echo '<p><a href="'.$model->getSlug().$category->getSlug().'/image/'.$image->infos['imageid'].'"><img src="'.$image->infos['folder'].'/thumbnail/'.$image->infos['filename'].'" title="'.$image->infos['titre'].'" /></a></p>';
    }
}