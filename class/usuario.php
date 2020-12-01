<?php

class Usuario {

    private $idlogin;
    private $nome;
    private $email;
    private $senha;
    
    public function __construct($email = "", $senha = "") {
        $this->setEmail($email);
        $this->setSenha($senha);
    }

    function getIdlogin() {
        return $this->idlogin;
    }

    function getNome() {
        return $this->nome;
    }

    function getEmail() {
        return $this->email;
    }

    function getSenha() {
        return $this->senha;
    }

    function setIdlogin($idlogin): void {
        $this->idlogin = $idlogin;
    }

    function setNome($nome): void {
        $this->nome = $nome;
    }

    function setEmail($email): void {
        $this->email = $email;
    }

    function setSenha($senha): void {
        $this->senha = $senha;
    }

    public function loadByid($id) {

        $sql = new Sql();
        $results = $sql->select("select * from login where login_id = :ID", array(
            ":ID" => $id
        ));

        if (count($results) > 0) {

           $this->setData($results[0]);
        }
    }

    public static function getList() {

        $sql = new Sql();
        return $sql->select("select * from login order by nome");
    }

    public static function search($login) {

        $sql = new Sql();
        return $sql->select("select * from login where nome like :search", array(
                    ":search" => "%" . $login . "%"
        ));
    }

    public function login($login, $password) {

        $sql = new Sql();
        $results = $sql->select("select * from login where email = :email and senha = :senha", array(
            ":email" => $login, ":senha" => $password
        ));

        if (count($results) > 0) {

            $this->setData($results[0]);
        } else {

            throw new Exception("E-mail e(ou) senha inválidos");
        }
    }

    public function setData($data) {

        $this->setIdlogin($data['login_id']);
        $this->setNome($data['nome']);
        $this->setEmail($data['email']);
        $this->setSenha($data['senha']);
    }

    public function insert() {

        $sql = new Sql();
        $results = $sql->select("CALL sp_login_insert(:nome, :email, :senha)", array(
            ":nome" => $this->getNome(), ":email" => $this->getEmail(), ":senha" => $this->getSenha()
        ));
        
        if(count($results) > 0){
            $this->setData($results[0]);
        }
    }
    
    public function update($nome, $email, $senha){
        
        $this->setNome($nome);
        $this->setEmail($email);
        $this->setSenha($senha);
        
        $sql = new Sql();
        $sql->query("update login set nome = :n, email = :e, senha = :s where login_id = :id", array(
            "n"=> $this->getNome(), "e"=> $this->getEmail(), "s"=> $this->getSenha(), "id"=> $this->getIdlogin()
        ));
    }

    public function __toString() {

        return json_encode(array(
            "id" => $this->getIdlogin(),
            "nome" => $this->getNome(),
            "email" => $this->getEmail(),
            "senha" => $this->getSenha()
        ));
    }

}
