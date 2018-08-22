<?php

namespace Application\Entity;


use Zend\Stdlib\Hydrator\ClassMethods;

abstract class AbstractEntity
{

    /**
     * Retorna o objeto em forma de array
     * @return Ambigous <multitype:, multitype:Ambigous <\Zend\Stdlib\Hydrator\mixed, mixed, \Zend\Stdlib\Hydrator\Strategy\mixed> >
     *
     * @author Marcelo C. de Souza <marcelocs81@gmail.com>
     */
    public function toArray()
    {
        $class = new ClassMethods();

        return $class->extract($this);
    }

    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     *
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * @return Ambigous
     */
    public function exchangeArray()
    {
        return $this->toArray();
    }

} 