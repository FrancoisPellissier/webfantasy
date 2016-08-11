<?php
echo '<h1>'.$image->infos['title'].'</h1>';
echo '<p><img src="'.$image->getUrl('medium').'" /></p>';
echo '<p>'.$image->infos['commentaire'].'</p>';
echo '<p><a href="'.$model->getSlug().$category->getSlug().'/image/'.$image->infos['imageid'].'/edit">Modifier</a></p>';