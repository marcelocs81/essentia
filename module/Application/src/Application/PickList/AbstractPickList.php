<?php

namespace Application\PickList;

abstract class AbstractPickList
{

    protected static $data;

    private $value;

    function __construct($value = null)
    {
        $this->value = $value;
    }


    public static function exists($offset, $caseSensitive = true)
    {
        if(is_null($offset)){
            return false;
        }
        if($caseSensitive){
            return array_key_exists($offset, static::$data);
        }else{
            return array_key_exists($offset, array_change_key_case(static::$data, CASE_UPPER));
        }

    }

    public static function get($offset, $caseSensitive = true)
    {
        if(is_null($offset) || !self::exists($offset, $caseSensitive)){
            return null;
        }
        return static::$data[$offset];
    }

    public static function set($offset, $value)
    {
        if (is_null($offset)) {
            static::$data[] = $value;
        } else {
            static::$data[$offset] = $value;
        }
    }

    public static function getArray()
    {
        return static::$data;
    }

    public static function getArrayByValues($values)
    {
        $data = [];

        foreach ($values as $value) {
            $descricao = self::get($value);
            if(null !== $descricao) {
                $data[$value] = $descricao;
            }
        }

        return $data;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string Retornar o label do pickList
     */
    public function getLabel()
    {
        return static::get($this->getValue());
    }


}