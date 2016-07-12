/************************** Catégories ****************************/
-- Création de la structure
DROP TABLE IF EXISTS site_category;
CREATE TABLE site_category (
	categoryid INT NOT NULL AUTO_INCREMENT,
	titre VARCHAR(255) NOT NULL DEFAULT '',
	description TEXT NULL DEFAULT NULL,
	fichetype VARCHAR(20) NOT NULL DEFAULT '',
	ficheid INT NOT NULL DEFAULT 0,
	folder VARCHAR(255) NOT NULL DEFAULT '',
	category_parentid INT NOT NULL DEFAULT 0,
	ordre INT NOT NULL DEFAULT 0,
	pwgid INT NOT NULL DEFAULT 0,
	created_at DATETIME NULL DEFAULT NULL,
	updated_at DATETIME NULL DEFAULT NULL,
	PRIMARY KEY (`categoryid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Récupération des catégories visuelles
INSERT INTO site_category (titre, description, pwgid, ordre)
	SELECT `name`, `comment`, id, rank
	FROM  site_auteurs.wg_categories
	WHERE `status` = 'public'
		AND `uppercats` NOT LIKE '%472%'
		AND `uppercats` NOT LIKE '%473%';

-- Génération du nom du dossier
UPDATE site_category
	SET folder = CONCAT('img/', categoryid);

-- Génération d'une date
UPDATE site_category
SET
	created_at = NOW(),
	updated_at = NOW();

-- Récupération parent
UPDATE site_category AS e
INNER JOIN site_auteurs.wg_categories AS c
	ON e.pwgid = c.id
INNER JOIN site_category AS p
	ON c.id_uppercat = p.pwgid
SET e.category_parentid = p.categoryid;

-- Ajout des informations de fiche
UPDATE site_category AS c
INNER JOIN site_auteurs.site_livre AS a
	ON c.pwgid = a.categorie_id
SET c.fichetype = 'livre',
	c.ficheid = livreid;

/************************** Images ****************************/
-- Création de la structure
DROP TABLE IF EXISTS site_image;
CREATE TABLE site_image (
	imageid INT NOT NULL AUTO_INCREMENT,
	categoryid INT NOT NULL DEFAULT 0,
	titre VARCHAR(255) NOT NULL DEFAULT '',
	description TEXT NULL DEFAULT NULL,
	folder VARCHAR(255) NOT NULL DEFAULT '',
	filename VARCHAR(255) NOT NULL DEFAULT '',
	created_at DATETIME NULL DEFAULT NULL,
	updated_at DATETIME NULL DEFAULT NULL,
	pwgid INT NOT NULL DEFAULT 0,
	PRIMARY KEY (`imageid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Récupération des images liées à l'une des catégories migrées


-- Modification de l'association des images en cas de multiples association (livre/pays)



