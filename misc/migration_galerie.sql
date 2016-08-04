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
	PRIMARY KEY (`imageid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Récupération des images liées à l'une des catégories migrées
INSERT INTO site_image (imageid, titre, description, filename, created_at, updated_at)
	SELECT
		i.id,
		i.`name`,
		i.`comment`,
		i.file,
		i.date_metadata_update,
		i.date_metadata_update
	FROM site_auteurs.wg_images AS i
	INNER JOIN site_auteurs.wg_image_category AS ic
		ON i.id = ic.image_id
	INNER JOIN site_category AS c
		ON c.categoryid = ic.category_id
	GROUP BY ic.image_id;

-- Association images / fiches (hors auteur)
