<?php

namespace Alura\Doctrine\Entity;
// A notação Entity ajuda o Doctrine a entender que essa classe é uma entidade.
// Assim ao ser gerado o banco de dados, ele vai identificar essa classe como uma
// representação de uma tabela no banco de dados.
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @Entity(repositoryClass="Alura\Doctrine\Repository\AlunoRepository")
 */
class Aluno
{
    // A notação @Id, deixa claro para o Doctrine, que esse atributo $id da classe,
    // será representado por uma coluna no banco de dados que será a chave principal;
    // a notação @GeneratedValue expecífica que a coluna será autoincrement,
    // e a notação @Column(type-integer), deixa claro o tipo de dado que a coluna armazenará.
    /**
     * @Id
     * @GeneratedValue
     * @Column (type="integer")
     */
    private string $id;

    /**
     * @Column (type="string")
     */
    private string $nome;
    /**
     * @OneToMany(targetEntity="Telefone", mappedBy="aluno", cascade={"remove", "persist"}, fetch="EAGER")
     */
    private Collection $telefones;

    /**
     * @ManyToMany (targetEntity="Curso", mappedBy="alunos")
     */
    private Collection $cursos;

    public function __construct()
    {
        $this->telefones = new ArrayCollection();
        $this->cursos = new ArrayCollection();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome(string $nome): self
    {
        $this->nome = $nome;
        return $this;

        // O retorno self, permite usar a seguinte notação $aluno->setNome('Teste')->getId,
        // sendo possível chamadas encadeadas dos métodos.
    }

    public function addTelefone(Telefone $telefone): self
    {
        $this->telefones->add($telefone);
        $telefone->setAluno($this);
        return $this;
    }

    public function getTelefones(): Collection
    {
        return $this->telefones;
    }

    public function addCurso(Curso $curso): self
    {
        if ($this->cursos->contains($curso)) {
            return $this;
        }

        $this->cursos->add($curso);
        $curso->addAluno($this);

        return $this;
    }
    /**@return Curso[]  */
    public function getCursos(): Collection
    {
        return $this->cursos;
    }
}