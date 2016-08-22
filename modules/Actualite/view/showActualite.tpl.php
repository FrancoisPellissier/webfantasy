<?php
echo '<h1>'.$model->infos['subject'].'</h1>';

echo "\n\t".'<p>Par <em>'.$model->infos['poster'].'</em> le <em>'.\library\Timestamp::formatDateTime($model->infos['posted'], 'j mois Y', 'H:i:s').'</em></p>';
    
echo "\n\t".parse_message($model->infos['message'], 0);


echo "\n\t".'<p>Vous ne voulez manquer aucune nouveautée ? <a href="newsletter">Inscrivez-vous à la newsletter</a></p>';

if(!empty($model->infos['comments'])) {
    foreach($model->infos['comments'] AS $comment) {
        echo "\n\t".'<h3>Par <em>'.$comment->infos['poster'].'</em> le <em>'.\library\Timestamp::formatDateTime($comment->infos['posted'], 'j mois Y', 'H:i:s').'</em></h3>';
        echo "\n\t".parse_message($comment->infos['message'], 0);        
    }
}