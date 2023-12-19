<?php

namespace Classes\Repository;

use Classes\DB\MySQL;

class ContatosRepository
{
  private object $MySQL;
  public const TABELA = 'contato';

  public function __construct()
  {
    $this->MySQL = new MySQL();
  }

  public function insertContato($contatoModel)
  {
    $consultaInsert = 'INSERT INTO ' . self::TABELA . '(nome, profissao, nascimento, email, telefone, celular, celular_whatsapp, recebe_email, recebe_sms) VALUES(:nome, :profissao, :nascimento, :email, :telefone, :celular, :celularWhatsapp, :recebeEmail, :recebeSms)';

    $this->MySQL->getDb()->beginTransaction();
    $stmt = $this->MySQL->getDb()->prepare($consultaInsert);

    $stmt->bindParam(':nome', $contatoModel->getNome());
    $stmt->bindParam(':profissao', $contatoModel->getProfissao());
    $stmt->bindParam(':nascimento', $contatoModel->getNascimento());
    $stmt->bindParam(':email', $contatoModel->getEmail());
    $stmt->bindParam(':telefone', $contatoModel->getTelefone());
    $stmt->bindParam(':celular', $contatoModel->getCelular());
    $stmt->bindParam(':celularWhatsapp', $contatoModel->isCelularWhatsapp());
    $stmt->bindParam(':recebeEmail', $contatoModel->isRecebeEmail());
    $stmt->bindParam(':recebeSms', $contatoModel->isRecebeSms());

    $stmt->execute();

    return $stmt->rowCount();
  }

  public function updateContato($id, $contatoModel)
  {
    $consultaUpdate = 'UPDATE ' . self::TABELA . ' SET nome = :nome, profissao = :profissao, nascimento = :nascimento, email = :email, telefone = :telefone, celular = :celular, celular_whatsapp = :celularWhatsapp, recebe_email = :recebeEmail, recebe_sms = :recebeSms WHERE id = :id';

    $this->MySQL->getDb()->beginTransaction();
    $stmt = $this->MySQL->getDb()->prepare($consultaUpdate);

    $stmt->bindParam(':nome', $contatoModel->getNome());
    $stmt->bindParam(':profissao', $contatoModel->getProfissao());
    $stmt->bindParam(':nascimento', $contatoModel->getNascimento());
    $stmt->bindParam(':email', $contatoModel->getEmail());
    $stmt->bindParam(':telefone', $contatoModel->getTelefone());
    $stmt->bindParam(':celular', $contatoModel->getCelular());
    $stmt->bindParam(':celularWhatsapp', $contatoModel->isCelularWhatsapp());
    $stmt->bindParam(':recebeEmail', $contatoModel->isRecebeEmail());
    $stmt->bindParam(':recebeSms', $contatoModel->isRecebeSms());
    $stmt->bindParam(':id', $id);

    $stmt->execute();

    return $stmt->rowCount();
  }

  public function getMySQL()
  {
    return $this->MySQL;
  }
}
