<?php

require_once ("config.php");

$usuario = new Usuario();
$usuario->loadByid(1);

echo $usuario;


//$sql = new Sql();
//$usuarios = $sql->select("select * from login");
//echo json_encode($usuarios);

