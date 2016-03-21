SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

use heroku_1d93613635eda50;

DROP TABLE IF EXISTS token;
DROP TABLE IF EXISTS internship_offer;
DROP TABLE IF EXISTS internship;
DROP TABLE IF EXISTS intern;
DROP TABLE IF EXISTS company;
DROP TABLE IF EXISTS student;
DROP TABLE IF EXISTS administrator;
DROP TABLE IF EXISTS user;
-- --------------------------------------------------------

--
-- Structure de la table `administrator`
--

CREATE TABLE IF NOT EXISTS `administrator` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `carry_out_internship`
--

CREATE TABLE IF NOT EXISTS `internship` (
  `id_company` int(11) NOT NULL,
  `id_intern` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `academic_year` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_company`,`id_intern`),
  KEY `FK_internship_id_intern` (`id_intern`),
  KEY `FK_internship_id_company` (`id_company`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL,
  `siret` varchar(25) NOT NULL,
  `sector` varchar(25) NOT NULL DEFAULT 'OTHER',
  `level` varchar(25) NOT NULL DEFAULT 'OTHER',
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `tutor` varchar(25) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `cedex` varchar(100) DEFAULT NULL,
  `postal_code` varchar(25) DEFAULT NULL,
  `city` varchar(25) DEFAULT NULL,
  `country` varchar(25) DEFAULT NULL,
  `website` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `siret` (`siret`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `intern`
--

CREATE TABLE IF NOT EXISTS `intern` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `internship_offer`
--

CREATE TABLE IF NOT EXISTS `internship_offer` (
  `id_company` int(11) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id_company`, `file_name`),
  KEY `FK_internship_offer_id` (`id_company`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------companytoken------------------------------------------------

--
-- Structure de la table `token`
--

CREATE TABLE IF NOT EXISTS `token` (
  `value` varchar(40) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date` double NOT NULL,
  `duration` double NOT NULL,
  PRIMARY KEY (`value`),
  KEY `FK_token_id` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `administrator`
--
ALTER TABLE `administrator`
  ADD CONSTRAINT `FK_administrator_id` FOREIGN KEY (`id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `internship`
--
ALTER TABLE `internship`
  ADD CONSTRAINT `FK_internship_id_intern` FOREIGN KEY (`id_intern`) REFERENCES `intern` (`id`),
  ADD CONSTRAINT `FK_internship_id_company` FOREIGN KEY (`id_company`) REFERENCES `company` (`id`);

--
-- Contraintes pour la table `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `FK_company_id` FOREIGN KEY (`id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `internship_offer`
--
ALTER TABLE `internship_offer`
  ADD CONSTRAINT `FK_internship_offer_id_company` FOREIGN KEY (`id_company`) REFERENCES `company` (`id`);

--
-- Contraintes pour la table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `FK_student_id` FOREIGN KEY (`id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `FK_token_id` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);
  
--
-- Contenu de la table user
--
INSERT INTO user (id, username, password) VALUES
(1, 'admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

--
-- Contenu de la table student
--

--
-- Contenu de la table administrator
--
INSERT INTO administrator VALUES (1);