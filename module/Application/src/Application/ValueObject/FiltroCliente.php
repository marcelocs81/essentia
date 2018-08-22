<?php
/**
 * Created by Marcelo
 */

namespace Application\ValueObject;


class FiltroCliente
{

    private $nome;

    private $email;

    private $telefone;

    private $ativo;

    private $cpfCnpj;

    private $tipo;

    private $regiao;

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     * @return FiltroCliente
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return FiltroCliente
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * @param mixed $telefone
     * @return FiltroCliente
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAtivo()
    {
        return $this->ativo;
    }

    /**
     * @param mixed $ativo
     * @return FiltroCliente
     */
    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCpfCnpj()
    {
        return $this->cpfCnpj;
    }

    /**
     * @param mixed $cpfCnpj
     * @return FiltroCliente
     */
    public function setCpfCnpj($cpfCnpj)
    {
        $this->cpfCnpj = $cpfCnpj;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     * @return FiltroCliente
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRegiao()
    {
        return $this->regiao;
    }

    /**
     * @param mixed $regiao
     * @return FiltroCliente
     */
    public function setRegiao($regiao)
    {
        $this->regiao = $regiao;

        return $this;
    }

}