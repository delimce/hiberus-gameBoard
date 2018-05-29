<?
//llama dinamicamente a todas las clases siempre y cuando tengan el mismo nombre del archivo .php para php5,php7

 function __autoload($class_name) { require_once $class_name . '.php';}
?>