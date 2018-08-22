<?php
/**
 * Created by Marcelo
 */

namespace Application\Service;


use Application\Entity\Cliente;
use Application\ValueObject\FiltroCliente;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;

class ClienteService extends AbstractService
{

    public function __construct(ObjectManager $objectManager, ObjectRepository $repository)
    {
        parent::__construct($objectManager, $repository);
    }

    public function obterCliente($id)
    {
        $cliente = $this->repository->find($id);

        return $cliente;
    }

    public function buscaClientes(FiltroCliente $filtro)
    {
        $clientes = $this->repository->pesquisar($filtro);

        return $clientes;
    }

    public function salvar(Cliente $cliente)
    {

        try {

            $this->begin();

            $arquivo = $cliente->getFotoFile();

            if (!empty($arquivo) && !empty($arquivo['name']) && !empty($arquivo['tmp_name']) && !empty($arquivo['size'])) {
                $cliente->setFoto($arquivo['tmp_name']);
            }

            $this->objectManager->persist($cliente);

            $this->commit();

            return $cliente;

        } catch (\Exception $e) {
            throw $e;
        }

    }

    public function remover($id)
    {
        $cliente = $this->find($id);

        if($cliente instanceof Cliente){
            $this->repository->remove($cliente);
        }

        return true;
    }

}