<?php
echo "\n\t".'<p>Acrhives : <select name="periode" id="periode" onChange="choosePeriode()">';
foreach($list_months AS $month) {

    if($actualite->annee == $month['annee'] && $actualite->mois == $month['mois']) {
        $test = ' selected="selected"';
    }
    else {
        $test = '';
    }


    echo "\n\t\t".'<option value="'.$month['annee'].'/'.$month['mois'].'"'.$test.'>'.$month['periode'].'</option>';
}

echo "\n\t".'</select></p>';



foreach($actualites AS $actualite) {
    echo "\n\t".'<h1><a href="'.$actualite->getSlug().'">'.$actualite->infos['subject'].'</a></h1>';

    echo "\n\t".'<p>Par <em>'.$actualite->infos['poster'].'</em> le <em>'.$actualite->infos['posted'].'</em></p>';
    
    echo "\n\t".parse_message(substr($actualite->infos['message'], 0, strpos(nl2br($actualite->infos['message']), '<br />')), 0);
    
    echo "\n\t".'<p><a href="'.$actualite->getSlug().'">Lire la suite</a></p>';
}
?>