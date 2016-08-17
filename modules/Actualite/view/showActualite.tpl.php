<?php
echo '<h1>'.$model->infos['subject'].'</h1>';

echo "\n\t".'<p>Par <em>'.$model->infos['poster'].'</em> le <em>'.$model->infos['posted'].'</em></p>';
    
echo "\n\t".parse_message($model->infos['message'], 0);

if(!empty($model->infos['comments'])) {
    foreach($model->infos['comments'] AS $comment) {
        echo "\n\t".'<h3>Par <em>'.$comment->infos['poster'].'</em> le <em>'.$comment->infos['posted'].'</em></h3>';
        echo "\n\t".parse_message($comment->infos['message'], 0);        
    }
}