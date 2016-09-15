<div class="section" id="section-concours-list">
<h1>Concours<h1>

<h2>En cours</h2>

<h2>Terminés</h2>

<?php
if(!empty($concoursList)) {
    echo "\n\t".'<table>';

    foreach($concoursList AS $concours) {
        echo "\n\t\t".'<tr>';
        echo "\n\t\t\t".'<td class="image-left"><a href="'.$concours->getSlug().'"><img src="http://www.webfantasy.fr/img/concours/miniatures/concours_'.$concours->infos['formid'].'.jpg" /></a></td>';
        echo "\n\t\t\t".'<td class="texte-right">';
        echo '<h3>'.$concours->infos['titre'].'</h3>';
        echo '<p>'.$concours->infos['exemplaires'].' exemplaires à gagner</p>';
        echo '<p><a href="'.$concours->getSlug().'">Participer</a>';
        echo "\n\t\t\t".'</td>';
        echo "\n\t\t".'<tr>';
    }
    echo "\n\t".'</table>';
}
?>
</div>