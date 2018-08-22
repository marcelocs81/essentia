<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Http\Headers;
use Zend\Http\Response\Stream;
/**
 * DownloadController
 *
 * @author
 *
 * @version
 *
 */
class DownloadController extends AbstractActionController
{
    protected $cadastroDocTable;
    /**
     * The default action - show the home page
     */
    public function indexAction()
    {
        
        $id = (int) $this->params()->fromRoute('op1', 0);
        //$arquivo    = $this->params()->fromRoute('op2', null);
        $docs = $this->getCadastroDocTable()->get($id);
        if($docs->id>0){
    
            $pasta = $this->getCadastroDocTable()->caminho($docs->cadastroId);
        
            $file = $pasta.'/'.$docs->arquivo;
        
            $response = new Stream();
            $response->setStream(fopen($file, 'r'));
            $response->setStatusCode(200);
            $response->setStreamName(basename($file));
        
            $headers = new Headers();
            $headers->addHeaders(array(
                'Content-Disposition' => 'attachment; filename="' . basename($file) .'"',
                'Content-Type' => $docs->tipo,//'application/octet-stream',
                'Content-Length' => filesize($file)
            ));
            $response->setHeaders($headers);
            
            return $response;
        }else{
            return $this->redirect()->toRoute('home');
        }
        
    }
    
    public function getCadastroDocTable()
    {
        if (!$this->cadastroDocTable) {
            $sm = $this->getServiceLocator();
            $this->cadastroDocTable = $sm->get('Atendimento\Model\CadastroDocTable');
        }
        return $this->cadastroDocTable;
    }
}