<?php
/**
 * @author Marcelo C. de Souza <marcelocs81@gmail.com>
 */

namespace Application\PickList;

class LocalePicklist extends AbstractPickList
{

    const TEXT_DOMAIN = 'default';

    const EN_US = 'en_US';
    const PT_BR = 'pt_BR';
    const PHP = 'php';
    const _DEFAULT = 'pt_BR';

    protected static $data = [
        self::EN_US => self::EN_US,
        self::PT_BR => self::PT_BR,
    ];

    public static function getArrayDescricaoIdiomas()
    {
        return [
            self::EN_US => 'Inglês',
            self::PT_BR => 'Português',
        ];
    }

}
