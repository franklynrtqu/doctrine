<?php

use Alura\Doctrine\Entity\Aluno;
use Alura\Doctrine\Entity\Telefone;
use Alura\Doctrine\Helper\EntityManagerFactory;

require_once __DIR__ . '/../vendor/autoload.php';

$entityManagerFactory = new EntityManagerFactory();
$entityManager =  $entityManagerFactory->getEntityManager();

$aluno = new Aluno();
$aluno->setNome($argv[1]);


for ($i = 2; $i < $argc; $i++) {
    $numeroTelefone = $argv[$i];
    $telefone = new Telefone();
    $telefone->setNumero($numeroTelefone);

    $aluno->addTelefone($telefone);
}

// O comando persist ele começa a observar o objeto passado como argumento para ele.
$entityManager->persist($aluno);

// Ao fazer uma alteração, após ter começado a observar o objeto, essa alteração será replicada.
// $aluno->setNome("Franklyn R. T. de Quadros");

// Faz com que o dado seja persistido no DB.
$entityManager->flush();