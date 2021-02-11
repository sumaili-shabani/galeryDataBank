#
# TABLE STRUCTURE FOR: chambre
#

DROP TABLE IF EXISTS `chambre`;

CREATE TABLE `chambre` (
  `idchambre` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(300) DEFAULT NULL,
  `idg` int(11) DEFAULT NULL,
  `idtype` int(11) DEFAULT NULL,
  `etat` int(11) DEFAULT '0',
  `montant` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idchambre`),
  KEY `idg` (`idg`),
  KEY `idtype` (`idtype`),
  CONSTRAINT `chambre_ibfk_1` FOREIGN KEY (`idg`) REFERENCES `galerie` (`idg`) ON DELETE CASCADE,
  CONSTRAINT `chambre_ibfk_2` FOREIGN KEY (`idtype`) REFERENCES `type` (`idtype`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO `chambre` (`idchambre`, `nom`, `idg`, `idtype`, `etat`, `montant`, `created_at`) VALUES (5, 'chambre B', 4, 5, 1, 15, '2021-02-10 11:03:04');
INSERT INTO `chambre` (`idchambre`, `nom`, `idg`, `idtype`, `etat`, `montant`, `created_at`) VALUES (6, 'chambre C', 5, 4, 0, 13, '2021-02-10 11:03:29');
INSERT INTO `chambre` (`idchambre`, `nom`, `idg`, `idtype`, `etat`, `montant`, `created_at`) VALUES (7, 'chambre D', 4, 4, 0, 20, '2021-02-11 17:05:38');
INSERT INTO `chambre` (`idchambre`, `nom`, `idg`, `idtype`, `etat`, `montant`, `created_at`) VALUES (8, 'chambre E', 4, 4, 0, 15, '2021-02-11 17:05:52');
INSERT INTO `chambre` (`idchambre`, `nom`, `idg`, `idtype`, `etat`, `montant`, `created_at`) VALUES (9, 'chambre F', 4, 4, 0, 30, '2021-02-11 17:06:06');
INSERT INTO `chambre` (`idchambre`, `nom`, `idg`, `idtype`, `etat`, `montant`, `created_at`) VALUES (10, 'chambre A', 4, 5, 1, 10, '2021-02-11 17:06:40');


#
# TABLE STRUCTURE FOR: client
#

DROP TABLE IF EXISTS `client`;

CREATE TABLE `client` (
  `idclient` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(300) DEFAULT NULL,
  `tel` varchar(300) DEFAULT NULL,
  `email` varchar(300) DEFAULT NULL,
  `adresse` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idclient`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO `client` (`idclient`, `fullname`, `tel`, `email`, `adresse`, `created_at`) VALUES (1, 'john smith', '+243993315152', 'johnsmith@gmail.com', 'Goma tmk quartier mabanga', '2021-02-10 08:40:13');
INSERT INTO `client` (`idclient`, `fullname`, `tel`, `email`, `adresse`, `created_at`) VALUES (2, 'janny smith', '0819891527', 'janny@gmail.com', 'Goma quartier office 2', '2021-02-10 08:41:08');
INSERT INTO `client` (`idclient`, `fullname`, `tel`, `email`, `adresse`, `created_at`) VALUES (3, 'mafutala baruani', '+243993315152', 'mafutala@gmail.com', 'Goma avenue de la paix', '2021-02-10 08:42:15');
INSERT INTO `client` (`idclient`, `fullname`, `tel`, `email`, `adresse`, `created_at`) VALUES (4, 'jeremie joh sumbu', '+243892345691', 'jeremie@gmail.com', 'Goma quartier des volcans!', '2021-02-10 08:44:14');
INSERT INTO `client` (`idclient`, `fullname`, `tel`, `email`, `adresse`, `created_at`) VALUES (5, 'kakoko makolo', '0829891527', 'kakoko@gmail.com', 'Goma quartier 7 bougies', '2021-02-10 08:47:49');
INSERT INTO `client` (`idclient`, `fullname`, `tel`, `email`, `adresse`, `created_at`) VALUES (6, 'Isaac muhyana', '+243993315152', 'isaac@gmail.com', 'Goma quartier tmk', '2021-02-11 17:08:19');
INSERT INTO `client` (`idclient`, `fullname`, `tel`, `email`, `adresse`, `created_at`) VALUES (7, 'pascovich kauzi', '0819891527', 'pascovich@gmail.com', '7 bougies', '2021-02-11 18:26:26');


#
# TABLE STRUCTURE FOR: entreprise
#

DROP TABLE IF EXISTS `entreprise`;

CREATE TABLE `entreprise` (
  `ide` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(300) DEFAULT NULL,
  `numrcm` varchar(300) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ide`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `entreprise` (`ide`, `designation`, `numrcm`, `created_at`) VALUES (4, 'kase chine', '123nv76G-DRC', '2021-02-09 13:55:46');
INSERT INTO `entreprise` (`ide`, `designation`, `numrcm`, `created_at`) VALUES (5, 'tukotuu', 'EF124nv76G-DRC', '2021-02-09 13:56:41');


#
# TABLE STRUCTURE FOR: galerie
#

DROP TABLE IF EXISTS `galerie`;

CREATE TABLE `galerie` (
  `idg` int(11) NOT NULL AUTO_INCREMENT,
  `adresse` varchar(300) DEFAULT NULL,
  `ide` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idg`),
  KEY `ide` (`ide`),
  CONSTRAINT `galerie_ibfk_1` FOREIGN KEY (`ide`) REFERENCES `entreprise` (`ide`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `galerie` (`idg`, `adresse`, `ide`, `created_at`) VALUES (4, 'kase chine quartier 1km témoin', 4, '2021-02-09 14:36:26');
INSERT INTO `galerie` (`idg`, `adresse`, `ide`, `created_at`) VALUES (5, 'Kase quartier birere', 4, '2021-02-09 14:37:06');


#
# TABLE STRUCTURE FOR: location
#

DROP TABLE IF EXISTS `location`;

CREATE TABLE `location` (
  `idl` int(11) NOT NULL AUTO_INCREMENT,
  `idchambre` int(11) DEFAULT NULL,
  `idclient` int(11) DEFAULT NULL,
  `montant` int(11) DEFAULT NULL,
  `date_debit` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idl`),
  KEY `idchambre` (`idchambre`),
  KEY `idclient` (`idclient`),
  CONSTRAINT `location_ibfk_1` FOREIGN KEY (`idchambre`) REFERENCES `chambre` (`idchambre`) ON DELETE CASCADE,
  CONSTRAINT `location_ibfk_2` FOREIGN KEY (`idclient`) REFERENCES `client` (`idclient`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

INSERT INTO `location` (`idl`, `idchambre`, `idclient`, `montant`, `date_debit`, `date_fin`, `created_at`) VALUES (11, 10, 6, 10, '2021-02-11', '2021-08-11', '2021-02-11 17:42:16');
INSERT INTO `location` (`idl`, `idchambre`, `idclient`, `montant`, `date_debit`, `date_fin`, `created_at`) VALUES (12, 5, 2, 15, '2021-02-11', '2021-04-11', '2021-02-11 17:42:38');
INSERT INTO `location` (`idl`, `idchambre`, `idclient`, `montant`, `date_debit`, `date_fin`, `created_at`) VALUES (13, 6, 4, 10, '2021-02-11', '2021-02-14', '2021-02-11 20:51:05');
INSERT INTO `location` (`idl`, `idchambre`, `idclient`, `montant`, `date_debit`, `date_fin`, `created_at`) VALUES (14, 6, 4, 10, '2021-02-11', '2021-02-15', '2021-02-11 20:51:05');


#
# TABLE STRUCTURE FOR: notification
#

DROP TABLE IF EXISTS `notification`;

CREATE TABLE `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(800) DEFAULT NULL,
  `url` varchar(800) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `icone` varchar(300) DEFAULT NULL,
  `titre` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

INSERT INTO `notification` (`id`, `message`, `url`, `id_user`, `created_at`, `icone`, `titre`) VALUES (21, 'janny smith vient de payer 30$', 'admin/compte', 2, '2021-02-11 17:22:58', 'fa fa-money', 'nouveau paiement');
INSERT INTO `notification` (`id`, `message`, `url`, `id_user`, `created_at`, `icone`, `titre`) VALUES (22, 'Isaac muhyana vient de payer 60$', 'admin/compte', 2, '2021-02-11 17:43:12', 'fa fa-money', 'nouveau paiement');
INSERT INTO `notification` (`id`, `message`, `url`, `id_user`, `created_at`, `icone`, `titre`) VALUES (23, 'janny smith vient de payer 30$', 'admin/compte', 2, '2021-02-11 17:44:12', 'fa fa-money', 'nouveau paiement');


#
# TABLE STRUCTURE FOR: online
#

DROP TABLE IF EXISTS `online`;

CREATE TABLE `online` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `online_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `online` (`id`, `id_user`, `created_at`) VALUES (2, 2, '2021-02-11 21:01:58');


#
# TABLE STRUCTURE FOR: paiement
#

DROP TABLE IF EXISTS `paiement`;

CREATE TABLE `paiement` (
  `idp` int(11) NOT NULL AUTO_INCREMENT,
  `idl` int(11) DEFAULT NULL,
  `date_paie` date DEFAULT NULL,
  `montant` float DEFAULT NULL,
  `motif` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idp`),
  KEY `idl` (`idl`),
  CONSTRAINT `paiement_ibfk_1` FOREIGN KEY (`idl`) REFERENCES `location` (`idl`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

INSERT INTO `paiement` (`idp`, `idl`, `date_paie`, `montant`, `motif`, `created_at`) VALUES (18, 11, '2021-02-11', '60', 'paiement loyer', '2021-02-11 17:43:12');
INSERT INTO `paiement` (`idp`, `idl`, `date_paie`, `montant`, `motif`, `created_at`) VALUES (19, 12, '2021-02-09', '30', 'paiement loyer pour location chambre b', '2021-02-11 17:44:12');


#
# TABLE STRUCTURE FOR: poste
#

DROP TABLE IF EXISTS `poste`;

CREATE TABLE `poste` (
  `idposte` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(300) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idposte`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `poste` (`idposte`, `designation`, `created_at`) VALUES (1, 'superviseur', '2021-02-09 12:52:24');
INSERT INTO `poste` (`idposte`, `designation`, `created_at`) VALUES (2, 'contrôleur ', '2021-02-09 12:52:37');


#
# TABLE STRUCTURE FOR: profile_chambre
#

DROP TABLE IF EXISTS `profile_chambre`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `profile_chambre` AS select `chambre`.`idchambre` AS `idchambre`,`chambre`.`nom` AS `nom`,`chambre`.`idg` AS `idg`,`chambre`.`idtype` AS `idtype`,`chambre`.`etat` AS `etat`,`chambre`.`montant` AS `montant`,`chambre`.`created_at` AS `created_at`,`galerie`.`adresse` AS `adresse`,`galerie`.`ide` AS `ide`,`type`.`designation` AS `designation` from ((`chambre` join `galerie` on((`chambre`.`idg` = `galerie`.`idg`))) join `type` on((`chambre`.`idtype` = `type`.`idtype`)));

utf8mb4_unicode_ci;

INSERT INTO `profile_chambre` (`idchambre`, `nom`, `idg`, `idtype`, `etat`, `montant`, `created_at`, `adresse`, `ide`, `designation`) VALUES (5, 'chambre B', 4, 5, 1, 15, '2021-02-10 11:03:04', 'kase chine quartier 1km témoin', 4, 'aux enchères');
INSERT INTO `profile_chambre` (`idchambre`, `nom`, `idg`, `idtype`, `etat`, `montant`, `created_at`, `adresse`, `ide`, `designation`) VALUES (6, 'chambre C', 5, 4, 0, 13, '2021-02-10 11:03:29', 'Kase quartier birere', 4, 'étalage ');
INSERT INTO `profile_chambre` (`idchambre`, `nom`, `idg`, `idtype`, `etat`, `montant`, `created_at`, `adresse`, `ide`, `designation`) VALUES (7, 'chambre D', 4, 4, 0, 20, '2021-02-11 17:05:38', 'kase chine quartier 1km témoin', 4, 'étalage ');
INSERT INTO `profile_chambre` (`idchambre`, `nom`, `idg`, `idtype`, `etat`, `montant`, `created_at`, `adresse`, `ide`, `designation`) VALUES (8, 'chambre E', 4, 4, 0, 15, '2021-02-11 17:05:52', 'kase chine quartier 1km témoin', 4, 'étalage ');
INSERT INTO `profile_chambre` (`idchambre`, `nom`, `idg`, `idtype`, `etat`, `montant`, `created_at`, `adresse`, `ide`, `designation`) VALUES (9, 'chambre F', 4, 4, 0, 30, '2021-02-11 17:06:06', 'kase chine quartier 1km témoin', 4, 'étalage ');
INSERT INTO `profile_chambre` (`idchambre`, `nom`, `idg`, `idtype`, `etat`, `montant`, `created_at`, `adresse`, `ide`, `designation`) VALUES (10, 'chambre A', 4, 5, 1, 10, '2021-02-11 17:06:40', 'kase chine quartier 1km témoin', 4, 'aux enchères');


#
# TABLE STRUCTURE FOR: profile_galerie
#

DROP TABLE IF EXISTS `profile_galerie`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `profile_galerie` AS select `galerie`.`idg` AS `idg`,`galerie`.`adresse` AS `adresse`,`galerie`.`created_at` AS `created_at`,`galerie`.`ide` AS `ide`,`entreprise`.`designation` AS `designation`,`entreprise`.`numrcm` AS `numrcm` from (`galerie` join `entreprise` on((`galerie`.`ide` = `entreprise`.`ide`)));

utf8mb4_unicode_ci;

INSERT INTO `profile_galerie` (`idg`, `adresse`, `created_at`, `ide`, `designation`, `numrcm`) VALUES (4, 'kase chine quartier 1km témoin', '2021-02-09 14:36:26', 4, 'kase chine', '123nv76G-DRC');
INSERT INTO `profile_galerie` (`idg`, `adresse`, `created_at`, `ide`, `designation`, `numrcm`) VALUES (5, 'Kase quartier birere', '2021-02-09 14:37:06', 4, 'kase chine', '123nv76G-DRC');


#
# TABLE STRUCTURE FOR: profile_location
#

DROP TABLE IF EXISTS `profile_location`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `profile_location` AS select `location`.`idl` AS `idl`,`location`.`idchambre` AS `idchambre`,`location`.`idclient` AS `idclient`,`location`.`montant` AS `montant`,`location`.`date_debit` AS `date_debit`,`location`.`date_fin` AS `date_fin`,`location`.`created_at` AS `created_at`,`chambre`.`nom` AS `nom`,`chambre`.`etat` AS `etat`,`client`.`fullname` AS `fullname`,`client`.`tel` AS `tel`,`client`.`adresse` AS `adresse`,`client`.`email` AS `email` from ((`location` join `chambre` on((`location`.`idchambre` = `chambre`.`idchambre`))) join `client` on((`location`.`idclient` = `client`.`idclient`)));

utf8mb4_unicode_ci;

INSERT INTO `profile_location` (`idl`, `idchambre`, `idclient`, `montant`, `date_debit`, `date_fin`, `created_at`, `nom`, `etat`, `fullname`, `tel`, `adresse`, `email`) VALUES (11, 10, 6, 10, '2021-02-11', '2021-08-11', '2021-02-11 17:42:16', 'chambre A', 1, 'Isaac muhyana', '+243993315152', 'Goma quartier tmk', 'isaac@gmail.com');
INSERT INTO `profile_location` (`idl`, `idchambre`, `idclient`, `montant`, `date_debit`, `date_fin`, `created_at`, `nom`, `etat`, `fullname`, `tel`, `adresse`, `email`) VALUES (12, 5, 2, 15, '2021-02-11', '2021-04-11', '2021-02-11 17:42:38', 'chambre B', 1, 'janny smith', '0819891527', 'Goma quartier office 2', 'janny@gmail.com');
INSERT INTO `profile_location` (`idl`, `idchambre`, `idclient`, `montant`, `date_debit`, `date_fin`, `created_at`, `nom`, `etat`, `fullname`, `tel`, `adresse`, `email`) VALUES (13, 6, 4, 10, '2021-02-11', '2021-02-14', '2021-02-11 20:51:05', 'chambre C', 0, 'jeremie joh sumbu', '+243892345691', 'Goma quartier des volcans!', 'jeremie@gmail.com');
INSERT INTO `profile_location` (`idl`, `idchambre`, `idclient`, `montant`, `date_debit`, `date_fin`, `created_at`, `nom`, `etat`, `fullname`, `tel`, `adresse`, `email`) VALUES (14, 6, 4, 10, '2021-02-11', '2021-02-15', '2021-02-11 20:51:05', 'chambre C', 0, 'jeremie joh sumbu', '+243892345691', 'Goma quartier des volcans!', 'jeremie@gmail.com');


#
# TABLE STRUCTURE FOR: profile_paiement
#

DROP TABLE IF EXISTS `profile_paiement`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `profile_paiement` AS select `paiement`.`idp` AS `idp`,`paiement`.`idl` AS `idl`,`paiement`.`montant` AS `montant`,`paiement`.`motif` AS `motif`,`paiement`.`created_at` AS `created_at`,`paiement`.`date_paie` AS `date_paie`,`client`.`idclient` AS `idclient`,`client`.`fullname` AS `fullname`,`client`.`tel` AS `tel`,`chambre`.`nom` AS `nom` from (((`paiement` join `location` on((`paiement`.`idl` = `location`.`idl`))) join `chambre` on((`location`.`idchambre` = `chambre`.`idchambre`))) join `client` on((`location`.`idclient` = `client`.`idclient`)));

utf8mb4_unicode_ci;

INSERT INTO `profile_paiement` (`idp`, `idl`, `montant`, `motif`, `created_at`, `date_paie`, `idclient`, `fullname`, `tel`, `nom`) VALUES (18, 11, '60', 'paiement loyer', '2021-02-11 17:43:12', '2021-02-11', 6, 'Isaac muhyana', '+243993315152', 'chambre A');
INSERT INTO `profile_paiement` (`idp`, `idl`, `montant`, `motif`, `created_at`, `date_paie`, `idclient`, `fullname`, `tel`, `nom`) VALUES (19, 12, '30', 'paiement loyer pour location chambre b', '2021-02-11 17:44:12', '2021-02-09', 2, 'janny smith', '0819891527', 'chambre B');


#
# TABLE STRUCTURE FOR: profile_users
#

DROP TABLE IF EXISTS `profile_users`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `profile_users` AS select `users`.`id` AS `id`,`users`.`first_name` AS `first_name`,`users`.`last_name` AS `last_name`,`users`.`email` AS `email`,`users`.`image` AS `image`,`users`.`telephone` AS `telephone`,`users`.`full_adresse` AS `full_adresse`,`users`.`biographie` AS `biographie`,`users`.`date_nais` AS `date_nais`,`users`.`passwords` AS `passwords`,`users`.`idrole` AS `idrole`,`users`.`sexe` AS `sexe`,`users`.`facebook` AS `facebook`,`users`.`twitter` AS `twitter`,`users`.`linkedin` AS `linkedin`,`users`.`idposte` AS `idposte`,`role`.`nom` AS `nom`,`poste`.`designation` AS `designation` from ((`users` join `role` on((`users`.`idrole` = `role`.`idrole`))) join `poste` on((`users`.`idposte` = `poste`.`idposte`)));

utf8mb4_unicode_ci;

INSERT INTO `profile_users` (`id`, `first_name`, `last_name`, `email`, `image`, `telephone`, `full_adresse`, `biographie`, `date_nais`, `passwords`, `idrole`, `sexe`, `facebook`, `twitter`, `linkedin`, `idposte`, `nom`, `designation`) VALUES (2, 'sumaili shabani ', 'roger', 'sumailiroger681@gmail.com', '1388090931.jpg', '+243817883541', 'tmk goma avenue mushanganya n°59', '                  	                  	Entrepreneur en temps plein!                                    ', '1998-08-12', '9db09d6ae665e42340ef0b1ef1eb95b4', 1, 'M', 'https://www.facebook.com/patronat.shabanisumaili.9/', 'https://twitter.com/RogerPatrona', 'https://www.linkedin.com/in/sumaili-shabani-roger-patr%C3%B4na-7426a71a1/', 1, 'admin', 'superviseur');
INSERT INTO `profile_users` (`id`, `first_name`, `last_name`, `email`, `image`, `telephone`, `full_adresse`, `biographie`, `date_nais`, `passwords`, `idrole`, `sexe`, `facebook`, `twitter`, `linkedin`, `idposte`, `nom`, `designation`) VALUES (3, 'kasumba kipundula', 'bertin', 'kaumba@gmail.com', '416547050.jpg', '081989152', 'Apple est mon préféré!', NULL, '1999-02-08', '9db09d6ae665e42340ef0b1ef1eb95b4', 2, 'M', NULL, NULL, NULL, 1, 'user ', 'superviseur');
INSERT INTO `profile_users` (`id`, `first_name`, `last_name`, `email`, `image`, `telephone`, `full_adresse`, `biographie`, `date_nais`, `passwords`, `idrole`, `sexe`, `facebook`, `twitter`, `linkedin`, `idposte`, `nom`, `designation`) VALUES (4, 'madeleine stephanie', 'pataule', 'madeleine@gmail.com', '232278731.jpg', '081989152', 'my life it never goas slowly', NULL, '2000-02-08', 'e10adc3949ba59abbe56e057f20f883e', 2, 'F', NULL, NULL, NULL, 1, 'user ', 'superviseur');
INSERT INTO `profile_users` (`id`, `first_name`, `last_name`, `email`, `image`, `telephone`, `full_adresse`, `biographie`, `date_nais`, `passwords`, `idrole`, `sexe`, `facebook`, `twitter`, `linkedin`, `idposte`, `nom`, `designation`) VALUES (5, 'janny bouar', 'smith', 'janny@gmail.com', '1245831232.jpg', '081989152', 'nice is good', NULL, '2000-02-02', 'e10adc3949ba59abbe56e057f20f883e', 2, 'F', NULL, NULL, NULL, 2, 'user ', 'contrôleur ');
INSERT INTO `profile_users` (`id`, `first_name`, `last_name`, `email`, `image`, `telephone`, `full_adresse`, `biographie`, `date_nais`, `passwords`, `idrole`, `sexe`, `facebook`, `twitter`, `linkedin`, `idposte`, `nom`, `designation`) VALUES (6, 'yuma kayanda', 'françois', 'yuma@gmail.com', '761132721.JPG', '0819891527', 'Si Dieu est pour moi qui sera contre moi!', 'Codons comme on respire!', '1995-01-09', 'e10adc3949ba59abbe56e057f20f883e', 2, 'M', 'https://facebook.com/', 'https://twitter.com/', 'https://linkedin.com/', 2, 'user ', 'contrôleur ');


#
# TABLE STRUCTURE FOR: recupere
#

DROP TABLE IF EXISTS `recupere`;

CREATE TABLE `recupere` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `verification_key` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `recupere` (`id`, `email`, `verification_key`) VALUES (1, 'sumailiroger681@gmail.com', '9a9bbe0c7da075d3eb095e5711073e0a');
INSERT INTO `recupere` (`id`, `email`, `verification_key`) VALUES (2, 'sumailiroger681@gmail.com', 'e39864f5c431829e783bc0328f4d66ee');


#
# TABLE STRUCTURE FOR: role
#

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `idrole` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(300) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idrole`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `role` (`idrole`, `nom`, `created_at`) VALUES (1, 'admin', '2021-02-08 16:10:38');
INSERT INTO `role` (`idrole`, `nom`, `created_at`) VALUES (2, 'user ', '2021-02-08 16:12:38');


#
# TABLE STRUCTURE FOR: type
#

DROP TABLE IF EXISTS `type`;

CREATE TABLE `type` (
  `idtype` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(300) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idtype`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `type` (`idtype`, `designation`, `created_at`) VALUES (4, 'étalage ', '2021-02-09 17:20:04');
INSERT INTO `type` (`idtype`, `designation`, `created_at`) VALUES (5, 'aux enchères', '2021-02-09 17:24:30');


#
# TABLE STRUCTURE FOR: users
#

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(300) DEFAULT NULL,
  `last_name` varchar(300) DEFAULT NULL,
  `email` varchar(300) DEFAULT NULL,
  `image` varchar(300) DEFAULT NULL,
  `telephone` varchar(300) DEFAULT NULL,
  `full_adresse` text,
  `biographie` text,
  `date_nais` date DEFAULT NULL,
  `passwords` varchar(300) DEFAULT NULL,
  `idrole` int(11) NOT NULL,
  `sexe` varchar(30) DEFAULT NULL,
  `facebook` varchar(900) DEFAULT NULL,
  `linkedin` varchar(900) DEFAULT NULL,
  `twitter` varchar(900) DEFAULT NULL,
  `idposte` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idrole` (`idrole`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`idrole`) REFERENCES `role` (`idrole`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `image`, `telephone`, `full_adresse`, `biographie`, `date_nais`, `passwords`, `idrole`, `sexe`, `facebook`, `linkedin`, `twitter`, `idposte`) VALUES (2, 'sumaili shabani ', 'roger', 'sumailiroger681@gmail.com', '1388090931.jpg', '+243817883541', 'tmk goma avenue mushanganya n°59', '                  	                  	Entrepreneur en temps plein!                                    ', '1998-08-12', '9db09d6ae665e42340ef0b1ef1eb95b4', 1, 'M', 'https://www.facebook.com/patronat.shabanisumaili.9/', 'https://www.linkedin.com/in/sumaili-shabani-roger-patr%C3%B4na-7426a71a1/', 'https://twitter.com/RogerPatrona', 1);
INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `image`, `telephone`, `full_adresse`, `biographie`, `date_nais`, `passwords`, `idrole`, `sexe`, `facebook`, `linkedin`, `twitter`, `idposte`) VALUES (3, 'kasumba kipundula', 'bertin', 'kaumba@gmail.com', '416547050.jpg', '081989152', 'Apple est mon préféré!', NULL, '1999-02-08', '9db09d6ae665e42340ef0b1ef1eb95b4', 2, 'M', NULL, NULL, NULL, 1);
INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `image`, `telephone`, `full_adresse`, `biographie`, `date_nais`, `passwords`, `idrole`, `sexe`, `facebook`, `linkedin`, `twitter`, `idposte`) VALUES (4, 'madeleine stephanie', 'pataule', 'madeleine@gmail.com', '232278731.jpg', '081989152', 'my life it never goas slowly', NULL, '2000-02-08', 'e10adc3949ba59abbe56e057f20f883e', 2, 'F', NULL, NULL, NULL, 1);
INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `image`, `telephone`, `full_adresse`, `biographie`, `date_nais`, `passwords`, `idrole`, `sexe`, `facebook`, `linkedin`, `twitter`, `idposte`) VALUES (5, 'janny bouar', 'smith', 'janny@gmail.com', '1245831232.jpg', '081989152', 'nice is good', NULL, '2000-02-02', 'e10adc3949ba59abbe56e057f20f883e', 2, 'F', NULL, NULL, NULL, 2);
INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `image`, `telephone`, `full_adresse`, `biographie`, `date_nais`, `passwords`, `idrole`, `sexe`, `facebook`, `linkedin`, `twitter`, `idposte`) VALUES (6, 'yuma kayanda', 'françois', 'yuma@gmail.com', '761132721.JPG', '0819891527', 'Si Dieu est pour moi qui sera contre moi!', 'Codons comme on respire!', '1995-01-09', 'e10adc3949ba59abbe56e057f20f883e', 2, 'M', 'https://facebook.com/', 'https://linkedin.com/', 'https://twitter.com/', 2);


