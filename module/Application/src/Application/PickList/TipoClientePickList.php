<?php

namespace Application\PickList;

use Application\ValueObject\MapaPrevisaoPrecipitacao;
use Application\ValueObject\MapaPrevisaoTempo;
use Application\ValueObject\MapaPrevisaoTMax;
use Application\ValueObject\MapaPrevisaoTMin;
use Application\ValueObject\MapaPrevisaoUmidade;
use Application\ValueObject\MapaPrevisaoVento;

class TipoClientePickList extends AbstractPickList
{
    const PESSOA_FISICA = 'FISICA';
    const PESSOA_JURIDICA = 'JURIDICA';


    protected static $data = array(
        self::PESSOA_FISICA   => 'Pessoa Fisica',
        self::PESSOA_JURIDICA => 'Pessoa Juridica',
    );
}