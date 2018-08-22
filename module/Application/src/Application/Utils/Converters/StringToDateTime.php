<?php
/**
 * @author Marcelo C. de Souza <marcelocs81@gmail.com>
 */ 

namespace Application\Utils\Converters;



use Application\PickList\LocalePicklist;

class StringToDateTime
{
    public static function convert(
        $value,
        $currentLocale
    ) {
        if ($value === null) {
            return null;
        }

        if ($currentLocale == LocalePicklist::PT_BR) {
            return \DateTime::createFromFormat('d/m/Y', $value);
        }

        return \DateTime::createFromFormat('m/d/Y', $value);
    }

    public static function convertFromCurrentLocale($value)
    {
        return self::convert($value, \Locale::getDefault());
    }

    /**
     * Converte a string no formado AAAA-MM-DD em DateTime
     * @param $value
     * @return \DateTime|null
     */
    public static function convertFromIso($value)
    {
        if(empty($value) || ! is_string($value)){
            return null;
        }
        return new \DateTime($value);
    }

    /**
     * @param $value : 00Z05JUN2016
     * @return \DateTime|null
     *
     */
    public static function convertFromSigmet($value)
    {

        if(empty($value) || ! is_string($value) || strlen($value) != 12){
            return null;
        }

        $dataTxt = strtolower(substr($value, 3));
        $date = \DateTime::createFromFormat('dMY', $dataTxt);
        $date->setTime(0, 0, 0);

        return $date;
    }

}
