<h1>Concours<h1>

<h2>En cours</h2>

<h2>Terminés</h2>
<?php
foreach($concoursList AS $concours) {
    echo '<h3>'.$concours->infos['titre'].'</h3>';
    echo '<p>'.$concours->infos['exemplaires'].' exmplaires à gagner</p>';
    echo '<p><a href="'.$concours->getSlug().'">Participer</a>';
}