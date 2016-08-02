<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <base href="<?php echo WWW_ROOT; ?>" />

        <title><?php echo $titre_page; ?></title>

        <link rel="icon" type="image/png" href="favicon.png" />
        <link href="assets/css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/js/jquery/jquery-ui-1.11.2/jquery-ui.css">
        
        <script src="assets/js/jquery/jquery-1.11.0.min.js"></script>
        <script src="assets/js/jquery/jquery-migrate-1.2.1.min.js"></script>
        <script src="assets/js/jquery/jquery-ui-1.11.2/jquery-ui.js"></script>
        
        <?php
        // Meta OG
        if(!isset($meta)) {
            $meta['title'] = 'My Movie Wall';
            $meta['url'] = WWW_ROOT.$_SERVER['REQUEST_URI'];
            $meta['description'] = '';
            $meta['image'] = WWW_ROOT.'img/share.jpg';
            $meta['type'] = 'books.book';
        }
        if(isset($meta)) {
            foreach($meta AS $key=>$value)
                echo "\n\t\t".'<meta property="og:'.$key.'" content="'.str_replace('"', '', $value).'" />';
        }

        // Fichier JS spécifique ?
        if($jsfile != '')
            echo "\n\t".'<script type="text/javascript" src="assets/js/'.$jsfile.'.js"></script>';
        ?>
    </head>
    <body>