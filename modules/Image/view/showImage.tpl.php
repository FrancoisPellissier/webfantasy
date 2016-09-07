<?php
echo '<h1>'.$image->infos['title'].'</h1>';
echo '<p><a href="'.$image->getUrl('large').'"><img src="'.$image->getUrl('medium').'" /></a></p>';
echo '<p>'.$image->infos['commentaire'].'</p>';

if($user->checkRight()) {
    echo '<p><a href="'.$model->getSlug().$category->getSlug().'/image/'.$image->infos['imageid'].'/edit">Modifier</a></p>';
}

if(isset($category->infos['previous'])) {
    echo '<p><a href="'.$model->getSlug().$category->getSlug().'/image/'.$category->infos['previous']->infos['imageid'].'"><img src="'.$category->infos['previous']->getUrl('thumbnail').'" /></a></p>';
}
if(isset($category->infos['next'])) {
    echo '<p><a href="'.$model->getSlug().$category->getSlug().'/image/'.$category->infos['next']->infos['imageid'].'"><img src="'.$category->infos['next']->getUrl('thumbnail').'" /></a></p>';
}