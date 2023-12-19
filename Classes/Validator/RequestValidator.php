<?php

namespace Classes\Validator;

use Classes\Service\ContatosService;
use Classes\Util\ConstantesGenericasUtil;
use Classes\Util\JsonUtil;
use InvalidArgumentException;

class RequestValidator
{
  const GET = 'GET';
  const DELETE = 'DELETE';

  const CONTATOS = 'CONTATOS';

  private $request;
  private $retorno;
  private $dadosRequest = [];

  public function __construct($request)
  {
    $this->request = $request;
  }

  public function processarRequest()
  {
    $this->retorno = mb_convert_encoding(ConstantesGenericasUtil::MSG_ERRO_TIPO_ROTA, 'UTF-8');

    if (in_array($this->request['metodo'], ConstantesGenericasUtil::TIPO_REQUEST, true)) {
      $this->retorno = $this->direcionarRequest();
    }

    return $this->retorno;
  }

  private function direcionarRequest()
  {
    if ($this->request['metodo'] !== self::GET && $this->request['metodo'] !== self::DELETE) {
      $this->dadosRequest = JsonUtil::tratarCorpoRequisicaoJson();
    }
    $metodo = $this->request['metodo'];

    return $this->$metodo();
  }

  private function get()
  {
    $retorno = mb_convert_encoding(ConstantesGenericasUtil::MSG_ERRO_TIPO_ROTA, 'UTF-8');
    if (in_array($this->request['rota'], ConstantesGenericasUtil::TIPO_GET, true)) {
      switch ($this->request['rota']) {
        case self::CONTATOS:
          $contatosService = new ContatosService($this->request);
          $retorno = $contatosService->validarGet();
          break;
        default:
          throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_RECURSO_INEXISTENTE);
      }
    }

    return $retorno;
  }

  private function delete()
  {
    $retorno = mb_convert_encoding(ConstantesGenericasUtil::MSG_ERRO_TIPO_ROTA, 'UTF-8');
    if (in_array($this->request['rota'], ConstantesGenericasUtil::TIPO_DELETE, true)) {
      switch ($this->request['rota']) {
        case self::CONTATOS:
          $contatosService = new ContatosService($this->request);
          $retorno = $contatosService->validarDelete();
          break;
        default:
          throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_RECURSO_INEXISTENTE);
      }
    }

    return $retorno;
  }

  private function post()
  {
    $retorno = mb_convert_encoding(ConstantesGenericasUtil::MSG_ERRO_TIPO_ROTA, 'UTF-8');
    if (in_array($this->request['rota'], ConstantesGenericasUtil::TIPO_POST, true)) {
      switch ($this->request['rota']) {
        case self::CONTATOS:
          $contatosService = new ContatosService($this->request);
          $contatosService->setDadosCorpoRequest($this->dadosRequest);
          $retorno = $contatosService->validarPost();
          break;
        default:
          throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_RECURSO_INEXISTENTE);
      }
    }

    return $retorno;
  }

  private function put()
  {
    $retorno = mb_convert_encoding(ConstantesGenericasUtil::MSG_ERRO_TIPO_ROTA, 'UTF-8');
    if (in_array($this->request['rota'], ConstantesGenericasUtil::TIPO_PUT, true)) {
      switch ($this->request['rota']) {
        case self::CONTATOS:
          $contatosService = new ContatosService($this->request);
          $contatosService->setDadosCorpoRequest($this->dadosRequest);
          $retorno = $contatosService->validarPut();
          break;
        default:
          throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_RECURSO_INEXISTENTE);
      }
    }

    return $retorno;
  }
}
