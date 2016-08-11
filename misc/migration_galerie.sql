/************************** Images ****************************/
-- Création de la structure
DROP TABLE IF EXISTS site_image;
CREATE TABLE site_image (
	imageid INT NOT NULL AUTO_INCREMENT,
	categoryid INT NOT NULL DEFAULT 0,
	title VARCHAR(255) NOT NULL DEFAULT '',
	commentaire TEXT NULL DEFAULT NULL,
	folder VARCHAR(255) NOT NULL DEFAULT '',
	filename VARCHAR(255) NOT NULL DEFAULT '',
	created_at DATETIME NULL DEFAULT NULL,
	updated_at DATETIME NULL DEFAULT NULL,
	PRIMARY KEY (`imageid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Récupération des images liées à l'une des catégories migrées
INSERT INTO site_image (imageid, title, commentaire, folder, filename, created_at, updated_at)
	SELECT
		i.id,
		i.`name`,
		i.`comment`,
		REPLACE(i.path, i.file, ''),
		i.file,
		i.date_metadata_update,
		i.date_metadata_update
	FROM site_auteurs.wg_images AS i
	INNER JOIN site_auteurs.wg_image_category AS ic
		ON i.id = ic.image_id
	INNER JOIN site_category AS c
		ON c.categoryid = ic.category_id
	GROUP BY ic.image_id;

-- Liens multiples
DROP TABLE IF EXISTS site_image_category;
CREATE TABLE site_image_category (
	imageid INT NOT NULL,
	categoryid INT NOT NULL,
	PRIMARY KEY(imageid, categoryid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO site_image_category (
	imageid,
	categoryid)
	SELECT
		i.id,
		ic.category_id
	FROM site_auteurs.wg_images AS i
	INNER JOIN site_auteurs.wg_image_category AS ic
		ON i.id = ic.image_id
	INNER JOIN site_category AS c
		ON c.categoryid = ic.category_id
	GROUP BY
		i.id,
		ic.category_id;

-- Images dans une seule catégorie
DROP TABLE IF EXISTS temp;
CREATE TABLE temp
	SELECT
		imageid,
		categoryid
	FROM `site_image_category`
	GROUP BY imageid
	HAVING COUNT(*) = 1;

UPDATE site_image AS i
INNER JOIN temp AS t
	ON i.imageid = t.imageid
SET i.categoryid = t.categoryid;

DROP TABLE IF EXISTS temp;

-- Association images / fiches (hors auteur)
UPDATE site_image AS i
INNER JOIN site_image_category AS ic
	ON i.imageid = ic.imageid
	AND i.categoryid = 0
INNER JOIN site_category AS c
	ON c.categoryid = ic.categoryid
	AND c.fichetype IN('livre', 'cycle')
SET i.categoryid = c.categoryid;

-- Association images / Fan Art
UPDATE site_image AS i
INNER JOIN site_image_category AS ic
	ON i.imageid = ic.imageid
	AND i.categoryid = 0
INNER JOIN site_category AS c
	ON c.categoryid = ic.categoryid
	AND c.category_parentid = 26
SET i.categoryid = c.categoryid;
