<?php

require_once './utils/dbconfig.php';
require_once './utils/class/classes.php';

class GameBoard
{

    private $rows = 3;
    private $columns = 3;
    private $player1 = X;
    private $player2 = O;
    private $borders = array(11, 11, 13, 11, 11, 13, 31, 31, 0);
    private $plays;

    function __construct()
    { ///constructor

    }

    public function drawBoard()
    {

        $this->plays = $this->getPlays();
        $z = 0;

        for ($i = 0; $i < $this->rows; $i++) {
            for ($j = 0; $j < $this->columns; $j++) {
                print '<div class="cell cell-' . $this->borders[$z] . '">';
                print $this->findPlay($i + 1, $j + 1);
                print '</div>';
                $z++;

            }
        }
    }


    private function getPlays()
    {
        $db = new ObjectDB();
        $db->setSql("SELECT
        pg.`row`,
        pg.`column`,
        pg.play,
        p.number
        FROM
        tbl_player_game AS pg
        INNER JOIN tbl_player AS p ON pg.player_id = p.id
        order by pg.row,pg.column");
        $plays = $db->getMatrixDb();
        $db->cerrar();
        return $plays;
    }

    private function findPlay($row, $column)
    {

        if (count($this->plays) > 0) {

            array_filter($this->plays, function ($item) use ($row, $column) {

                if ($item["row"] == $row && $item["column"] == $column) {
                    print($item["number"] == 1) ? $this->player1 : $this->player2;
                }

            });
        }

    }


}

?>