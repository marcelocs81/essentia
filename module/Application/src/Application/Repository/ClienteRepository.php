<?php
/**
 * Created by Marcelo
 */

namespace Application\Repository;


use Application\Entity\Cliente;
use Application\ValueObject\FiltroCliente;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class ClienteRepository extends CommonRepository
{
    public function pesquisar(FiltroCliente $filtro)
    {
        $query = $this->createQueryBuilder('c')
            ->select(['c']);

        if (null !== $filtro->getRegiao()) {
            $query->andWhere('c.regiao = :regiao');
            $query->setParameter('regiao', $filtro->getRegiao());
        }

        if (null !== $filtro->getAtivo()) {
            $query->andWhere('c.ativo = :ativo');
            $query->setParameter('ativo', $filtro->getAtivo());
        }

        if (!empty($filtro->getNome())) {
            $query->andWhere('c.nome like :nome');
            $query->setParameter('nome', '%' . $filtro->getNome() . '%');
        }

        if (!empty($filtro->getEmail())) {
            $query->andWhere('c.email like :email');
            $query->setParameter('email', '%' . $filtro->getEmail() . '%');
        }

        $query->addOrderBy('c.nome', 'ASC');

        return $query->getQuery()->getResult();
    }

}