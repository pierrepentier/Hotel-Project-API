<?php

namespace App\DTO;


class CategorieDTO
{
    private $litSimple;
    private $litDouble;
    private $litKing;
    private $nom;
    private $nbrePersonnes;
    private $tarifersDTO;



    public function getLitSimple(): ?int
    {
        return $this->litSimple;
    }

    public function setLitSimple(?int $litSimple): self
    {
        $this->litSimple = $litSimple;

        return $this;
    }

    public function getLitDouble(): ?int
    {
        return $this->litDouble;
    }

    public function setLitDouble(?int $litDouble): self
    {
        $this->litDouble = $litDouble;

        return $this;
    }

    public function getLitKing(): ?int
    {
        return $this->litKing;
    }

    public function setLitKing(?int $litKing): self
    {
        $this->litKing = $litKing;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getNbrePersonnes(): ?int
    {
        return $this->nbrePersonnes;
    }

    public function setNbrePersonnes(int $nbrePersonnes): self
    {
        $this->nbrePersonnes = $nbrePersonnes;

        return $this;
    }


}