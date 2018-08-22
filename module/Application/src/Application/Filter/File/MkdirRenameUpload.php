<?php

/**
 * @author Marcelo C. de Souza <marcelocs81@gmail.com>
 */

namespace Application\Filter\File;

use Zend\Filter\File\RenameUpload;
use Zend\Filter\Exception\RuntimeException;

class MkdirRenameUpload extends RenameUpload
{

    /**
     * @param  array $uploadData $_FILES array
     * @return string
     */
    protected function getFinalTarget($uploadData)
    {

        var_dump(is_dir($this->getTarget()));
        var_dump($this->getTarget());
        var_dump($uploadData);
     //   die;

        if (!is_dir($this->getTarget())) {
            if (!mkdir($this->getTarget(), 0755, true)) {
                throw new RuntimeException(
                    sprintf("Não foi possivel criar o diretorio '%s' para upload do arquivo.", $this->getTarget())
                );
            }
        }

        return parent::getFinalTarget($uploadData);
    }

}