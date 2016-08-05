<?php
echo $category->infos['titre'];

// On affiche les catégories enfants si elles existent
if(!empty($category->infos['children'])) {
    foreach($category->infos['children'] AS $cat) {

        echo '<p><a href="'.$model->getSlug().$cat->getSlug().'">'.$cat->infos['titre'].'</a></p>';
    }
}
// Sinon on affiche les image
else {

}