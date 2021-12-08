<?php

namespace Alura\Doctrine\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @Entity
 */
class Curso
{
    /**
     * @Id
     * @GeneratedValue
     * @Column (type="integer")
     */
    private int $id;
    /**
     * @Column (type="string")
     */
    private string $nome;
    /**
     * @ManyToMany(targetEntity="Aluno", inversedBy="cursos")
     */
    private Collection $alunos;

    public function __construct()
    {
        $this->alunos = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;
        return $this;
    }

    public function addAluno(Aluno $aluno): self
    {
        if ($this->alunos->contains($aluno)) {
            return $this;
        }

        $this->alunos->add($aluno);
        return $this;
    }

    public function getAlunos(): Collection
    {
        return $this->alunos;
    }
}