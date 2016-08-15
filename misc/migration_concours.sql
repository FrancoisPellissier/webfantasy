-- Concours
DROP TABLE IF EXISTS form;
CREATE TABLE `form` (
  `formid` int(11) NOT NULL AUTO_INCREMENT,
  `domaine` int(11) NOT NULL DEFAULT '0',
  `titre` varchar(255) NOT NULL DEFAULT '',
  `titre_forum` varchar(255) NOT NULL DEFAULT '',
  `description` text,
  `partenaire` varchar(100) NOT NULL DEFAULT '',
  `exemplaires` int(11) NOT NULL DEFAULT '0',
  `ecart` enum('0','1') NOT NULL DEFAULT '0',
  `adresse` enum('0','1') NOT NULL DEFAULT '0',
  `verif` enum('0','1') NOT NULL DEFAULT '0',
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `date_sortie` date DEFAULT NULL,
  `participants` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`formid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO form
  SELECT *, creationdate
  FROM site_auteurs.form;

-- Réponses
DROP TABLE IF EXISTS form_answer;
CREATE TABLE `form_answer` (
  `answerid` int(11) NOT NULL AUTO_INCREMENT,
  `questionid` int(11) NOT NULL DEFAULT '0',
  `libelle` varchar(255) NOT NULL DEFAULT '',
  `ordre` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`answerid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO form_answer
  SELECT *
  FROM site_auteurs.form_answer;


DROP TABLE IF EXISTS form_participants;
CREATE TABLE `form_participants` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `formid` int(11) NOT NULL DEFAULT '0',
  `email` varchar(250) NOT NULL DEFAULT '',
  `user_ip` varchar(250) NOT NULL DEFAULT '',
  `all_right` enum('0','1') NOT NULL DEFAULT '0',
  `subsidiaire` int(11) NOT NULL DEFAULT '0',
  `statut` tinyint(1) DEFAULT '0',
  `ordre` tinyint(1) DEFAULT '0',
  `nom` varchar(250) NOT NULL DEFAULT '',
  `prenom` varchar(250) NOT NULL DEFAULT '',
  `adresse_1` varchar(250) NOT NULL DEFAULT '',
  `adresse_2` varchar(250) NOT NULL DEFAULT '',
  `zipcode` varchar(250) NOT NULL DEFAULT '',
  `city` varchar(250) NOT NULL DEFAULT '',
  `country` varchar(100) NOT NULL DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO form_participants
  SELECT userid, formid, email, user_ip, all_right, subsidiaire, statut, ordre, nom, prenom, adresse_1, adresse_2, zipcode, city, country, creationdate, creationdate
  FROM site_auteurs.form_participants;

DROP TABLE IF EXISTS form_participants_history;
CREATE TABLE `form_participants_history` (
  `historyid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `statut` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`historyid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO form_participants_history
  SELECT historyid, userid, statut, updatedate, updatedate FROM site_auteurs.form_participants_history;

DROP TABLE IF EXISTS form_question;
CREATE TABLE `form_question` (
  `questionid` int(11) NOT NULL AUTO_INCREMENT,
  `formid` int(11) NOT NULL DEFAULT '0',
  `libelle` varchar(255) NOT NULL DEFAULT '',
  `ordre` int(11) NOT NULL DEFAULT '0',
  `questiontype` enum('radio','checkbox','value') NOT NULL DEFAULT 'radio',
  `answerid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`questionid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO form_question
  SELECT * FROM site_auteurs.form_question;

DROP TABLE IF EXISTS form_user_answer;
CREATE TABLE `form_user_answer` (
  `questionid` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0',
  `answerid` int(11) NOT NULL DEFAULT '0',
  `formid` int(11) NOT NULL DEFAULT '0',
  `value` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`questionid`,`userid`,`answerid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO form_user_answer
  SELECT * FROM site_auteurs.form_user_answer;
