<?php

class Usuario
{
    private $id;
    private $nome;
    private $sobrenome;
    private $telefone;
    private $login;
    private $senha;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        return $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        return $this->nome = $nome;
    }

    public function getSobrenome()
    {
        return $this->sobrenome;
    }

    public function setSobrenome($sobrenome)
    {
        return $this->sobrenome = $sobrenome;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone($telefone)
    {
        return $this->telefone = $telefone;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        return $this->login = $login;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        return $this->senha = $senha;
    }
}

?>