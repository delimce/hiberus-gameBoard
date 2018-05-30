<?php

class GameBoard
{
    private $rows = 3;
    private $columns = 3;
    private $player1 = X;
    private $player2 = O;
    private $borders = array(11, 11, 13, 11, 11, 13, 31, 31, 0);
    private $plays;
    private $nplays;
    private $ready_player;
    private $last_player;

    function __construct()
    { ///constructor
        $this->plays = $this->getPlays();
        $this->getPlayerTurn();
    }

    public function drawBoard()
    {
        $z = 0;

        $player = $this->ready_player;

        for ($i = 0; $i < $this->rows; $i++) {
            for ($j = 0; $j < $this->columns; $j++) {
                $row = $i + 1;
                $column = $j + 1;
                $play = $this->findPlay($row, $column);
                $style = (!$play) ? 'play-me' : '';
                print '<div class="cell cell-' . $this->borders[$z] . ' ' . $style . '">';
                if (!$play) {
                    print "<span
                     class='next-play' 
                     title='Jugar aqui!'
                     data-row='$row'
                     data-column='$column'
                     data-player='$player'>
                     &nbsp&nbsp&nbsp&nbsp&nbsp</span>";
                } else {
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
        pg.player
        FROM
        tbl_player_game AS pg
        order by pg.line,pg.col");
        $plays = $db->getMatrixDb();
        ///numero de jugadas hechas
        $this->nplays = count($plays);
        $db->cerrar();
        return $plays;
    }

    private function findPlay($row, $column)
    {
        $isPlay = false;
        if (count($this->plays) > 0) {
            foreach ($this->plays as $item) {

                if ($item["line"] == $row && $item["col"] == $column) {
                    $isPlay = ($item["player"] == 1) ? $this->player1 : $this->player2;
                    break;
                }
            }
        }
        return $isPlay;

    }

    public function getPlayerTurn()
    {

        $db = new ObjectDB();
        $db->setSql("select player from tbl_player_game order by id desc limit 1");
        $db->getResultFields();
        $player = $db->getField("player");
        $this->last_player = $player;
        $this->ready_player = ($player == 1) ? 2 : 1;
        return $this->ready_player;

    }

    public function getPlayer()
    {
        return ($this->ready_player == 1) ? $this->player1 : $this->player2;
    }

    public function getLastPlayer()
    {
        return $this->last_player;
    }


    public function getNplays()
    {
        return $this->nplays;
    }

    
    public function getWinner(){
        return ($this->last_player == 1) ? $this->player1 : $this->player2;
    }


    public function findingWinner()
    {
        if (count($this->plays) == 0) return 0;

        $winner = 0;
        $player = $this->last_player;
        $contR1 = 0;
        $contR2 = 0;
        $contR3 = 0;
        $contC1 = 0;
        $contC2 = 0;
        $contC3 = 0;
        $contD1 = 0;
        $contD2 = 0;

        foreach ($this->plays as $item) {
               ///finding by rows
            if ($item["line"] == 1 && $item["player"] == $player)
                $contR1++;
            if ($item["line"] == 2 && $item["player"] == $player)
                $contR2++;
            if ($item["line"] == 3 && $item["player"] == $player)
                $contR3++;
               ////finding by columns
            if ($item["col"] == 1 && $item["player"] == $player)
                $contC1++;
            if ($item["col"] == 2 && $item["player"] == $player)
                $contC2++;
            if ($item["col"] == 3 && $item["player"] == $player)
                $contC3++;
            if ($item["col"] == $item["line"] && $item["player"] == $player)
                $contD1++;   
            if ($item["col"] == $this->d2Calc($item["line"]) && $item["player"] == $player)
                $contD2++;
        }

        //verifying
        if ($contR1 == 3 || $contR2 == 3 || $contR3 == 3 
        || $contC1 == 3  || $contC2 == 3 || $contC3 == 3 
        || $contD1 == 3  || $contD2 == 3)
            $winner = $player;

        return $winner;

    }


    private function d2Calc($i){
       return (3 - ($i-1));
    }


}

?>