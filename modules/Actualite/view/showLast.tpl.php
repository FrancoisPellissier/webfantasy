<?php
foreach($actualites AS $actualite) {
    echo "\n\t".'<h1><a href="'.$actualite->getSlug().'">'.$actualite->infos['subject'].'</a></h1>';

    echo "\n\t".'<p>Par <em>'.$actualite->infos['poster'].'</em> le <em>'.\library\Timestamp::formatDateTime($actualite->infos['posted'], 'j mois Y', 'H:i:s').'</em></p>';
    
    echo "\n\t".parse_message(substr($actualite->infos['message'], 0, strpos(nl2br($actualite->infos['message']), '<br />')), 0);
    
    echo "\n\t".'<p><a href="'.$actualite->getSlug().'">Lire la suite</a></p>';
}
?>