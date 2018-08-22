<?php

namespace Application\PickList;

class StatusPickList extends AbstractPickList
{
    const ATIVO = 1;
    const INATIVO = 0;
    const _DEFAULT = -1;


    protected static $data = array(
        self::ATIVO   => "Ativo",
        self::INATIVO => "Inativo",
    );
}