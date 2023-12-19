<?php

namespace Classes\Util;

abstract class ConstantesGenericasUtil
{
  /* REQUESTS */
  public const TIPO_REQUEST = ['GET', 'POST', 'DELETE', 'PUT'];
  public const TIPO_GET = ['CONTATOS'];
  public const TIPO_POST = ['CONTATOS'];
  public const TIPO_DELETE = ['CONTATOS'];
  public const TIPO_PUT = ['CONTATOS'];

  /* ERROS */
  public const MSG_ERRO_TIPO_ROTA = 'Rota não permitida!';
  public const MSG_ERRO_RECURSO_INEXISTENTE = 'Recurso inexistente!';
  public const MSG_ERRO_GENERICO = 'Algum erro ocorreu na requisição!';
  public const MSG_ERRO_SEM_RETORNO = 'Nenhum contato encontrado!';
  public const MSG_ERRO_NAO_AFETADO = 'Nenhum contato afetado!';
  public const MSG_ERRO_JSON_VAZIO = 'O corpo da requisição não pode ser vazio!';
  public const MSG_ERRO_CORPO_INVALIDO = 'O corpo da requisição está incorreto, verifique erro de sintaxe!';

  /* SUCESSO */
  public const MSG_DELETADO_SUCESSO = 'Contato deletado com Sucesso!';
  public const MSG_ATUALIZADO_SUCESSO = 'Contato atualizado com Sucesso!';

  /* RECURSO USUARIOS */
  public const MSG_ERRO_ID_OBRIGATORIO = 'ID é obrigatório!';

  /* RETORNO JSON */
  const TIPO_SUCESSO = 'sucesso';
  const TIPO_ERRO = 'erro';

  /* OUTRAS */
  public const TIPO = 'tipo';
  public const RESPOSTA = 'resposta';
}
