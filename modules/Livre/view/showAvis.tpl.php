<?php
if(!empty($model->infos['avis'])) {
    foreach($model->infos['avis'] AS $post) {
        echo "\n\t".'<h3>Par <em>'.$post->infos['poster'].'</em> le <em>'.\library\Timestamp::formatDateTime($post->infos['posted'], 'j mois Y', 'H:i:s').'</em></h3>';
        echo "\n\t".parse_message($post->infos['message'], 0);        
    }
}