<?php

namespace App\Entity;

use App\Repository\PageHeadingsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PageHeadingsRepository::class)
 */
class PageHeadings
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Page::class, inversedBy="pageHeadings", cascade={"persist", "remove"})
     */
    private $page;


    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $quantityH1;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private ?float $averageWordCountInH1;


    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $quantityH2;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private ?float $averageWordCountInH2;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $quantityH3;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private ?float $averageWordCountInH3;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $quantityH4;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private ?float $averageWordCountInH4;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $quantityH5;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private ?float $averageWordCountInH5;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $quantityH6;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private ?float $averageWordCountInH6;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPage(): ?Page
    {
        return $this->page;
    }

    public function setPage(?Page $page): self
    {
        $this->page = $page;

        return $this;
    }

    public function getQuantityH1(): ?int
    {
        return $this->quantityH1;
    }

    public function setQuantityH1(?int $quantityH1): self
    {
        $this->quantityH1 = $quantityH1;

        return $this;
    }

    public function getAverageWordCountInH1(): ?float
    {
        return $this->averageWordCountInH1;
    }

    public function setAverageWordCountInH1(?float $averageWordCountInH1): self
    {
        $this->averageWordCountInH1 = $averageWordCountInH1;

        return $this;
    }

    public function getQuantityH2(): ?int
    {
        return $this->quantityH2;
    }

    public function setQuantityH2(?int $quantityH2): void
    {
        $this->quantityH2 = $quantityH2;
    }

    public function getAverageWordCountInH2(): ?float
    {
        return $this->averageWordCountInH2;
    }

    public function setAverageWordCountInH2(?float $averageWordCountInH2): void
    {
        $this->averageWordCountInH2 = $averageWordCountInH2;
    }

    public function getQuantityH3(): ?int
    {
        return $this->quantityH3;
    }

    public function setQuantityH3(?int $quantityH3): void
    {
        $this->quantityH3 = $quantityH3;
    }

    public function getAverageWordCountInH3(): ?float
    {
        return $this->averageWordCountInH3;
    }

    public function setAverageWordCountInH3(?float $averageWordCountInH3): void
    {
        $this->averageWordCountInH3 = $averageWordCountInH3;
    }

    public function getQuantityH4(): ?int
    {
        return $this->quantityH4;
    }

    public function setQuantityH4(?int $quantityH4): void
    {
        $this->quantityH4 = $quantityH4;
    }

    public function getAverageWordCountInH4(): ?float
    {
        return $this->averageWordCountInH4;
    }

    public function setAverageWordCountInH4(?float $averageWordCountInH4): void
    {
        $this->averageWordCountInH4 = $averageWordCountInH4;
    }

    public function getQuantityH5(): ?int
    {
        return $this->quantityH5;
    }

    public function setQuantityH5(?int $quantityH5): void
    {
        $this->quantityH5 = $quantityH5;
    }

    public function getAverageWordCountInH5(): ?float
    {
        return $this->averageWordCountInH5;
    }

    public function setAverageWordCountInH5(?float $averageWordCountInH5): void
    {
        $this->averageWordCountInH5 = $averageWordCountInH5;
    }

    public function getQuantityH6(): ?int
    {
        return $this->quantityH6;
    }

    public function setQuantityH6(?int $quantityH6): void
    {
        $this->quantityH6 = $quantityH6;
    }

    public function getAverageWordCountInH6(): ?float
    {
        return $this->averageWordCountInH6;
    }

    public function setAverageWordCountInH6(?float $averageWordCountInH6): void
    {
        $this->averageWordCountInH6 = $averageWordCountInH6;
    }
}
