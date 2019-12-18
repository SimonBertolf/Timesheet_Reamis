
-- Exportiere Datenbank Struktur für timesheet_reamis
CREATE DATABASE IF NOT EXISTS `timesheet_reamis` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `timesheet_reamis`;

-- Exportiere Struktur von Tabelle timesheet_reamis.authorization
CREATE TABLE IF NOT EXISTS `authorization` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `projectid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `projectid` (`projectid`),
  CONSTRAINT `FK_authorization_project` FOREIGN KEY (`projectid`) REFERENCES `project` (`id`),
  CONSTRAINT `FK_authorization_user` FOREIGN KEY (`userid`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COMMENT='Berechtigung wer an welchem Projeckt arbeitet';


-- Exportiere Struktur von Tabelle timesheet_reamis.project
CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `projectname` varchar(50) NOT NULL DEFAULT '',
  `description` varchar(50) DEFAULT NULL COMMENT 'project description',
  `budget` int(11) DEFAULT NULL COMMENT 'time budget',
  `archive` enum('true','false') NOT NULL DEFAULT 'false' COMMENT 'true for finished projects',
  `projectnr` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `projectname` (`projectname`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='Zum erfassen von Projekten';

-- Exportiere Daten aus Tabelle timesheet_reamis.project: ~-1 rows (ungefähr)
DELETE FROM `project`;
/*!40000 ALTER TABLE `project` DISABLE KEYS */;
INSERT INTO `project` (`id`, `projectname`, `description`, `budget`, `archive`, `projectnr`) VALUES
	(1, 'Ferien', 'Abwesenheit durch Ferien', 0, 'false', '1'),
	(2, 'Krankheit', 'Abwesenheit durch Krankheit', 0, 'false', '2'),
/*!40000 ALTER TABLE `project` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle timesheet_reamis.time
CREATE TABLE IF NOT EXISTS `time` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `projectid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` float NOT NULL COMMENT 'Worktime in houres',
  `task` varchar(50) DEFAULT NULL COMMENT 'Worktask description ',
  `start` time DEFAULT NULL COMMENT 'Start time',
  `stop` time DEFAULT NULL COMMENT 'End time',
  PRIMARY KEY (`id`),
  KEY `projectid` (`projectid`),
  KEY `userid` (`userid`),
  CONSTRAINT `FK_time_project` FOREIGN KEY (`projectid`) REFERENCES `project` (`id`),
  CONSTRAINT `FK_time_user` FOREIGN KEY (`userid`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8 COMMENT='Für die Arbeitszeiten';

-- Exportiere Struktur von Tabelle timesheet_reamis.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL COMMENT 'md5 ',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT 'full name',
  `quote` int(11) NOT NULL DEFAULT '8' COMMENT 'daily quote in houres',
  `typ` enum('admin','controller','standard') NOT NULL DEFAULT 'standard',
  `status` enum('active','passive') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `userid` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='Zum erfassen der Benutzer';
