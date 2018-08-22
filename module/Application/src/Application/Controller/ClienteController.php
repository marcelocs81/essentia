<?php

/**
 * Created by
 * User: Marcelo Cardoso de Souza
 *
 */

namespace Application\Controller;

use Application\Entity\Cliente;
use Application\Enum\FlashMessages;
use Application\Form\Cliente\InputFilter\ClienteInputFilter;
use Application\Service\ClienteService;
use Application\ValueObject\FiltroCliente;
use Zend\Form\FormInterface;
use Zend\View\Model\ViewModel;

class ClienteController extends AbstractController
{

    /**
     * @var FormInterface
     */
    private $filtroForm;

    /**
     * @var FormInterface
     */
    private $clienteForm;

    /**
     * @var ClienteService
     */
    private $clienteService;

    /**
     * ClienteController constructor.
     * @param FormInterface $filtroForm
     * @param FormInterface $clienteForm
     * @param ClienteService $clienteService
     */
    public function __construct(FormInterface $filtroForm, FormInterface $clienteForm, ClienteService $clienteService)
    {
        $this->filtroForm = $filtroForm;
        $this->clienteForm = $clienteForm;
        $this->clienteService = $clienteService;
    }

    public function indexAction()
    {

        $conf['titulo'] = "Lista de Clientes";
        $conf['texto'] = "Lista de Clientes cadastrados no sistema";

        try {

            $params = $this->params()->fromQuery();
            $search = $this->params()->fromQuery('filtro');

            $filtro = new FiltroCliente();

            if ($search == null) {

                $clientes = $this->clienteService->buscaClientes($filtro);

                return new ViewModel(
                    array(
                        'conf' => $conf,
                        'clientes' => $clientes,
                        'form' => $this->filtroForm,
                    )
                );
            }


            $this->filtroForm->bind($filtro);

            $this->filtroForm->setData($params);

            if (!$this->filtroForm->isValid()) {

                $this->trataFalhaValidacaoForm($this->filtroForm);

                return new ViewModel(
                    array(
                        'conf' => $conf,
                        'clientes' => null,
                        'form' => $this->filtroForm,
                    )
                );
            }

            if (array_key_exists('ativo', $search)) {
                if ($search['ativo'] == '1') {
                    $filtro->setAtivo(TRUE);
                } else if ($search['ativo'] == '0') {
                    $filtro->setAtivo(FALSE);
                } else {
                    $filtro->setAtivo(NULL);
                }
            }

            $clientes = $this->clienteService->buscaClientes($filtro);

            return new ViewModel(
                array(
                    'conf' => $conf,
                    'clientes' => $clientes,
                    'form' => $this->filtroForm,
                )
            );

        } catch (\Exception $e) {
            $this->trataErroException($e);
        }

        return new ViewModel(
            array(
                'conf' => $conf,
                'clientes' => null,
                'form' => $this->filtroForm,
            )
        );
    }


    public function editarAction()
    {

        $id = (int)$this->params()->fromRoute('identificador', 0);

        $conf['titulo'] = "Cadastrar Novo Cliente";
        $conf['texto'] = "Insira as informações do novo cliente, os campos marcados com * são obrigatórios";

        $cliente = new Cliente();
        try {
            if ($id > 0) {
                $conf['titulo'] = "Atualizar Cadastro do Cliente";
                $conf['texto'] = "Atualize as informações do cliente, os campos marcados com * são obrigatórios";
                $cliente = $this->clienteService->find($id);
            }

            $this->clienteForm->bind($cliente);

            $request = $this->getRequest();

            if ($request->isPost()) {

                $post = $request->getPost();
                $post->set(
                    'cliente',
                    array_merge_recursive(
                        $request->getPost()->get('cliente'),
                        $request->getFiles()->get('cliente')
                    )
                );

                $this->clienteForm->setData($post);

                if ($cliente->possuiFoto()) {
                    /** @var ClienteInputFilter $inputFilter */
                    $inputFilter = $this->clienteForm->getInputFilter()->get('cliente');
                    $inputFilter->get('fotoFile')->setRequired(false);
                }

                if ($this->clienteForm->isValid()) {

                    $this->clienteService->salvar($cliente);

                    $this->flashMessenger()->addSuccessMessage(FlashMessages::SUCESSO_PADRAO_SALVAR);

                    return $this->redirect()->toRoute('cliente');

                } else {
                    $this->trataFalhaValidacaoForm($this->clienteForm);
                }
            }
        } catch (\Exception $e) {
            $this->trataErroException($e);
        }

        return new ViewModel(
            [
                'conf' => $conf,
                'cliente' => $cliente,
                'form' => $this->clienteForm
            ]
        );
    }

    public function excluirAction()
    {
        $id = (int)$this->params()->fromRoute('identificador', null);

        if (empty($id)) {
            return $this->redirect()->toRoute('cliente');
        }

        try {

            $this->clienteService->remover($id);
            $this->flashMessenger()->addSuccessMessage(FlashMessages::SUCESSO_PADRAO_REMOVER);

            return $this->redirect()->toRoute('cliente');

        } catch (\Exception $e) {
            $this->trataErroException($e);
            return $this->redirect()->toRoute('cliente');
        }
    }

}