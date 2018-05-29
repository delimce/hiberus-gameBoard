<?php

class GameBoard  {

    private $rows = 3;
    private $columns = 3;
    private $borders = array(11,11,13,11,11,13,31,31,0);

    function __construct() { ///constructor de la clase
      
    }

    public function drawBoard(){

        $z=0;

        for ($i=0; $i<$this->rows; $i++){
            for ($j=0; $j<$this->columns; $j++){
                print '<div class="cell cell-'.$this->borders[$z].'">';
                print '</div>';
                $z++;

            }
        }

    }

}

?>