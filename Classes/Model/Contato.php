<?php

namespace Classes\Model;

use DateTime;
use InvalidArgumentException;

class Contato
{
  private $id;
  private $nome;
  private $profissao;
  private $nascimento;
  private $email;
  private $telefone;
  private $celular;
  private $celularWhatsapp;
  private $recebeEmail;
  private $recebeSms;

  public function __construct(array $dados)
  {
    if (isset($dados['nome'])) {
      $this->setNome($dados['nome']);
    }

    if (isset($dados['profissao'])) {
      $this->setProfissao($dados['profissao']);
    }

    if (isset($dados['nascimento'])) {
      $this->setNascimento($dados['nascimento']);
    }

    if (isset($dados['email'])) {
      $this->setEmail($dados['email']);
    }

    if (isset($dados['telefone'])) {
      $this->setTelefone($dados['telefone']);
    }

    if (isset($dados['celular'])) {
      $this->setCelular($dados['celular']);
    }

    if (isset($dados['celular_whatsapp'])) {
      $this->setCelularWhatsapp($dados['celular_whatsapp']);
    } elseif (isset($dados['celularWhatsapp'])) {
      $this->setCelularWhatsapp($dados['celularWhatsapp']);
    }

    if (isset($dados['recebe_email'])) {
      $this->setRecebeEmail($dados['recebe_email']);
    } elseif (isset($dados['recebeEmail'])) {
      $this->setRecebeEmail($dados['recebeEmail']);
    }

    if (isset($dados['recebe_sms'])) {
      $this->setRecebeSms($dados['recebe_sms']);
    } elseif (isset($dados['recebeSms'])) {
      $this->setRecebeSms($dados['recebeSms']);
    }
  }

  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    if (is_numeric($id) && is_int($id + 0)) {
      $id = intval($id);
      $this->id = $id;
    } else {
      header('HTTP/1.1 400 Bad Request');
      throw new InvalidArgumentException("O valor fornecido para ID não é um número inteiro válido.");
    }
  }

  public function getNome(): string
  {
    return $this->nome;
  }

  public function setNome($nome)
  {
    $this->nome = $nome;
  }

  public function getProfissao(): string
  {
    return $this->profissao;
  }

  public function setProfissao($profissao)
  {
    $this->profissao = $profissao;
  }

  public function getNascimento(): string
  {
    return $this->nascimento;
  }

  public function setNascimento($nascimento)
  {
    $data = DateTime::createFromFormat('Y-m-d', $nascimento);
    if ($data && $data->format('Y-m-d') === $nascimento) {
      $this->nascimento = $nascimento;
    } else {
      header('HTTP/1.1 400 Bad Request');
      throw new InvalidArgumentException("O valor fornecido não é uma data válida no formato 'Y-m-d'.");
    }
  }

  public function getEmail(): string
  {
    return $this->email;
  }

  public function setEmail($email)
  {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $this->email = $email;
    } else {
      header('HTTP/1.1 400 Bad Request');
      throw new InvalidArgumentException("O valor fornecido não é um endereço de e-mail válido.");
    }
  }

  public function getTelefone(): string
  {
    return $this->telefone;
  }

  public function setTelefone($telefone)
  {
    if ($telefone == "") {
      $this->telefone = $telefone;
      return;
    }
    if (ctype_digit($telefone) && strlen($telefone) == 10) {
      $this->telefone = $telefone;
    } else {
      header('HTTP/1.1 400 Bad Request');
      throw new InvalidArgumentException("O valor fornecido não é um número de telefone válido.");
    }
  }

  public function getCelular(): string
  {
    return $this->celular;
  }

  public function setCelular($celular)
  {
    if (ctype_digit($celular) && strlen($celular) == 11) {
      $this->celular = $celular;
    } else {
      header('HTTP/1.1 400 Bad Request');
      throw new InvalidArgumentException("O valor fornecido não é um número de celular válido.");
    }
  }

  public function isCelularWhatsapp(): bool
  {
    return $this->celularWhatsapp;
  }

  public function setCelularWhatsapp($celularWhatsapp)
  {
    if ($celularWhatsapp == '1') {
      $celularWhatsapp = true;
    } else if ($celularWhatsapp == '0') {
      $celularWhatsapp = false;
    }
    if (is_bool($celularWhatsapp)) {
      $this->celularWhatsapp = $celularWhatsapp;
    } else {
      header('HTTP/1.1 400 Bad Request');
      throw new InvalidArgumentException("O valor fornecido não é um boolean.");
    }
  }

  public function isRecebeEmail(): bool
  {
    return $this->recebeEmail;
  }

  public function setRecebeEmail($recebeEmail)
  {
    if ($recebeEmail == '1') {
      $recebeEmail = true;
    } else if ($recebeEmail == '0') {
      $recebeEmail = false;
    }
    if (is_bool($recebeEmail)) {
      $this->recebeEmail = $recebeEmail;
    } else {
      header('HTTP/1.1 400 Bad Request');
      throw new InvalidArgumentException("O valor fornecido não é um boolean.");
    }
  }

  public function isRecebeSms(): bool
  {
    return $this->recebeSms;
  }

  public function setRecebeSms($recebeSms)
  {
    if ($recebeSms == '1') {
      $recebeSms = true;
    } else if ($recebeSms == '0') {
      $recebeSms = false;
    }
    if (is_bool($recebeSms)) {
      $this->recebeSms = $recebeSms;
    } else {
      header('HTTP/1.1 400 Bad Request');
      throw new InvalidArgumentException("O valor fornecido não é um boolean.");
    }
  }

  public function retornarArray(): array
  {
    return [
      'id' => $this->getId(),
      'nome' => $this->getNome(),
      'profissao' => $this->getProfissao(),
      'nascimento' => $this->getNascimento(),
      'email' => $this->getEmail(),
      'telefone' => $this->getTelefone(),
      'celular' => $this->getCelular(),
      'celularWhatsapp' => $this->isCelularWhatsapp(),
      'recebeEmail' => $this->isRecebeEmail(),
      'recebeSms' => $this->isRecebeSms(),
    ];
  }

  public function retornarArraySimpleDTO(): array
  {
    return [
      'id' => $this->getId(),
      'nome' => $this->getNome(),
      'nascimento' => $this->getNascimento(),
      'email' => $this->getEmail(),
      'celular' => $this->getCelular(),
    ];
  }
}
