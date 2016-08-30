


-- Créer la fichie livre manquante (Sixth at the Dusk) avant la migration pour avoir la catégorie manquante ligne 114.








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

-- Insertion des liens existants
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

-- Forçage de certains catégories
UPDATE site_image SET categoryid = 403 WHERE imageid = 292;
UPDATE site_image SET categoryid = 402 WHERE imageid = 293;
UPDATE site_image SET categoryid = 402 WHERE imageid = 294;
UPDATE site_image SET categoryid = 401 WHERE imageid = 295;
UPDATE site_image SET categoryid = 400 WHERE imageid = 296;
UPDATE site_image SET categoryid = 400 WHERE imageid = 297;
UPDATE site_image SET categoryid = 399 WHERE imageid = 298;
UPDATE site_image SET categoryid = 399 WHERE imageid = 299;
UPDATE site_image SET categoryid = 398 WHERE imageid = 300;
UPDATE site_image SET categoryid = 398 WHERE imageid = 301;
UPDATE site_image SET categoryid = 406 WHERE imageid = 302;
UPDATE site_image SET categoryid = 406 WHERE imageid = 303;
UPDATE site_image SET categoryid = 397 WHERE imageid = 304;
UPDATE site_image SET categoryid = 397 WHERE imageid = 305;
UPDATE site_image SET categoryid = 396 WHERE imageid = 306;
UPDATE site_image SET categoryid = 396 WHERE imageid = 307;
UPDATE site_image SET categoryid = 395 WHERE imageid = 308;
UPDATE site_image SET categoryid = 405 WHERE imageid = 309;
UPDATE site_image SET categoryid = 403 WHERE imageid = 1306;
UPDATE site_image SET categoryid = 402 WHERE imageid = 1307;
UPDATE site_image SET categoryid = 402 WHERE imageid = 1308;
UPDATE site_image SET categoryid = 402 WHERE imageid = 1309;
UPDATE site_image SET categoryid = 401 WHERE imageid = 1310;
UPDATE site_image SET categoryid = 401 WHERE imageid = 1311;
UPDATE site_image SET categoryid = 400 WHERE imageid = 1312;
UPDATE site_image SET categoryid = 400 WHERE imageid = 1313;
UPDATE site_image SET categoryid = 400 WHERE imageid = 1314;
UPDATE site_image SET categoryid = 399 WHERE imageid = 1315;
UPDATE site_image SET categoryid = 399 WHERE imageid = 1316;
UPDATE site_image SET categoryid = 404 WHERE imageid = 1662;
UPDATE site_image SET categoryid = 404 WHERE imageid = 1752;
UPDATE site_image SET categoryid = 403 WHERE imageid = 1790;
UPDATE site_image SET categoryid = 393 WHERE imageid = 1791;
UPDATE site_image SET categoryid = 395 WHERE imageid = 1792;
UPDATE site_image SET categoryid = 394 WHERE imageid = 1793;
UPDATE site_image SET categoryid = 402 WHERE imageid = 1794;
UPDATE site_image SET categoryid = 401 WHERE imageid = 1795;
UPDATE site_image SET categoryid = 400 WHERE imageid = 1796;
UPDATE site_image SET categoryid = 399 WHERE imageid = 1797;
UPDATE site_image SET categoryid = 398 WHERE imageid = 1798;
UPDATE site_image SET categoryid = 406 WHERE imageid = 1799;
UPDATE site_image SET categoryid = 397 WHERE imageid = 1800;
UPDATE site_image SET categoryid = 396 WHERE imageid = 1801;
UPDATE site_image SET categoryid = 403 WHERE imageid = 2292;
UPDATE site_image SET categoryid =  WHERE imageid = 2301;

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
	AND i.categoryid = 0
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

-- Liens manquants
INSERT IGNORE INTO site_image_category (imageid, categoryid)
	SELECT imageid, categoryid
	FROM site_image;


ALTER TABLE site_category
	ADD COLUMN `pictureid` int(11) NOT NULL DEFAULT '0' AFTER ordre;