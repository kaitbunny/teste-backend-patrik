<?php

use Classes\Util\ConstantesGenericasUtil;
use Classes\Util\JsonUtil;
use Classes\Validator\RequestValidator;
use Classes\Util\RotasUtil;

include 'bootstrap.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

try {
  $RequestValidator = new RequestValidator(RotasUtil::getRotas());
  $retorno = $RequestValidator->processarRequest();

  $JsonUtil = new JsonUtil();
  $JsonUtil->processarArrayParaRetornar($retorno);
} catch (Exception $e) {
  echo json_encode([
    ConstantesGenericasUtil::TIPO => ConstantesGenericasUtil::TIPO_ERRO,
    ConstantesGenericasUtil::RESPOSTA => mb_convert_encoding($e->getMessage(), 'UTF-8')
  ]);
  exit;
}
