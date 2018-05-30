CREATE TABLE `tbl_player_game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player` int(11) NOT NULL,
  `line` int(11) NOT NULL COMMENT 'n of row (3x3 board)',
  `col` int(11) NOT NULL COMMENT 'n of column',
  `play` int(11) DEFAULT NULL COMMENT 'n# of play',
  PRIMARY KEY (`id`),
  KEY `player_id` (`player`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;