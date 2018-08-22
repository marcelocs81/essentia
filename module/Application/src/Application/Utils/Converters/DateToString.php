<?php
/**
 * @author Marcelo C. de Souza <marcelocs81@gmail.com>
 */

namespace Application\Utils\Converters;

use Application\PickList\LocalePicklist;

class DateToString
{
    public static function convert(
        $date,
        $locale,
        $withTime = false
    ) {
        if ($date === null) {
            return null;
        }

        if (!$date instanceof \DateTime) {
            throw new \Exception(
                sprintf(
                    'O valor %s não é um DateTime',
                    $date
                )
            );
        }

        $format = 'm/d/Y';
        if ($locale == LocalePicklist::PT_BR) {
            $format = 'd/m/Y';
        }

        if (true === $withTime) {
            $format .= ' H:i:s';
        }

        return $date->format($format);
    }

    public static function convertComMesTextoCurto(
        $date,
        $locale,
        $translator,
        $withTime = false
    ) {

        $mesAbreviado = [
            'Jan' => 'Jan',
            'Feb' => 'Fev',
            'Mar' => 'Mar',
            'Apr' => 'Abr',
            'May' => 'Mai',
            'Jun' => 'Jun',
            'Jul' => 'Jul',
            'Aug' => 'Ago',
            'Sep' => 'Set',
            'Oct' => 'Out',
            'Nov' => 'Nov',
            'Dec' => 'Dez',
        ];

        if ($date === null) {
            return null;
        }

        if (!$date instanceof \DateTime) {
            throw new \Exception(
                sprintf(
                    'O valor %s não é um DateTime',
                    $date
                )
            );
        }

        $format = '#/d/Y';
        if ($locale == LocalePicklist::PT_BR) {
            $format = 'd/#/Y';
        }

        if (true === $withTime) {
            $format .= ' H:i:s';
        }

        $dataText = $date->format($format);
        $dataText = str_replace('#', $translator->translate($mesAbreviado[$date->format('M')], LocalePicklist::TEXT_DOMAIN, $locale), $dataText);

        return $dataText;
    }

    public static function convertFromCurrentLocale($date)
    {
        return self::convert($date, \Locale::getDefault());
    }

    public static function convertFromCurrentLocaleWithTime($date)
    {
        return self::convert($date, \Locale::getDefault(), true);
    }


    public static function currentDateCurrentLocale()
    {
        return self::convert(new \DateTime(), \Locale::getDefault());
    }
}
