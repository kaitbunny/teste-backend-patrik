<?php

namespace Classes\Service;

use Classes\Model\Contato;
use Classes\Repository\ContatosRepository;
use Classes\Util\ConstantesGenericasUtil;
use Error;
use InvalidArgumentException;

class ContatosService
{
  public const TABELA = 'contato';
  public const RECURSOS_GET = ['listar', 'mostrar'];
  public const RECURSOS_DELETE = ['excluir'];
  public const RECURSOS_POST = ['cadastrar'];
  public const RECURSOS_PUT = ['editar'];

  private $dados = [];
  private $dadosCorpoRequest = [];

  private object $contatosRepository;

  public function __construct($dados = [])
  {
    $this->dados = $dados;
    $this->contatosRepository = new ContatosRepository();
  }

  public function validarGet()
  {
    $retorno = null;
    $recurso = $this->dados['recurso'];

    if (in_array($recurso, self::RECURSOS_GET, true)) {
      $retorno = $this->dados['id'] > 0 ? $this->getOneByKey() : $this->$recurso();
    } else {
      header('HTTP/1.1 400 Bad Request');
      throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_RECURSO_INEXISTENTE);
    }

    if ($retorno === null) {
      throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_SEM_RETORNO);
    }

    return $retorno;
  }

  private function getOneByKey()
  {
    //array
    $data = $this->contatosRepository->getMySQL()->getOneByKey(self::TABELA, $this->dados['id']);
    $contato = new Contato($data);
    $contato->setId($data['id']);
    return $contato->retornarArray();
  }

  private function listar()
  {
    //array de arrays
    $listaBase = $this->contatosRepository->getMySQL()->getAll(self::TABELA);
    $listaRetorno = [];
    //fazer um foreach
    foreach ($listaBase as $data) {
      $contato = new Contato($data);
      $contato->setId($data['id']);
      array_push($listaRetorno, $contato->retornarArraySimpleDTO());
    }

    return $listaRetorno;
  }

  public function validarDelete()
  {
    $retorno = null;
    $recurso = $this->dados['recurso'];

    if (in_array($recurso, self::RECURSOS_DELETE, true)) {
      if ($this->dados['id'] > 0) {
        $retorno = $this->$recurso();
      } else {
        header('HTTP/1.1 400 Bad Request');
        throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_ID_OBRIGATORIO);
      }
    } else {
      header('HTTP/1.1 400 Bad Request');
      throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_RECURSO_INEXISTENTE);
    }

    if ($retorno === null) {
      header('HTTP/1.1 404 Not Found');
      throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_SEM_RETORNO);
    }

    return $retorno;
  }

  private function excluir()
  {
    return $this->contatosRepository->getMySQL()->delete(self::TABELA, $this->dados['id']);
  }

  public function setDadosCorpoRequest($dadosRequest)
  {
    $this->dadosCorpoRequest = $dadosRequest;
  }

  public function validarPost()
  {
    $retorno = null;
    $recurso = $this->dados['recurso'];

    if (in_array($recurso, self::RECURSOS_POST, true)) {
      $retorno = $this->$recurso();
    } else {
      header('HTTP/1.1 400 Bad Request');
      throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_RECURSO_INEXISTENTE);
    }

    if ($retorno === null) {
      throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_SEM_RETORNO);
    }

    return $retorno;
  }

  private function cadastrar()
  {
    try {
      $contatoModel = new Contato($this->dadosCorpoRequest);

      if ($this->contatosRepository->insertContato($contatoModel) > 0) {
        $idInserido = $this->contatosRepository->getMySQL()->getDb()->lastInsertId();

        $contatoModel->setId($idInserido);

        $this->contatosRepository->getMySQL()->getDb()->commit();
        header('HTTP/1.1 201 Created');
        return $contatoModel->retornarArray();
      }
      $this->contatosRepository->getMySQL()->getDb()->rollBack();

      header('HTTP/1.1 500 Internal Server Error');
      throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_GENERICO);
    } catch (Error $e) {
      header('HTTP/1.1 400 Bad Request');
      throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_CORPO_INVALIDO);
    }
  }

  public function validarPut()
  {
    $retorno = null;
    $recurso = $this->dados['recurso'];

    if (in_array($recurso, self::RECURSOS_PUT, true)) {
      if ($this->dados['id'] > 0) {
        $retorno = $this->$recurso();
      } else {
        header('HTTP/1.1 400 Bad Request');
        throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_ID_OBRIGATORIO);
      }
    } else {
      header('HTTP/1.1 400 Bad Request');
      throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_RECURSO_INEXISTENTE);
    }

    if ($retorno === null) {
      throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_SEM_RETORNO);
    }

    return $retorno;
  }

  private function editar()
  {
    try {
      $contatoModel = new Contato($this->dadosCorpoRequest);
      if ($this->contatosRepository->updateContato($this->dados['id'], $contatoModel) === 1) {
        $this->contatosRepository->getMySQL()->getDb()->commit();

        $contatoModel->setId($this->dados['id']);

        $resposta['status'] = ConstantesGenericasUtil::MSG_ATUALIZADO_SUCESSO;
        $resposta['objeto'] = $contatoModel->retornarArray();

        return $resposta;
      }
      $this->contatosRepository->getMySQL()->getDb()->rollBack();

      throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_NAO_AFETADO);
    } catch (Error $e) {
      header('HTTP/1.1 400 Bad Request');
      throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_CORPO_INVALIDO);
    }
  }
}
