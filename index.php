<?php

include './utils/dbconfig.php';
include './utils/class/classes.php';

@$board = new GameBoard();

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Juego: Tres en raya</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/styles.css">
    </head>
    <body class="container">
            
            <div class="new-panel">
                <div class="panel panel-default">
                    <div class="panel-body">
                        Turno del Jugador: <?= $board->getPlayer() ?>
                    </div>
                </div>    

                <div id="board">
                   <?php $board->drawBoard(); ?>
                </div>
                <div class="n-plays">
                    Numero de jugadas:<?= $board->getNplays() ?>
                </div>             
            </div>

<div id="restart" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content" style="padding:25px">
        Caramba! EL juego ha quedado empatado, volver a jugar?<br><br>
        <button type="button" class="btn btn-primary resetGame">Reiniciar Juego</button>

    </div>
  </div>
</div>


<div id="winner" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content" style="padding:25px">
        <h1>Felicitaciones Jugador <?= $board->getWinner()?></h1>
        <p><b>Has ganado el Encuentro!</b></p>
        <button type="button" class="btn btn-primary resetGame">Reiniciar Juego</button>

    </div>
  </div>
</div>
     
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script>


$(function() {

       if(<?=$board->getNplays() ?>==9){
            $('#restart').modal('show');
        }else if(<?=$board->findingWinner() ?>>0){
            $('#winner').modal('show');  
        }

        $('.next-play').on('click',function(){

        var row = $(this).data('row');
        var column = $(this).data('column');
        var player = $(this).data('player');
        var data = {'row':row,'column':column, 'player':player, 'action':'play'}

        $.ajax({
        url: "./game/operations.php",
        type: 'post',
        data: data
        }).done(function (html) {
            location.reload(); 
        }).fail(function (error) {
        console.log(error);
        });
    })


     $('.resetGame').on('click',function(){
          var data = {'action':'restart'}
            $.ajax({
            url: "./game/operations.php",
            type: 'post',
            data: data
            }).done(function (html) {
                location.reload(); 
            }).fail(function (error) {
            console.log(error);
            });
        })

    });


    </script>
    </body>
</html>