<?php
if(empty($sidebar)) {
    $sidebar = array();

    $sidebar[] = array(
        'type' => 'contenu',
        'value' => 'Bienvenue sur ce site non-officiel consacré à <strong>Terry Goodkind</strong> et à l\'ensemble de ses oeuvres.');

    $sidebar[] = array(
        'type' => 'title',
        'value' => 'Le Coeur de la Guerre');

    $sidebar[] = array(
        'type' => 'contenu',
        'value' => '<img title="Prochaine sortie française : le Coeur de la Guerre" src="http://www.terrygoodkind.fr/img/terrygoodkind/livres/edition/miniature/190_Le_Coeur_de_la_Guerre.jpg" /><br /><br />18 novembre 2015'
        );

    $sidebar[] = array(
        'type' => 'title',
        'value' => 'Death\'s Mistress');

    $sidebar[] = array(
        'type' => 'contenu',
        'value' => '<img title="Prochaine sortie originale : Death\'s Mistress" src="http://www.terrygoodkind.fr/img/terrygoodkind/livres/edition/miniature/196_Deaths_Mistress.jpg" /><br /><br />10 janvier 2017 / J -192 jours'
        );

    $sidebar[] = array(
        'type' => 'title',
        'value' => 'Terry Goodkind');

    $sidebar[] = array(
        'type' => 'link',
        'value' => array(
            array('href' => '#', 'title' => 'Interviews', 'value' => 'Interviews'),
            array('href' => '#', 'title' => 'Cours', 'value' => 'Cours'),
            array('href' => '#', 'title' => 'Les Livres', 'value' => 'Les Livres')
            )
        );
}
?>

<div id="left">
    <div id="contenu-left">
    <?php
    if(!empty($sidebar)) {
        // On parcourt les items de la Sidebar
        foreach($sidebar AS $sideItem) {
            $sideContent = '';

            // Titre
            if($sideItem['type'] == 'title') {
                $sideContent = "\n\t\t".'<div class="title">'.$sideItem['value'].'</div>';
            }
            // Contenu
            else if($sideItem['type'] == 'contenu') {
                $sideContent = "\n\t\t".'<div class="contenu-menu">'."\n\t\t\t".$sideItem['value']."\n\t\t".'</div>';
            }
            // Lien
            else if($sideItem['type'] == 'link') {
                $sideContent = "\n\t\t".'<div class="menu">';
                foreach($sideItem['value'] AS $sideSubItem) {
                    $sideContent .= "\n\t\t\t".'<a href="'.$sideSubItem['href'].'" title="'.(isset($subSubItem['title']) ? $sideSubItem['title'] : $sideSubItem['value']).'">'.$sideSubItem['value'].'</a><br /><br />';
                }
                $sideContent .= "\n\t\t".'</div>';   
            }
            echo $sideContent;
        }
    }
    ?>
    </div>
</div>