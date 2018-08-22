<?php
namespace Application\Repository;

use Application\Entity\Conta;
use Application\Interfaces\ObjectEntity;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadataInfo;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * Class CommonRepository
 * Provê métodos dos repository's padrões
 * Ex: método de busca
 * @author Marcelo C. de Souza <marcelocs81@gmail.com>
 *
 */
class CommonRepository extends EntityRepository
{

    /**
     * Retorna a listagem dos dados baseado nos parâmetros e campos passados
     * @method searchBy()
     * @param string $param
     * @param array $fields
     * @return QueryBuilder
     */
    public function searchBy($param, array $fields)
    {
        $tableName    = $this->getTableName();
        $queryBuilder = $this->createQueryBuilder($tableName);

        foreach ($fields as $field) {
            $queryBuilder->orWhere("{$tableName}.{$field} LIKE '%{$param}%'");
        }

        return $queryBuilder;
    }


    /**
     * Retorna o nome da tabela em que a consulta será realizada
     * @return string
     */
    protected function getTableName()
    {
        return $this->getClassMetadata()->table['name'];
    }

    /**
     *
     * Bloqueia o registro até que seja atualizado ou ocorra rollback
     *
     * @param int $id
     * @return array
     */
    public function bloqueiaRegistroById($id)
    {

        $nomeTabela = $this->getTableName();
        $sql        = " SELECT * FROM {$nomeTabela} WHERE ID = :id FOR UPDATE ";

        $rsm = new ResultSetMapping();

        $rsm->addScalarResult('ID', 'id');

        $query = $this->getEntityManager()->createNativeQuery($sql, $rsm);

        $parametros['id'] = $id;

        $query->setParameters($parametros);

        $retorno = $query->getArrayResult();
        if (count($retorno) > 0) {
            return true;
        }

        return false;

    }

    public function forceDelete($entidade)
    {
        $conn = $this->getEntityManager()->getConnection();
        $conn->delete($this->getTableName(), $this->getClassMetadata()->getIdentifierValues($entidade));
    }

    /**
     * @param ObjectEntity $entity
     * @throws \Exception
     * @return ObjectEntity
     */
    public function save(ObjectEntity $entity)
    {
        try {
            $this->getEntityManager()->persist($entity);
            $this->getEntityManager()->flush();

            return $entity;

        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param ObjectEntity $entity
     * @throws \Exception
     */
    public function remove(ObjectEntity $entity)
    {
        try {
            $this->getEntityManager()->remove($entity);
            $this->getEntityManager()->flush();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function truncate()
    {
        $connection = $this->getEntityManager()->getConnection();
        $platform   = $connection->getDatabasePlatform();

        $connection->executeQuery('SET FOREIGN_KEY_CHECKS = 0;');
        $truncateSql = $platform->getTruncateTableSQL($this->getTableName());
        $connection->executeUpdate($truncateSql);
        $connection->executeQuery('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
