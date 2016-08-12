<form action="">
<?php
echo '<h1>'.$model->infos['titre'].'</h1>';

foreach($model->infos['question'] AS $questionid => $question) {
    echo "\n\t".'<fieldset>';
    echo "\n\t\t".'<legend>'.$question['libelle'].'</legend>';

    foreach($question['answer'] AS $answerid => $answer) {
        echo "\n\t\t\t".'<p><input type="radio" id="a'.$answerid.'" name="question['.$questionid.']" value="'.$answerid.'" /> <label for="a'.$answerid.'">'.$answer.'</label></p>';
    }

    echo "\n\t".'</fieldset>';
}
?>

<fieldset>
<legend>Coordonnées</legend>
<table>
    <tr>
        <td>Nom (*):</td>
        <td><input type='text' id='nom' name='nom' size='20' /></td>
    </tr>
    <tr>
        <td>Prénom (*):</td>
        <td><input type='text' id='prenom' name='prenom' size='20' /></td>
    </tr>
    <tr>
        <td>Adresse (*):</td>
        <td><input type='text' id='adr_1' name='adr_1' size='50' /></td>
    </tr>
    <tr>
        <td>Adresse (suite) :</td>
        <td><input type='text' name='adr_2' size='50' /></td>
    </tr>
    <tr>
        <td>Code postal (*):</td>
        <td><input type='text' id='cp' name='cp' size='10' /></td>
    </tr>
    <tr>
        <td>Ville (*):</td>
        <td><input type='text' id='ville' name='ville' size='20' /></td>
    </tr>
    <tr>
        <td>Pays (*):</td>
        <td><input type='text' id='pays' name='pays' size='20' /></td>
    </tr>
    <tr>
        <td>E-mail (*):</td>
        <td><input type='text' id='email' name='email' size='30' /></td>
    </tr>
</table>
</fieldset>
<fieldset>

<p><label><input type='checkbox' id='lu' name='lu' /> J'ai lu et j'accepte le règlement du concours (*)</label></p>
<p><label><input type='checkbox' id='newsletter' name='newsletter' /> Je souhaite être prévenu des prochains concours et de l'actualité de WebFantasy.fr</label></p>

<p><input type="submit" value="Valider" /></p>
</form>