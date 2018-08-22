<?php

namespace Application\Controller;

use Application\Service\FeedService;
use Eventviva\ImageResize;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * HomeController
 * 
 * @author Marcelo C. de Souza <marcelocs81@gmail.com>
 * @version 1.0
 */
class HomeController extends AbstractActionController
{

	
    public function indexAction()
    {

        $imgFile = $this->params()->fromQuery('img', null);

        if(! empty($imgFile)) {

            $image = new ImageResize($imgFile);
            $image->output(IMAGETYPE_JPEG, 50);

            return ;
        }
     	return new ViewModel( array(

        ));
    }
    
  
}