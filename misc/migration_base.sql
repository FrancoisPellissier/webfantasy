-- Auteur
DROP TABLE IF EXISTS site_auteur;
CREATE TABLE `site_auteur` (
  `auteurid` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) NOT NULL DEFAULT '',
  `firstname` varchar(255) NOT NULL DEFAULT '',
  `lastname` varchar(255) NOT NULL DEFAULT '',
  `gender` enum('m','f') NOT NULL DEFAULT 'm',
  `description` text,
  `categoryid` int(11) NOT NULL DEFAULT '0',
  `pictureid` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`auteurid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO site_auteur (auteurid, fullname, created_at, updated_at)
    SELECT
        domaine,
        auteur,
        NOW(), NOW()
    FROM site_auteurs.site_domaine
    WHERE domaine BETWEEN 1 AND 3;

-- Livres
DROP TABLE IF EXISTS site_livre;
CREATE TABLE `site_livre` (
  `livreid` int(11) NOT NULL AUTO_INCREMENT,
  `titre_vo` varchar(255) NOT NULL DEFAULT '',
  `titre_vf` varchar(255) NOT NULL DEFAULT '',
  `date_vo` DATE NULL DEFAULT NULL,
  `date_vf` DATE NULL DEFAULT NULL,
  `description` text,
  `cycleid` int(11) NOT NULL DEFAULT '0',
  `cycleordre` int(11) NOT NULL DEFAULT '0',
  `categoryid` int(11) NOT NULL DEFAULT '0',
  `pictureid` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`livreid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO site_livre (
  livreid, titre_vo, titre_vf, date_vo, date_vf, description, cycleid, cycleordre, created_at, updated_at
  )
  SELECT
    livreid, titrevo, titrevf, sortievo, sortievf, couv4, cycleid, tome, NOW(), NOW()
  FROM site_auteurs.site_livre;

-- cycle
DROP TABLE IF EXISTS site_cycle;
CREATE TABLE `site_cycle` (
  `cycleid` int(11) NOT NULL AUTO_INCREMENT,
  `titre_vo` varchar(255) NOT NULL DEFAULT '',
  `titre_vf` varchar(255) NOT NULL DEFAULT '',
  `description` text,
  `is_cycle` TINYINT NOT NULL DEFAULT 1,
  `cycleparentid` int(11) NOT NULL DEFAULT '0',
  `categoryid` int(11) NOT NULL DEFAULT '0',
  `pictureid` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`cycleid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO site_cycle (
  cycleid, titre_vo, titre_vf, description, is_cycle, created_at, updated_at
  )
  SELECT
    cycleid, titrevo, titrevf, presentation, is_cycle, NOW(), NOW()
  FROM site_auteurs.site_cycle;

-- Liens auteur / livre
DROP tABLE IF EXISTS site_livre_auteur;
CREATE TABLE `site_livre_auteur` (
  `livreid` int(11) NOT NULL,
  `auteurid` int(11) NOT NULL,
  PRIMARY KEY (`livreid`,`auteurid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO site_livre_auteur (
  livreid, auteurid)
  SELECT
    livreid,
    domaine
  FROM site_auteurs.site_livre;

-- Liens auteur / cycle
DROP TABLE IF EXISTS site_cycle_auteur;
CREATE TABLE `site_cycle_auteur` (
  `auteurid` int(10) NOT NULL DEFAULT '0',
  `cycleid` int(10) NOT NULL DEFAULT '0',
  `ordre` int(10) DEFAULT NULL,
  PRIMARY KEY (`auteurid`,`cycleid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO site_cycle_auteur (
  auteurid, cycleid, ordre)
  SELECT
    domaine, cycleid, ordre
  FROM site_auteurs.site_cycle;

-- Edition
DROP TABLE IF EXISTS site_edition;
CREATE TABLE `site_edition` (
  `editionid` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL DEFAULT '',
  `langid` int(11) NOT NULL DEFAULT '0',
  `datesortie` date DEFAULT NULL,
  `publisher` varchar(255) NOT NULL DEFAULT '',
  `illustrateur` varchar(255) NOT NULL DEFAULT '',
  `formatid` int(11) NOT NULL DEFAULT '0',
  `nbpage` int(11) NOT NULL DEFAULT '0',
  `pictureid` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`editionid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO site_edition (
  editionid, titre, langid, datesortie, publisher, illustrateur, nbpage, created_at, updated_at)
  SELECT
    editionid, titre, langue, sortie, edition, illustrateur, pages, NOW(), NOW()
  FROM site_auteurs.site_edition;

-- Liens livre / edition
DROP TABLE IF EXISTS site_livre_edition;
CREATE TABLE `site_livre_edition` (
  `livreid` int(11) NOT NULL,
  `editionid` int(11) NOT NULL,
  PRIMARY KEY (`livreid`,`editionid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO site_livre_edition (
  livreid, editionid)
  SELECT
    livreid, editionid
  FROM site_auteurs.site_edition;

-- Pages
DROP TABLE IF EXISTS site_page;
CREATE TABLE `site_page` (
  `pageid` int(11) NOT NULL AUTO_INCREMENT,
  `page_parent_id` int(11) NOT NULL DEFAULT '0',
  `typepage` varchar(20) NOT NULL DEFAULT '',
  `ficheid` int(11) NOT NULL,
  `ordre` int(11) NOT NULL DEFAULT '0',
  `titre` varchar(250) NOT NULL DEFAULT '',
  `extrait` text,
  `texte` text,
  `source` varchar(250) NOT NULL DEFAULT '',
  `traducteur` varchar(200) NOT NULL DEFAULT '',
  `poster_id` int(11) NOT NULL DEFAULT '0',
  `publish_date` date DEFAULT NULL,
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pageid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO site_page
  SELECT
    pageid, page_parent_id, typepage, ficheid, ordre, titre, extrait, texte, source, traducteur, poster_id, date, creation_date, creation_date
  FROM site_auteurs.site_page;

  UPDATE `site_page`
  SET publish_date = NULL
WHERE publish_date = '0000-00-00'
