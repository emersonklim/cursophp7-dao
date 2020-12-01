<?php

require_once ("config.php");

//carrega um usuario
//$usuario = new Usuario();
//$usuario->loadByid(1);

//carrega todos os usuarios
//$usuario = Usuario::getList();
//echo json_encode($usuario);

//carrega atraves de uma pesquisa
//$login = "Emer";
//$usuario = Usuario::search($login);
//echo json_encode($usuario);

//carrega validando usuario e senha
//$usuario = new Usuario();
//$email = "emersonklim@hotmail.com";
//$senha = "123";
//$usuario->login($email, $senha);
//echo $usuario;

//criando um usuario
//$usuario = new Usuario("helio", "uno");
//$usuario->setNome("nando");
////$usuario->setEmail("nando@gmail.com");
////$usuario->setSenha("123");
//$usuario->insert();

//fazendo update do usuario
$usuario = new Usuario();

$usuario->loadByid(3);

$usuario->update("helio", "helio@gmail", "123");

//$sql = new Sql();
//$usuarios = $sql->select("select * from login");
//echo json_encode($usuarios);

