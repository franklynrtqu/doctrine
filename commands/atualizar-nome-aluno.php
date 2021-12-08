<?php

use Alura\Doctrine\Entity\Aluno;
use Alura\Doctrine\Helper\EntityManagerFactory;

require_once __DIR__ . '/../vendor/autoload.php';

$entityManagerFactory = new EntityManagerFactory();
$entityManager = $entityManagerFactory->getEntityManager();

// Recebe o id por meio da linha de comando.
$id = $argv[1];
// Recebe o novo nome por meio da linha de comando.
$novoNome = $argv[2];

// Procura no banco o id definido.
/** @var Aluno $aluno */
$aluno = $entityManager->find(Aluno::class, $id);
// Atribue o novo nome ao id.
$aluno->setNome($novoNome);

// Faz a atualização do nome no DB.
$entityManager->flush();