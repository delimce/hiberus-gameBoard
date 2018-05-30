# hiberus-gameBoard
php game "3 in line" for a Job application

Juego "Tres en raya" construido en php con base de datos Mysql.

#Instalación:

1. Clonar el repositorio o descargar la carpeta del proyecto de: https://github.com/delimce/hiberus-gameBoard.git
2. crear una base de datos mysql para el juego e Ir a la carpeta /database y ejecutar el archivo: *game_db.sql* para crear la tabla necesaria para guardar las jugadas.
3. Editar el archivo de configuracion ubicado en: ./utils/dbconfig.php con los datos de la conexion al servidor de base de datos mysql y la base de datos del juego.
4. Ejecutar el archivo index.php para correr el juego.
 

#Requerimientos
1. Compatible con php 5.5.x .. php 7.x
2. Es necesario una conexion a internet desde el servidor de php para la carga de las librerias necesarias (jquery, etc...)