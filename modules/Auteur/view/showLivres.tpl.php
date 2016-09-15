<div class="section" id="section-auteur-livres">
<?php
// dump($model->infos['livres']);
foreach($model->infos['livres'] AS $cycleid => $cycle) {
    echo '<h1>'.$cycle['titre'].'</h1>';

    foreach($cycle['livre'] AS $livreid => $livre) {
        echo '<a href="'.$livre->getSlug().'"><img title="'.$livre->infos['titre'].'" src="'.$livre->infos['image']->getUrl('thumbnail').'" /></a>';
    }
}
?>
</div>