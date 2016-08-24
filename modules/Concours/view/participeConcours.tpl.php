<form method="post">
<?php
echo '<h1>'.$model->infos['titre'].'</h1>';

foreach($model->infos['question'] AS $questionid => $question) {
    echo "\n\t".'<fieldset>';
    echo "\n\t\t".'<legend>'.$question['libelle'].'</legend>';

    foreach($question['answer'] AS $answerid => $answer) {
        echo "\n\t\t\t".'<p><input type="radio" id="a'.$answerid.'" name="data[question]['.$questionid.']" value="'.$answerid.'" /> <label for="a'.$answerid.'">'.$answer.'</label></p>';
    }

    echo "\n\t".'</fieldset>';
}
?>

<fieldset>
<legend>Coordonnées</legend>
<table>
    <tr>
        <td>Nom (*):</td>
        <td><input type='text' id='nom' name='data[nom]' size='20' /></td>
    </tr>
    <tr>
        <td>Prénom (*):</td>
        <td><input type='text' id='prenom' name='data[prenom]' size='20' /></td>
    </tr>
    <tr>
        <td>Adresse (*):</td>
        <td><input type='text' id='adresse_1' name='data[adresse_1]' size='50' /></td>
    </tr>
    <tr>
        <td>Adresse (suite) :</td>
        <td><input type='text' name='data[adresse_2]' size='50' /></td>
    </tr>
    <tr>
        <td>Code postal (*):</td>
        <td><input type='text' id='zipcode' name='data[zipcode]' size='10' /></td>
    </tr>
    <tr>
        <td>Ville (*):</td>
        <td><input type='text' id='city' name='data[city]' size='20' /></td>
    </tr>
    <tr>
        <td>Pays (*):</td>
        <td>
        <?php
        $pays = array('France', 'Belgique', 'Luxembourg', 'Suisse');

        echo "\n\t\t".'<select name="data[country]" id="country">';
        foreach($pays AS $c) {
            echo "\n\t\t".'<option value="'.$c.'">'.$c.'</option>';
        }

        echo "\n\t\t".'</select>';
        ?>
        </td>
    </tr>
    <tr>
        <td>E-mail (*):</td>
        <td><input type='text' id='email' name='data[email]' size='30' /></td>
    </tr>
</table>
</fieldset>
<fieldset>

<p><label><input type='checkbox' id='lu' name='lu' /> J'ai lu et j'accepte le règlement du concours (*)</label></p>
<p><label><input type='checkbox' id='newsletter' name='newsletter' /> Je souhaite être prévenu des prochains concours</label></p>
<p>Combien font 2 + 7 ? <input type='text' id='verif' name='verif' size='1' /></p>

<p><input type="submit" value="Valider" /></p>
</form>