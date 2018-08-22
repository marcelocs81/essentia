<?php
namespace Application\Service;

use Application\Entity\Usuario;
use Application\Interfaces\ObjectEntity;
use Doctrine\Common\Persistence\ObjectManager;
use Exception;

/**
 * Class AbstractService
 *
 */
abstract class AbstractServiceOM
{


    /**
     * @var ObjectManager
     */
    protected $objectManager;


    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * Retorna a referência da tabela do Doctrine Proxy
     *
     * @method getReference($entityClass, $id)
     * @param string $entityClass
     * @param int $id
     *
     * @access public
     * @author Marcelo C. de Souza <marcelocs81@gmail.com>
     */
    public function getReference($entityClass, $id)
    {
        return $this->objectManager->getReference($entityClass, $id);
    }

    /**
     * @param ObjectEntity $entity
     * @throws Exception
     * @author Marcelo C. de Souza <marcelocs81@gmail.com>
     *
     * @deprecated O service não deve conhecer o banco de dados. Essa função foi é de responsabilidade
     * do repository.
     * Este método foi reescrito na classe Application\Repository\CommonRepository
     */
    public function save(ObjectEntity $entity)
    {
        try {

            if (null === $entity->getId()) {
                $this->objectManager->persist($entity);
            }

            $this->objectManager->flush();

            return $entity;

        } catch (\Exception $e) {
            throw $e;
        }

    }

    /**
     * @param ObjectEntity $entity
     * @throws Exception
     * @author Marcelo C. de Souza <marcelocs81@gmail.com>
     *
     * @deprecated O service não deve conhecer o banco de dados. Essa função foi é de responsabilidade
     * do repository.
     * Este método foi reescrito na classe Application\Repository\CommonRepository
     */
    public function delete(ObjectEntity $entity)
    {
        try {
            $this->objectManager->remove($entity);
            $this->objectManager->flush();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function forceDelete(ObjectEntity $entidade = null)
    {
        if ($entidade === null) {
            return;
        }

        $meta = $this->objectManager->getClassMetadata(get_class($entidade));
        $conn = $this->objectManager->getConnection();
        $conn->delete($meta->table['name'], $meta->getIdentifierValues($entidade));
    }

    /**
     * Retorna a Entity selecionada atraves do idExterno
     *
     * @method findOneEntityByIdExterno($entity, $idExterno)
     * @return type:
     *
     * @access public
     * @author Marcelo C. de Souza <marcelo.souza@toolsystems.com.br>
     */
    public function findOneEntityByIdExterno($entity, $idExterno)
    {
        return $this->findOneEntityBy($entity, array('idExterno' => $idExterno));
    }

    /**
     * Retorna a Entity selecionada atraves dos parametros de busca
     *
     * @method findOneEntityBy($entity, array $criteria)
     * @return type:
     *
     * @access public
     * @author Marcelo C. de Souza <marcelo.souza@toolsystems.com.br>
     */
    public function findOneEntityBy($entity, array $criteria)
    {
        return $this->objectManager->getRepository($entity)->findOneBy($criteria);
    }

    /**
     * Retorna a Entity selecionada atraves do ID
     *
     * @method findOneEntityBy($entity, $id)
     * @return type:
     *
     * @access public
     * @author Marcelo C. de Souza <marcelo.souza@toolsystems.com.br>
     */
    public function findEntity($entity, $id)
    {
        return $this->objectManager->getRepository($entity)->find($id);
    }

    /**
     * Retorna a Entity selecionada atraves dos parametros de busca
     *
     * @method findOneEntityBy($entity, array $criteria)
     * @return type:
     *
     * @access public
     * @author Marcelo C. de Souza <marcelo.souza@toolsystems.com.br>
     */
    public function findEntityBy($entity, array $criteria)
    {
        return $this->objectManager->getRepository($entity)->findBy($criteria);
    }

    public function begin()
    {
        $this->objectManager->beginTransaction();
    }

    public function commit()
    {
        $this->objectManager->flush();
        $this->objectManager->commit();
    }

    public function rollback()
    {
        $this->objectManager->rollback();
    }

}
