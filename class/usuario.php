<?php

class Usuario{
    
    private $idlogin;
    private $nome;
    private $email;
    private $senha;
    
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

    public function loadByid($id){
        
        $sql = new Sql();
        $results = $sql->select("select * from login where login_id = :ID", array(
            ":ID" => $id
        ));
        
        if(count($results) > 0){
            
            $row = $results[0];
            
            $this->setIdlogin($row['login_id']);
            $this->setNome($row['nome']);
            $this->setEmail($row['email']);
            $this->setSenha($row['senha']);
            
        }
    }
    
    public static function getList(){
        
        $sql = new Sql();
        return $sql->select("select * from login order by nome");
    }
    
    public static function search($login){
        
        $sql = new Sql();
        return $sql->select ("select * from login where nome like :search", array(
            ":search"=>"%" . $login . "%"
        ));
    }
    
    public function login($login, $password){
        
        $sql = new Sql();
        $results = $sql->select("select * from login where email = :email and senha = :senha", array(
            ":email" => $login, ":senha"=> $password
        ));
        
        if(count($results) > 0){
            
            $row = $results[0];
            
            $this->setIdlogin($row['login_id']);
            $this->setNome($row['nome']);
            $this->setEmail($row['email']);
            $this->setSenha($row['senha']);
            
        }else{
            
            throw new Exception("E-mail e(ou) senha inválidos");
        }
    }
    
    public function __toString() {
        
        return json_encode(array(
            "id"=> $this->getIdlogin(),
            "nome"=> $this->getNome(),
            "email" => $this->getEmail(),
            "senha"=> $this->getSenha()
        ));
    }

}