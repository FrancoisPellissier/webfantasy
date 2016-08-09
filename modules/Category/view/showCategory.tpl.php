<?php
echo '<h1>'.$category->infos['titre'].'</h1>';

echo '<p>Administration : <a href="'.$model->getSlug().$category->getSlug().'/image/add">Ajouter une image</a>';

// On affiche les catégories enfants si elles existent
if(!empty($category->infos['children'])) {
    foreach($category->infos['children'] AS $cat) {

        echo '<p><a href="'.$model->getSlug().$cat->getSlug().'">'.$cat->infos['titre'].'</a></p>';
    }
}
// Sinon on affiche les image
else {
    foreach($category->infos['images'] AS $image) {

        echo '<p><img src="'.str_replace('/./', '/', 'http://www.terrygoodkind.fr/galerie/'.$image->infos['folder'].'thumbnail/TN-'.$image->infos['filename']).'" title="'.$image->infos['titre'].'" /></p>';
    }
}