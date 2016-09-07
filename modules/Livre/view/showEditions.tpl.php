<?php
foreach ($model->infos['editions'] AS $edition) {
	echo "\n\t".'<p>'.$edition->infos['titre'].' ('.$edition->infos['editionid'].')<br /><img src="'.$edition->infos['image']->getUrl('thumbnail').'" /><br />'.$edition->infos['langname'].'<br />'.$edition->infos['formatname'];
    
    if($user->checkRight()) {
        echo '<br /><a href="'.$model->getSlug().'/edition/'.$edition->infos['editionid'].'/edit">Modifier</a> - <a href="'.$model->getSlug().'/edition/'.$edition->infos['editionid'].'/edit/image">Image</a> - <a href="'.$model->getSlug().'/edition/'.$edition->infos['editionid'].'/sortie/v'.($edition->infos['langid'] == 1 ? 'f' : 'o').'">Prochaine sortie</a>';
    }
    echo '</p>';
}

if($user->checkRight()) {
    echo "\n\t".'<p>Administration : <a href="'.$model->getSlug().'/edition/add">Ajouter une édition</p>';
}