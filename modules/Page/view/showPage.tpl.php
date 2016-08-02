<?php
echo "\n\t".'<h1>'.$page->infos['titre'].'</h1>';

echo "\n\t".'<hp>'.parse_message($page->infos['texte'], 0).'</p>';

// La page possède des pages enfants ?
if(!empty($page->infos['childpages'])) {
	echo "\n".'<h2>Pages enfants</h2>';

	foreach($page->infos['childpages'] AS $child) {
		echo "\n\t".'<p><a href="'.$model->getSlug().$child->getSlug().'">'.$child->infos['titre'].'</a></p>';
	}
}


echo "\n\t".'<p>Administration : <a href="'.$model->getSlug().$page->getSlug().'/edit">Modifier</p>';