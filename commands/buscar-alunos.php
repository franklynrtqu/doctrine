<?php

use Alura\Doctrine\Entity\Aluno;
use Alura\Doctrine\Entity\Telefone;
use Alura\Doctrine\Helper\EntityManagerFactory;

require_once __DIR__ . '/../vendor/autoload.php';

$entityManagerFactory = new EntityManagerFactory();
$entityManager = $entityManagerFactory->getEntityManager();

$alunoRepository = $entityManager->getRepository(Aluno::class);

/** @var Aluno[] $alunoList */
$alunoList = $alunoRepository->findAll();

foreach ($alunoList as $aluno) {
    $telefones = $aluno
        ->getTelefones()
        ->map(function (Telefone $telefone) {
            return $telefone->getNumero();
        })
    ->toArray();
    echo "ID: {$aluno->getId()} \nNome: {$aluno->getNome()}\n\n";
    echo "Telefones: " . implode(', ', $telefones);
    echo "\n\n";
}

// Retorna um array com os valores correspondentes ao filtro.
/*
 * public function findBy(
 *     array $criteria,
 *     ?array $orderBy = null,
 *     ?int $limit = null,
 *     ?int $offset = null
 * );
 *
 * $criteria: Critério de busca. Array vazio significa sem critério, ou seja, sem filtro, buscando todos os registros;
 * $orderBy: Critério de ordenação. Um array onde as chaves são os campos, e os valores são 'ASC' para ordem crescente e 'DESC' para decrescente;
 * $limit: Numéro de resultados para trazer do banco;
 * $offset: A partir de qual dado buscar do banco. Muito utilizado para realizar paginação de dados.
 *
 * Exemplo: $alunoRepository->findBy([], ['nome' => 'ASC'], 2, 3);
 */
/*
$franklyn = $alunoRepository->findBy(
    ['nome' => 'Franklyn']
);

// Retorna apenas um objeto
$franklyn = $alunoRepository->findOneBy(
    ['nome' => 'Franklyn']
);
*/