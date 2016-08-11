<?php
foreach ($model->infos['editions'] AS $edition) {
	echo "\n\t".'<p>'.$edition->infos['titre'].' ('.$edition->infos['editionid'].')<br /><img src="'.$edition->infos['image']->getUrl('thumbnail').'" /><br />'.$edition->infos['langname'].'<br />'.$edition->infos['formatname'].'<br /><a href="'.$model->getSlug().'/edition/'.$edition->infos['editionid'].'/edit">Modifier</a> - <a href="'.$model->getSlug().'/edition/'.$edition->infos['editionid'].'/edit/image">Image</a></p>';
}


echo "\n\t".'<p>Administration : <a href="'.$model->getSlug().'/edition/add">Ajouter une édition</p>';