<?php
$auteur = array(
	'1' => 'auteur/1/terry-goodkind',
	'2' => 'auteur/2/patrick-rothfuss',
	'3' => 'auteur/3/brandon-sanderson'
	);
?>
<div id="site">
    <div id="header"></div>
    <div id="sous-header">
        <div id="mh">
            <a title="Accueil" href="">Accueil</a>
            <a title="L'auteur" href="<?php echo $auteur[$domaine]; ?>">L'auteur</a>
            <a title="Les livres" href="<?php echo $auteur[$domaine]; ?>/livre">Les livres</a>
            <a title="Accéder au forum" href="forum">Forum</a>
        </div>
    </div>