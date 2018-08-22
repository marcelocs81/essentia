<?php

/**
 * Created by
 * User: Marcelo Cardoso de Souza
 *
 */

namespace Application\Controller;

use Application\Controller\AbstractController;
use Application\Enum\FlashMessages;
use Application\Http\ImageResponse;
use Doctrine\Common\Collections\ArrayCollection;
use Eventviva\ImageResize;
use Zend\Form\FormInterface;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;
use Zend\View\Model\ViewModel;

class ImagemController extends AbstractController
{

    public function indexAction()
    {

        try {
            $path64 = $this->params()->fromRoute('path', null);
            $width = $this->params()->fromRoute('width', null);

            if ($this->obterImagem($path64, $width)) {
                return;
            }

        } catch (\Exception $e) {
            $this->trataErroException($e);
        }

        return $this->redirect()->toRoute('cliente');
    }

    public function miniAction()
    {

        try {
            $path64 = $this->params()->fromRoute('path', null);
            $width = $this->params()->fromRoute('width', 75);

            if ($this->obterImagem($path64, $width)) {
                return;
            }

        } catch (\Exception $e) {
            $this->trataErroException($e);
        }

        return $this->redirect()->toRoute('cliente');
    }

    private function obterImagem($path64, $width)
    {
        if (!empty($path64)) {

            $imgFile = base64_decode($path64);

            $image = new ImageResize($imgFile);
            if ($width) {
                $image->resizeToWidth($width);
            }
            $image->output();

            return TRUE;
        }

        return FALSE;
    }

}