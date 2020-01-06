-- Exportiere Daten aus Tabelle timesheet_reamis.project: ~-1 rows (ungefähr)
DELETE FROM `project`;
/*!40000 ALTER TABLE `project` DISABLE KEYS */;
INSERT INTO `project` (`id`, `projectname`, `description`, `budget`, `archive`, `projectnr`) VALUES
	(1, 'Ferien', 'Abwesenheit durch Ferien', 0, 'false', '1'),
	(2, 'Krankheit', 'Abwesenheit durch Krankheit', 0, 'false', '2'),
	(3, 'Feiertag', 'Abwesenheit durch Feiertage', 0, 'false', '3'),
	(4, 'Timesheet Reamis', 'Ein Timesheet Projekt fpr Reamis AG', 500, 'false', 'A1000');
/*!40000 ALTER TABLE `project` ENABLE KEYS */;

-- Exportiere Daten aus Tabelle timesheet_reamis.user: ~-1 rows (ungefähr)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `password`, `name`, `quote`, `typ`, `status`) VALUES
	(1, 'Admin', '8d5e957f297893487bd98fa830fa6413', 'Admin', 8, 'admin', 'active'),
	(2, 'Controller', '8d5e957f297893487bd98fa830fa6413', 'Controller', 8, 'controller', 'active'),
	(3, 'Test', '8d5e957f297893487bd98fa830fa6413', 'Test User', 8.5, 'standard', 'active'),
	(4, 'Simon', '8d5e957f297893487bd98fa830fa6413', 'Simon Bertolf', 8.5, 'standard', 'active');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
