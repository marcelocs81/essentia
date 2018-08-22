<?php
/**
 * @author Marcelo C. de Souza <marcelo.souza@toolsystems.com.br>
 */

namespace Application\Controller;

use Application\Enum\FlashMessages;
use Application\Model\Exception\BusinessRuleException;
use Zend\Form\FormInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

abstract class AbstractController extends AbstractActionController
{

    const TIPO_RETORNO_JSON = 'json';
    const TIPO_RETORNO_REQUEST = 'request';


    protected function trataErroExceptionAll($erro, $tipoRetorno = self::TIPO_RETORNO_REQUEST, $txtError = null)
    {
        $msgErros = [];

        if (is_string($erro)) {
            $msgErros[] = $erro;
        } elseif ($erro instanceof BusinessRuleException) {
            $msgErros[] = $erro->getMessage();
            if (!$erro->getExceptions()->isEmpty()) {
                /** @var BusinessRuleException $ex */
                foreach ($erro->getExceptions() as $ex) {
                    $msgErros[] = $ex->getMessage();
                }
            }
        } elseif ($erro instanceof \Exception) {
            if (empty($txtError)) {
                $msgErros[] = FlashMessages::ERRO_INESPERADO;
            } else {
                $msgErros[] = $txtError;
            }
            if (ENV_DEBUG) {
                $msgErros[] = $erro->getMessage();
                $msgErros[] = '<pre>' . str_replace('#', "\r\n#", $erro->getTraceAsString()) . '</pre>';
            }
        } else {
            $msgErros[] = FlashMessages::ERRO_INESPERADO;
        }

        $msgErrorLog = '';
        if (is_string($erro)) {
            $msgErrorLog = $erro;
            if (ENV_DEBUG) {
                $msgErrorLog .= ' >> EX: ' . $erro->getMessage();
            }
        }else{
            $msgErrorLog = $erro->getMessage();
        }
        error_log($msgErrorLog);

        if ($tipoRetorno == self::TIPO_RETORNO_REQUEST) {
            foreach ($msgErros as $msg) {
                $this->flashMessenger()->addErrorMessage($msg);
                error_log($msg);
            }
        }

        return $msgErros;

    }

    protected function trataErroException($erro, $msgError = null)
    {
        return $this->trataErroExceptionAll($erro, self::TIPO_RETORNO_REQUEST, $msgError);
    }

    protected function trataErroExceptionReturnJsonModel($erro, $msgError = null)
    {
        return $this->trataErroExceptionJson($erro, true, $msgError);
    }

    protected function trataErroExceptionJson($erro, $returnJsonModel = false, $msgError = null)
    {
        $erros = $this->trataErroExceptionAll($erro, self::TIPO_RETORNO_JSON, $msgError);

        if ($returnJsonModel) {
            if (!empty($erros)) {
                $this->getResponse()->setStatusCode(400);

                return new JsonModel(
                    ['error-message' => $erros]
                );
            }
        } else {
            return $erros;
        }
    }

    protected function trataFalhaValidacaoForm(FormInterface $form)
    {

        $this->flashMessenger()->addErrorMessage(FlashMessages::ERRO_VALIDACAO_FORMULARIO);

        if (ENV_DEBUG) {
            $this->flashMessenger()->addErrorMessage("<pre>" . print_r($form->getMessages(), true) . "</pre>");
            $this->flashMessenger()->addErrorMessage("<pre>" . print_r($form->getInputFilter()->getMessages(), true) . "</pre>");
        }

    }

    protected function desabilitaCampoFormulario($inputFilter, $fieldSet, $camposElemento)
    {
        foreach ($camposElemento as $campo) {
            $fieldSet->get($campo)->setAttributes(
                [
                    'disabled' => true,
                    'readonly' => true,
                    'class'    => $fieldSet->get($campo)->getAttribute('class') . ' disabled'
                ]
            );
            $inputFilter->get($campo)->setRequired(false);
        }
    }

    protected function habilitaCampoFormulario($fieldSet, $camposElemento)
    {
        foreach ($camposElemento as $campo) {

            $class = $fieldSet->get($campo)->getAttribute('class');
            $class = str_ireplace('disabled', '', $class);
            $class = str_ireplace('readonly', '', $class);

            $fieldSet->get($campo)->setAttributes(
                [
                    'disabled' => false,
                    'readonly' => false,
                    'class'    => $class
                ]
            );
        }
    }

    protected function bloqueiaCampoFormulario($fieldSet, $camposElemento)
    {
        foreach ($camposElemento as $campo) {
            $fieldSet->get($campo)->setAttributes(
                [
                    'readonly' => true,
                    'class'    => $fieldSet->get($campo)->getAttribute('class') . ' readonly disabled'
                ]
            );
        }
    }

} 