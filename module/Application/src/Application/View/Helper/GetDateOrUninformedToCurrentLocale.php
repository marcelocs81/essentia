<?php
/**
 * @author Marcelo C. de Souza <marcelocs81@gmail.com>
 */

namespace Application\View\Helper;

use Application\PickList\LocalePicklist;
use Application\Utils\Converters\DateToString;
use Zend\Validator\Translator\TranslatorInterface;
use Zend\View\Helper\AbstractHelper;

class GetDateOrUninformedToCurrentLocale extends AbstractHelper
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @param null|\DateTime $date
     * @return mixed
     */
    public function __invoke($date, $useInDataTable = true, $locale = null)
    {
        if ( ! $date instanceof \DateTime) {
            return null;
            //return $this->translator->translate('Não informado');
        }

        if(null == $locale){
            $locale = \Locale::getDefault();
        }

        $dataTxt = DateToString::convertComMesTextoCurto($date, $locale, $this->translator);

        if($useInDataTable){
            $dataTxt = "<!-- {$date->format('Ymd')}-->".$dataTxt;
        }

        return $dataTxt;
    }
}
