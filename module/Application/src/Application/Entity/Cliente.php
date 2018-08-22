<?php

namespace Application\Entity;

use Application\Interfaces\ObjectEntity;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Cliente
 *
 * @ORM\Table(name="cliente", indexes={
 *      @ORM\Index(name="fk_cliente_regiao_idx", columns={"REGIAO_ID"})
 *  }
 * )
 * @ORM\Entity(repositoryClass="Application\Repository\ClienteRepository")
 * @Gedmo\SoftDeleteable(fieldName="dataExclusao", timeAware=false)
 *
 */
class Cliente extends AbstractEntity implements ObjectEntity
{

    const SIZE_FOTO = '5MB';
    const EXTENSION_FOTO = 'jpg,jpeg,png,gif';
    const PATH = './data/upload/clientes';

    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="EMAIL", type="string", length=150, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="NOME", type="string", length=150, nullable=false)
     */
    private $nome;

    /**
     *
     * @var string
     *
     * @ORM\Column(name="TELEFONE", type="string", length=45, nullable=false)
     */
    private $telefone;

    /**
     * @var string
     *
     * @ORM\Column(name="FOTO", type="string", length=150, nullable=true)
     */
    private $foto;

    /**
     *
     * @var string
     *
     * @ORM\Column(name="CPF_CNPJ", type="string", length=50, nullable=true)
     */
    private $cpfCnpj;

    /**
     *
     * @var string
     *
     * @ORM\Column(name="TIPO_CLIENTE", type="string", length=50, nullable=true)
     */
    private $tipo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IS_ATIVO", type="boolean", nullable=false, options={"default" = 1})
     *
     */
    private $ativo;

    /**
     * @var \Application\Entity\Regiao
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Regiao")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="REGIAO_ID", referencedColumnName="ID")
     * })
     */
    private $regiao;


    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="DATA_CRIACAO", type="datetime", nullable=true)
     */
    private $dataCriacao;

    /**
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="DATA_ATUALIZACAO", type="datetime", nullable=true)
     */
    private $dataAtualizacao;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATA_EXCLUSAO", type="datetime", nullable=true)
     */
    private $dataExclusao;

    /**
     * Atributo transiente, não persiste na base
     *
     * @var array
     *
     */
    private $fotoFile;

    /**
     * Cliente constructor.
     */
    public function __construct()
    {
        $this->ativo = 1;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Usuario
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Usuario
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     * @return Usuario
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * @return string
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * @param string $telefone
     * @return Usuario
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * @return string
     */
    public function getCpfCnpj()
    {
        return $this->cpfCnpj;
    }

    /**
     * @param string $cpfCnpj
     * @return Usuario
     */
    public function setCpfCnpj($cpfCnpj)
    {
        $this->cpfCnpj = $cpfCnpj;

        return $this;
    }

    /**
     * @return string
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * @param string $foto
     * @return Cliente
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param string $tipo
     * @return Usuario
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isAtivo()
    {
        return $this->ativo;
    }

    /**
     * @return boolean
     */
    public function getAtivo()
    {
        return $this->isAtivo();
    }

    /**
     * @param boolean $ativo
     * @return Cliente
     */
    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;

        return $this;
    }

    /**
     * @return Regiao
     */
    public function getRegiao()
    {
        return $this->regiao;
    }

    /**
     * @param Regiao $regiao
     * @return Cliente
     */
    public function setRegiao($regiao)
    {
        $this->regiao = $regiao;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDataCriacao()
    {
        return $this->dataCriacao;
    }

    /**
     * @param mixed $dataCriacao
     * @return Usuario
     */
    public function setDataCriacao($dataCriacao)
    {
        $this->dataCriacao = $dataCriacao;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDataAtualizacao()
    {
        return $this->dataAtualizacao;
    }

    /**
     * @param mixed $dataAtualizacao
     * @return Usuario
     */
    public function setDataAtualizacao($dataAtualizacao)
    {
        $this->dataAtualizacao = $dataAtualizacao;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDataExclusao()
    {
        return $this->dataExclusao;
    }

    /**
     * @param \DateTime $dataExclusao
     * @return Usuario
     */
    public function setDataExclusao($dataExclusao)
    {
        $this->dataExclusao = $dataExclusao;

        return $this;
    }

    /**
     * @return array
     */
    public function getFotoFile()
    {
        return $this->fotoFile;
    }

    /**
     * @param array $fotoFile
     * @return Cliente
     */
    public function setFotoFile($fotoFile)
    {
        $this->fotoFile = $fotoFile;
        return $this;
    }

    /**
     * @return bool
     */
    public function possuiFoto()
    {
        if (! empty($this->foto)) {
//            var_dump(BASE_PATH . $this->foto);
//            die('aaa');
            return file_exists(BASE_PATH . $this->foto);
        }

        return FALSE;
    }

}
