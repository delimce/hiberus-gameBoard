<?php

require '../utils/dbconfig.php';
require '../utils/class/classes.php';

$action = $_REQUEST['action'];
$db = new ObjectDB();

switch ($action) {
    case 'play':

        $row = $_REQUEST['row'];
        $column = $_REQUEST['column'];
        $player = $_REQUEST['player'];

        $db->setTable("tbl_player_game");
        $db->setField("line",$row);
        $db->setField("col",$column);
        $db->setField("player",$player);
        $db->insertInTo();

        break;


        case 'restart':

        $db->setTable("tbl_player_game");
        $db->deleteWhere("id>0");
        
        break;

}

?>