<?php
echo '<h1>'.$model->infos['titre'].'</h1>';

$errors = array();
$errors[1] = '<p>Vous n\'avez pas correctement répondu à la question "Captcha", votre participation ne peut pas être prise en compte.</p><p><a href="javascript:history.back()">Ré-essayer</a></p>';
$errors[2] = '<p>Vous n\'avez pas accepté le règlement du concours, votre participation ne peut pas être prise en compte.</p><p><a href="javascript:history.back()">Ré-essayer</a></p>';
$errors[3] = '<p>Vous n\'avez pas renseigné l\'ensemble de vos coordonnées, votre participation ne peut pas être prise en compte.</p><p><a href="javascript:history.back()">Ré-essayer</a></p>';

if(isset($errors[$error])) {
    echo $errors[$error];
}
