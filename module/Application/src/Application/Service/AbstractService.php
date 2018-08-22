<?php
namespace Application\Service;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Exception;
use Application\Interfaces\ObjectEntity;
use Zend\Validator\Translator\TranslatorInterface;

/**
 * Class AbstractService
 * @author Marcelo C. de Souza <marcelocs81@gmail.com>
 *
 */
abstract class AbstractService extends AbstractServiceOM implements ObjectRepository
{

    /**
     *
     * @var ObjectRepository
     */
    protected $repository;


    public function __construct(ObjectManager $objectManager, ObjectRepository $objectRepository)
    {
        parent::__construct($objectManager);
        $this->repository = $objectRepository;
    }


    /**
     * Retorna registros a serem iteradas
     *
     * @method findAll()
     * @return multitype:
     *
     * @access public
     * @see \Doctrine\Common\Persistence\ObjectRepository::findAll()
     * @author Marcelo C. de Souza <marcelocs81@gmail.com>
     */
    public function findAll()
    {
        return $this->repository->findAll();
    }

    /**
     * Retorna um registro baseado no ID
     *
     * @method find()
     * @return multitype:
     *
     * @access public
     * @see \Doctrine\Common\Persistence\ObjectRepository::find()
     * @author Marcelo C. de Souza <marcelocs81@gmail.com>
     */
    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function forceFind($id){
        $this->objectManager->getFilters()->disable('soft_delete');
        $object = $this->repository->find($id);
      //  $this->objectManager->getFilters()->enable('soft_delete');
        return $object;
    }

    /**
     * Retorna registros baseado no array de critérios
     *
     * @method findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
     * @return multitype:
     *
     * @access public
     * @see \Doctrine\Common\Persistence\ObjectRepository::findBy()
     * @author Marcelo C. de Souza <marcelocs81@gmail.com>
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->repository->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * Retorna um registro baseado no array de critérios
     *
     * @method findOneBy(array $criteria)
     * @return multitype:
     *
     * @access public
     * @see \Doctrine\Common\Persistence\ObjectRepository::findOneBy()
     * @author Marcelo C. de Souza <marcelocs81@gmail.com>
     */
    public function findOneBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    /**
     * Retorna o nome da class em formato de string.
     *
     * @method getClassName()
     * @return string
     *
     * @access public
     * (non-PHPdoc)
     * @see \Doctrine\Common\Persistence\ObjectRepository::getClassName()
     * @author Marcelo C. de Souza <marcelocs81@gmail.com>
     */
    public function getClassName()
    {
        return $this->repository->getClassName();
    }

}