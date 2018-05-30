<?php

include './utils/dbconfig.php';
include './utils/class/classes.php';

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
                $row = $i + 1;
                $column = $j + 1;
                $play = $this->findPlay($row,$column);
                $style = (!$play)?'play-me':'';
                print '<div class="cell cell-' . $this->borders[$z] . ' '.$style.'">';
                if(!$play){
                    print "<span
                     class='next-play' 
                     title='Jugar aqui!'
                     data-row='$row'
                     data-column='$column'
                     data-player='1'>&nbsp</span>";
                }else{
                    print $play;
                }
                print '</div>';
                $z++;

            }
        }
    }

    private function getPlays()
    {
        $db = new ObjectDB();
        $db->setSql("SELECT
        pg.`line`,
        pg.`col`,
        pg.play,
        p.number
        FROM
        tbl_player_game AS pg
        INNER JOIN tbl_player AS p ON pg.player_id = p.id
        order by pg.line,pg.col");
        $plays = $db->getMatrixDb();
        $db->cerrar();
        return $plays;
    }

    private function findPlay($row, $column)
    {

        $isPlay = false;
        if(count($this->plays)>0){
            foreach($this->plays as $item){

                if ($item["line"] == $row && $item["col"] == $column) {
                    $isPlay = ($item["number"] == 1) ? $this->player1 : $this->player2;
                    break;
                }
    
            }
        }
        return $isPlay;

    }

}

?>