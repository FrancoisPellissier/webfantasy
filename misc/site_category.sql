-- ----------------------------
-- Table structure for site_category
-- ----------------------------
DROP TABLE IF EXISTS `site_category`;
CREATE TABLE `site_category` (
  `categoryid` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL DEFAULT '',
  `description` text,
  `fichetype` varchar(20) NOT NULL DEFAULT '',
  `ficheid` int(11) NOT NULL DEFAULT '0',
  `folder` varchar(255) NOT NULL DEFAULT '',
  `category_parentid` int(11) NOT NULL DEFAULT '0',
  `ordre` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`categoryid`)
) ENGINE=InnoDB AUTO_INCREMENT=1717 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of site_category
-- ----------------------------
INSERT INTO `site_category` VALUES ('18', 'Pays', 'Couvertures des livres du cycle de l\'Épée de Vérité dans différents pays.', 'auteur', '1', 'img/18', '0', '2', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('19', 'Fan art', 'Illustrations et montages réalisés par des membres du forum ou des fans.\r\nVous pouvez m\'envoyez vos oeuvres à admin@terrygoodkind.fr si vous souhaitez les voir apparaître dans cette galerie.', 'auteur', '1', 'img/19', '0', '4', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('20', 'Keith Parkinson', 'Originaux réalisés par Keith Parkinson pour les différents tomes du cycle.', 'auteur', '1', 'img/20', '0', '3', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('21', 'France', 'Couvertures françaises du cycle de l\'Épée de Vérité.', 'auteur', '1', 'img/21', '18', '5', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('22', 'Etats-Unis', 'Couvertures américaines du cycle de l\'Épée de Vérité.', 'auteur', '1', 'img/22', '18', '4', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('23', 'Japon', 'Couvertures japonaises du cycle de l\'Épée de Vérité.', 'auteur', '1', 'img/23', '18', '7', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('24', 'Allemagne', 'Couvertures allemandes du cycle de l\'Épée de Vérité.', 'auteur', '1', 'img/24', '18', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('25', 'Espagne', 'Couvertures espagnoles du cycle de l\'Épée de Vérité.', 'auteur', '1', 'img/25', '18', '3', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('26', 'Artistes', 'Voir les illustrations par artiste.', 'auteur', '1', 'img/26', '19', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('27', 'Personnages', 'Les illustrations triées par personnage.', 'auteur', '1', 'img/27', '19', '2', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('46', 'Askelon', null, 'auteur', '1', 'img/46', '26', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('47', 'Eisis', null, 'auteur', '1', 'img/47', '26', '2', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('48', 'Etta', null, 'auteur', '1', 'img/48', '26', '3', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('49', 'gratch', null, 'auteur', '1', 'img/49', '26', '6', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('50', 'Ophidia', null, 'auteur', '1', 'img/50', '26', '10', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('51', 'Geneviève', null, 'auteur', '1', 'img/51', '26', '5', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('52', 'Sinoa', null, 'auteur', '1', 'img/52', '26', '11', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('53', 'Tia', null, 'auteur', '1', 'img/53', '26', '13', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('54', 'Valfeor', null, 'auteur', '1', 'img/54', '26', '14', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('55', 'François', null, 'auteur', '1', 'img/55', '26', '4', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('56', 'Montages', 'Montages réalisés par les membres, à partir des couvertures, des illustrations d\'autres personnes, d\'autres illustrations, ...', 'auteur', '1', 'img/56', '19', '5', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('57', 'Kahlan Amnell', null, 'auteur', '1', 'img/57', '27', '9', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('58', 'Richard Cypher', null, 'auteur', '1', 'img/58', '27', '12', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('59', 'Betty', null, 'auteur', '1', 'img/59', '27', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('60', 'Cara', null, 'auteur', '1', 'img/60', '27', '2', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('61', 'Constance', null, 'auteur', '1', 'img/61', '27', '3', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('62', 'Darken Rahl', null, 'auteur', '1', 'img/62', '27', '4', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('63', 'Denna', null, 'auteur', '1', 'img/63', '27', '5', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('64', 'Ecarlate', null, 'auteur', '1', 'img/64', '27', '6', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('65', 'Jagang', null, 'auteur', '1', 'img/65', '27', '8', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('66', 'Nathan', null, 'auteur', '1', 'img/66', '27', '10', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('67', 'Pasha', null, 'auteur', '1', 'img/67', '27', '11', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('68', 'Shota', null, 'auteur', '1', 'img/68', '27', '13', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('69', 'Warren', null, 'auteur', '1', 'img/69', '27', '14', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('70', 'Weselan', null, 'auteur', '1', 'img/70', '27', '15', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('71', 'Zeddicus Zu\'l Zorander', null, 'auteur', '1', 'img/71', '27', '16', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('72', 'Scènes', 'Illustrations représentant des scènes du cycle.', 'auteur', '1', 'img/72', '19', '4', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('73', 'Garn', null, 'auteur', '1', 'img/73', '27', '7', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('74', 'Lieux', 'Illustrations des lieux visités dans le cycle.', 'auteur', '1', 'img/74', '19', '3', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('81', 'Palais du Peuple', null, 'auteur', '1', 'img/81', '74', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('82', 'Couvertures', null, 'auteur', '1', 'img/82', '56', '2', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('83', 'Bannières', 'Montages au format \"bannière\".', 'auteur', '1', 'img/83', '56', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('84', 'Montages', null, 'auteur', '1', 'img/84', '56', '3', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('86', 'Russie', 'Couvertures russes du cycle de l\'Épée de Vérité. ', 'auteur', '1', 'img/86', '18', '9', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('89', 'Autres', 'Photos n\'entrant dans aucune autre catégorie.', 'auteur', '1', 'img/89', '0', '5', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('90', 'WFR Racing', 'Photos de Terry Goodkind avec de sa voiture de course. (source : www.terrygoodkind.net)', 'auteur', '1', 'img/90', '89', '11', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('92', 'Épée de Vérité', 'Épée de Vérité qui a été réalisée pour l\'auteur par son frère.', 'auteur', '1', 'img/92', '89', '3', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('95', 'Tee-shirt Confessor', 'Tee-shirt avec l\'illustration de couverture dans le dos et l\'inscription \"House of Rahl - First file\" (première phalange) sur la manche. (source : www.terrygoodkind.net)', 'auteur', '1', 'img/95', '89', '8', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('97', 'Carte', 'Carte, dessinée par l\'auteur, du monde dans lequel se passe le cycle de l\'Épée de Vérité.', 'auteur', '1', 'img/97', '89', '2', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('99', 'Terry Goodkind', 'Photos de l\'auteur.', 'auteur', '1', 'img/99', '89', '9', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('224', 'Nelika', null, 'auteur', '1', 'img/224', '26', '8', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('269', 'Suède', null, 'auteur', '1', 'img/269', '18', '10', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('279', 'Making-of the Law of Nines', null, 'auteur', '1', 'img/279', '89', '5', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('319', 'Site officiel', 'Les différentes versions du site officiel', 'auteur', '1', 'img/319', '89', '7', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('326', 'Italie', null, 'auteur', '1', 'img/326', '18', '6', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('327', 'Publicités', null, 'auteur', '1', 'img/327', '89', '6', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('334', 'Niania', null, 'auteur', '1', 'img/334', '26', '9', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('345', 'Pologne', null, 'auteur', '1', 'img/345', '18', '8', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('348', 'Magazines', null, 'auteur', '1', 'img/348', '89', '4', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('353', 'mévelie', null, 'auteur', '1', 'img/353', '26', '7', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('354', 'So', null, 'auteur', '1', 'img/354', '26', '12', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('356', 'Boutique TG.com', null, 'auteur', '1', 'img/356', '89', '10', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('359', 'Pays', null, 'auteur', '2', 'img/359', '0', '2', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('360', 'Couvertures', null, 'livre', '16', 'img/360', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('367', 'Pays', null, 'auteur', '3', 'img/367', '0', '2', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('368', 'France', null, 'auteur', '3', 'img/368', '367', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('369', 'USA', null, 'auteur', '3', 'img/369', '367', '5', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('370', 'Angleterre', null, 'auteur', '3', 'img/370', '367', '3', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('371', 'Allemagne', null, 'auteur', '3', 'img/371', '367', '2', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('372', 'Couvertures', null, 'livre', '26', 'img/372', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('373', 'Couvertures', null, 'livre', '27', 'img/373', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('378', 'Couvertures', null, 'livre', '36', 'img/378', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('379', 'Couvertures', null, 'livre', '23', 'img/379', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('380', 'Couvertures', null, 'livre', '24', 'img/380', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('381', 'Couvertures', null, 'livre', '25', 'img/381', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('382', 'Couvertures', null, 'livre', '35', 'img/382', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('383', 'Couvertures', null, 'livre', '21', 'img/383', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('384', 'Couvertures', null, 'livre', '29', 'img/384', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('385', 'Couvertures', null, 'livre', '28', 'img/385', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('386', 'Couvertures', null, 'livre', '30', 'img/386', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('387', 'Couvertures', null, 'livre', '31', 'img/387', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('388', 'Couvertures', null, 'livre', '32', 'img/388', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('389', 'Couvertures', null, 'livre', '33', 'img/389', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('390', 'Couvertures', null, 'livre', '34', 'img/390', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('391', 'Cartes', null, 'livre', '26', 'img/391', '0', '2', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('393', 'Couvertures', null, 'livre', '13', 'img/393', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('394', 'Couvertures', null, 'livre', '11', 'img/394', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('395', 'Couvertures', null, 'livre', '10', 'img/395', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('396', 'Couvertures', null, 'livre', '9', 'img/396', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('397', 'Couvertures', null, 'livre', '8', 'img/397', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('398', 'Couvertures', null, 'livre', '6', 'img/398', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('399', 'Couvertures', null, 'livre', '5', 'img/399', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('400', 'Couvertures', null, 'livre', '4', 'img/400', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('401', 'Couvertures', null, 'livre', '3', 'img/401', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('402', 'Couvertures', null, 'livre', '2', 'img/402', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('403', 'Couvertures', null, 'livre', '1', 'img/403', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('404', 'Couvertures', null, 'livre', '14', 'img/404', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('405', 'Couvertures', null, 'livre', '12', 'img/405', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('406', 'Couvertures', null, 'livre', '7', 'img/406', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('418', 'Couvertures', null, 'livre', '17', 'img/418', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('419', 'France', null, 'auteur', '2', 'img/419', '359', '6', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('420', 'USA', null, 'auteur', '2', 'img/420', '359', '14', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('424', 'Brésil', null, 'auteur', '2', 'img/424', '359', '2', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('425', 'Couvertures', null, 'livre', '18', 'img/425', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('426', 'Couvertures', null, 'livre', '19', 'img/426', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('430', 'Italie', null, 'auteur', '2', 'img/430', '359', '8', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('434', 'Tables des métaux', null, 'auteur', '3', 'img/434', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('435', 'Italie', null, 'auteur', '3', 'img/435', '367', '4', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('441', 'Illustrations', null, 'auteur', '3', 'img/441', '0', '3', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('442', 'Illustrations', null, 'livre', '21', 'img/442', '0', '2', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('445', 'Mistborn Adventure Game', null, 'auteur', '3', 'img/445', '0', '3', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('447', 'Allemagne', null, 'auteur', '2', 'img/447', '359', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('448', 'Japon', null, 'auteur', '2', 'img/448', '359', '9', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('449', 'Finlande', null, 'auteur', '2', 'img/449', '359', '5', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('450', 'Hollande', null, 'auteur', '2', 'img/450', '359', '7', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('451', 'Portugal', null, 'auteur', '2', 'img/451', '359', '11', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('452', 'Pologne', null, 'auteur', '2', 'img/452', '359', '10', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('453', 'Danemark', null, 'auteur', '2', 'img/453', '359', '3', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('454', 'Espagne', null, 'auteur', '2', 'img/454', '359', '4', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('455', 'Serbie', null, 'auteur', '2', 'img/455', '359', '12', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('456', 'Taïwan', null, 'auteur', '2', 'img/456', '359', '13', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('458', 'Mistborn : Birthright', null, 'auteur', '3', 'img/458', '0', '4', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('459', 'Couvertures', null, 'livre', '38', 'img/459', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('462', 'Indices', null, 'auteur', '1', 'img/462', '89', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('465', 'Couvertures', null, 'livre', '37', 'img/465', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('467', 'Couvertures', 'The First Confessor', 'livre', '40', 'img/467', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('914', 'Promotion la Peur du Sage - Partie1', null, 'auteur', '2', 'img/914', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('1297', 'Couvertures', null, 'livre', '42', 'img/1297', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('1680', 'Couvertures', null, 'livre', '41', 'img/1680', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('1681', 'Couvertures', null, 'livre', '39', 'img/1681', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('1683', 'Couvertures', null, 'livre', '22', 'img/1683', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('1685', 'Couvertures', null, 'livre', '47', 'img/1685', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('1690', 'Couvertures', null, 'livre', '48', 'img/1690', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('1693', 'Couvertures', null, 'livre', '46', 'img/1693', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('1695', 'Couvertures', null, 'livre', '20', 'img/1695', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('1697', 'Couvertures', null, 'livre', '49', 'img/1697', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('1701', 'Couvertures', null, 'livre', '44', 'img/1701', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('1703', 'Couvertures', null, 'livre', '52', 'img/1703', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('1705', 'Couvertures', null, 'livre', '54', 'img/1705', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('1707', 'Couvertures', null, 'livre', '55', 'img/1707', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('1709', 'Couvertures', null, 'livre', '53', 'img/1709', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('1710', 'Ebook', null, 'auteur', '1', 'img/1710', '18', '2', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('1711', 'Couvertures', null, 'livre', '58', 'img/1711', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('1714', 'Couvertures', null, 'livre', '59', 'img/1714', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
INSERT INTO `site_category` VALUES ('1716', 'Couvertures', null, 'livre', '60', 'img/1716', '0', '1', '2016-08-04 13:47:48', '2016-08-04 13:47:48');
