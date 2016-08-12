<?php
echo '<h1>'.$model->infos['titre'].'</h1>';

echo '<p><img src="http://www.webfantasy.fr/img/concours/concours_'.$model->infos['formid'].'.jpg" /></p>';

echo parse_message($model->infos['description'], 0);

?>
<h2>Règlement du concours</h2>

<p>Ce concours est limité à une participation par personne physique habitant en France métropolitaine (Corse incluse), en Belgique, en Suisse ou au Luxembourg.</p>
<p>Ce concours est gratuit, sans obligation d'achat et sans obligation d'inscription au forum.</p>
<p>Le concours est ouvert du <strong><?php echo $model->infos['date_debut']; ?></strong> jusqu'au <strong><?php echo $model->infos['date_fin']; ?></strong> (heure française).</p>
<p>Aucune de vos coordonnées et/ou informations personnelles ne pourra être utilisée sans votre accord, et vous disposez à tout moment d'un droit légal de rectification de ces informations. Elles seront effacées une fois le concours terminé.</p>
<p>En participant à ce concours, vous vous engagez à assurer la véracité des informations données.</p>
<p>Un e-mail sera envoyé aux gagnants au terme du concours.</p>
<p>Les noms des gagnants (Nom, ville et pays) seront affichés sur le site.</p>
<p>Les gagnants recevront leur lot par courrier dans le mois suivant leur désignation. L'envoi des lots est à la charge de notre partenaire. WebFantasy.fr ne saurait être tenu responsable de la non-réception des lots. En cas de non-réception, prendre contact avec notre partenaire.</p>
<p>La participation au jeu implique l'acceptation pleine et entière des clauses du présent règlement. Tout prix ne peut donner lieu à aucune contestation d'aucune sorte, ni à sa contre-valeur en argent, ni à échange pour quelque motif que ce soit.</p>

<?php
if(date('Y-m-d') <= $model->infos['date_fin']) {
    echo '<h4><a href="'.$model->getSlug().'/participate">J\'accepte le réglement et je participe au concours</a></h4>';
}
else {
    echo '<h2>Le concours est terminé</h2>';
    echo '<p>Les gagnants sont :</p>';
}