<?php

namespace Application\Form\Element;

use DoctrineModule\Form\Element\ObjectSelect as DoctrineObjectSelect;

class ObjectSelect extends DoctrineObjectSelect
{
    public function getProxy()
    {
        if (null === $this->proxy) {
            $this->proxy = new Proxy();
        }

        return $this->proxy;
    }

    public function getTextOptionValue()
    {

        $keyOptionValue = array_search($this->getValue(), $this->getValueOptionsValues());

        if (false === $keyOptionValue) {
            return null;
        }

        $options = $this->getValueOptions();
        if (array_key_exists($keyOptionValue, $options)) {
            $option = $options[$keyOptionValue];
            if (array_key_exists('label', $option)) {
                $valor = $option['label'];
                $codigo = $option['value'].' - ';
                if(strpos($valor, $codigo) === 0){
                    $valor = substr($valor, strlen($codigo));
                }

                return trim($valor);
            }
        }
        return null;
    }

}
