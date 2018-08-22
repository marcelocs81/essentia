<?php

namespace Application\Form\Element;

use DoctrineModule\Form\Element\Proxy as DoctrineProxy;
use RuntimeException;

class Proxy extends DoctrineProxy
{
    protected $valueProperty;

    public function setOptions($options)
    {
        if (isset($options['value_property'])) {
            $this->setValueProperty($options['value_property']);
        }

        parent::setOptions($options);
    }

    /**
     * @return mixed
     */
    public function getValueProperty()
    {
        return $this->valueProperty;
    }

    /**
     * @param mixed $valueProperty
     */
    public function setValueProperty($valueProperty)
    {
        $this->valueProperty = $valueProperty;
    }

    protected function loadValueOptions()
    {

        if (!($om = $this->objectManager)) {
            throw new RuntimeException('No object manager was set');
        }

        if (!($targetClass = $this->targetClass)) {
            throw new RuntimeException('No target class was set');
        }


        $metadata = $om->getClassMetadata($targetClass);
        $identifier = $metadata->getIdentifierFieldNames();
        $objects = $this->getObjects();
        $options = array();

        if ($this->displayEmptyItem || empty($objects)) {
            $options[''] = $this->getEmptyItemLabel();
        }

        if (!empty($objects)) {
            foreach ($objects as $key => $object) {
                if (null !== ($generatedLabel = $this->generateLabel($object))) {
                    $label = $generatedLabel;
                } elseif ($property = $this->property) {
                    if ($this->isMethod == false && !$metadata->hasField($property)) {
                        throw new RuntimeException(
                            sprintf(
                                'Property "%s" could not be found in object "%s"',
                                $property,
                                $targetClass
                            )
                        );
                    }

                    $getter = 'get' . ucfirst($property);
                    if (!is_callable(array($object, $getter))) {
                        throw new RuntimeException(
                            sprintf('Method "%s::%s" is not callable', $this->targetClass, $getter)
                        );
                    }

                    $label = $object->{$getter}();
                } else {
                    if (!is_callable(array($object, '__toString'))) {
                        throw new RuntimeException(
                            sprintf(
                                '%s must have a "__toString()" method defined if you have not set a property'
                                . ' or method to use.',
                                $targetClass
                            )
                        );
                    }

                    $label = (string)$object;
                }

                if (null !== $this->getValueProperty()) {
                    $value = $metadata->getFieldValue($object, $this->getValueProperty());
                } else {
                    if (count($identifier) > 1) {
                        $value = $key;
                    } else {
                        $value = current($metadata->getIdentifierValues($object));
                    }
                }

                $options[] = array('label' => $label, 'value' => $value);
            }
        }

        $this->valueOptions = $options;
    }
}
