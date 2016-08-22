<?php
echo "\n\t".'<p>Acrhives : <select name="periode" id="periode" onChange="choosePeriode()">';
echo "\n\t\t".'<option value="">Choix de la période</option>';

$list_mois = array(1 => 'janvier', 2 => 'février', 3 => 'mars', 4 => 'avril', 5 => 'mai', 6 => 'juin', 7 => 'juillet', 8 => 'août', 9 => 'septembre', 10 => 'octobre', 11 => 'novembre', 12 => 'décembre');

foreach($list_months AS $month) {

    if($actualite->annee == $month['annee'] && $actualite->mois == $month['mois']) {
        $test = ' selected="selected"';
    }
    else {
        $test = '';
    }


    echo "\n\t\t".'<option value="'.$month['annee'].'/'.$month['mois'].'"'.$test.'>'.ucwords($list_mois[$month['mois']]).' '.$month['annee'].'</option>';
}

echo "\n\t".'</select></p>';


if(empty($actualites)) {
    echo "\n\t".'<p>Aucune actualité pour cette période</p>';
}
else {
    foreach($actualites AS $actualite) {
        echo "\n\t".'<h1><a href="'.$actualite->getSlug().'">'.$actualite->infos['subject'].'</a></h1>';

        echo "\n\t".'<p>Par <em>'.$actualite->infos['poster'].'</em> le <em>'.\library\Timestamp::formatDateTime($actualite->infos['posted'], 'j mois Y', 'H:i:s').'</em></p>';
        
        echo "\n\t".parse_message(substr($actualite->infos['message'], 0, strpos(nl2br($actualite->infos['message']), '<br />')), 0);
        
        echo "\n\t".'<p><a href="'.$actualite->getSlug().'">Lire la suite</a></p>';
    }
}
?>