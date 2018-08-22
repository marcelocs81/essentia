<?php
namespace Application\Enum;

abstract class FlashMessages
{
    const ERRO_INESPERADO             = 'Houve uma instabilidade no sistema, desculpe o transtorno. Por favor, tente novamente, caso o erro persista entre em contato com o suporte.';
    const ERRO_PADRAO_SALVAR          = 'Houve um erro ao tentar salvar as informações enviadas, por favor, tente novamente.';
    const ERRO_PADRAO_REMOVER         = 'Houve um erro ao tentar excluir o registro, por favor, tente novamente.';
    const ERRO_PADRAO_REMOVER_ARQUIVO = 'Houve um erro ao tentar excluir o registro devido ao arquivo associado, por favor, tente novamente.';
    const ERRO_PADRAO_DOWNLOAD        = 'Houve um erro ao tentar fazer o download do arquivo, por favor, tente novamente.';
    const ERRO_PADRAO_LOGIN           = 'Houve um erro ao tentar fazer o login, por favor, tente novamente.';
    const ERRO_PADRAO_LOGOUT          = 'Houve um erro ao tentar fazer o logout, por favor, tente novamente.';
    const ERRO_PADRAO_RECUPERAR_SENHA = 'Houve um erro ao tentar recuperar a senha, por favor, tente novamente.';
    const ERRO_PADRAO_LISTAR          = 'Houve um erro ao tentar listar os dados, por favor, tente novamente.';
    const ERRO_PADRAO_VISUALIZAR      = 'Houve um erro ao tentar visualizar os dados, por favor, tente novamente.';
    const ERRO_PADRAO_TIMEOUT         = 'Oops, infelizmente não conseguimos conectar nossos servidores para enviar sua requisição, por favor, tente novamente.';
    const ERRO_RECUPERAR_DADOS        = 'Não foi possível recuperar os dados, por favor, tente novamente.';
    const ERRO_ENVIAR_FORMULARIO      = 'Houve um erro ao tentar enviar o formulário, por favor, tente novamente.';
    const ERRO_VALIDACAO_FORMULARIO   = 'Ocorreram problemas de validação no envio das informações, favor verificar o formulário e tente novamente.';
    const ERRO_VALIDACAO_FORM_ABAS    = 'Ocorreram problemas de validação no envio das informações, favor verificar a(s) aba(s) <b>%s</b>.';

    const SUCESSO_PADRAO_SALVAR  = 'Dados salvos com sucesso.';
    const SUCESSO_PADRAO_REMOVER = 'Dados excluídos com sucesso.';

    const MSG_RETORNO_SUCESSO             = 'ID do objeto referenciado: %s';
    const MSG_RETORNO_ERROR               = 'Falha na execução da operação: %s';
    const MSG_RETORNO_ERROR_NAO_PERSISTIR = 'A mensagem solicitada não salva dados.';

    const CAMPO_OBRIGATORIO = 'Campos Obrigatórios';
    const FLAG_ATIVO   = 'ATIVO';
    const FLAG_INATIVO = 'INATIVO';

}
