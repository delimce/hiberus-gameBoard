CREATE TABLE `tbl_player` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

CREATE TABLE `tbl_player_game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player_id` int(11) NOT NULL,
  `line` int(11) NOT NULL COMMENT 'n of row (3x3 board)',
  `col` int(11) NOT NULL COMMENT 'n of column',
  `play` int(11) DEFAULT NULL COMMENT 'n# of play',
  PRIMARY KEY (`id`),
  KEY `player_id` (`player_id`),
  CONSTRAINT `tbl_player_game_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `tbl_player` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;