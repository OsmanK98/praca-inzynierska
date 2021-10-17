<?php

namespace App\Entity;

use App\Repository\PageImagesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PageImagesRepository::class)
 */
class PageImages
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numberOfGraphics;

    /**
     * @ORM\OneToOne(targetEntity=Page::class, inversedBy="pageImages", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $page;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numberOfSmallSizeGraphics;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numberOfMediumSizeGraphics;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numberOfBigSizeGraphics;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numberOfCustomGraphics;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numberOfSvgGraphics;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumberOfGraphics(): ?int
    {
        return $this->numberOfGraphics;
    }

    public function setNumberOfGraphics(?int $numberOfGraphics): self
    {
        $this->numberOfGraphics = $numberOfGraphics;

        return $this;
    }

    public function getPage(): ?Page
    {
        return $this->page;
    }

    public function setPage(Page $page): self
    {
        $this->page = $page;

        return $this;
    }

    public function getNumberOfSmallSizeGraphics(): ?int
    {
        return $this->numberOfSmallSizeGraphics;
    }

    public function setNumberOfSmallSizeGraphics(?int $numberOfSmallSizeGraphics): self
    {
        $this->numberOfSmallSizeGraphics = $numberOfSmallSizeGraphics;

        return $this;
    }

    public function getNumberOfMediumSizeGraphics(): ?int
    {
        return $this->numberOfMediumSizeGraphics;
    }

    public function setNumberOfMediumSizeGraphics(?int $numberOfMediumSizeGraphics): self
    {
        $this->numberOfMediumSizeGraphics = $numberOfMediumSizeGraphics;

        return $this;
    }

    public function getNumberOfBigSizeGraphics(): ?int
    {
        return $this->numberOfBigSizeGraphics;
    }

    public function setNumberOfBigSizeGraphics(?int $numberOfBigSizeGraphics): self
    {
        $this->numberOfBigSizeGraphics = $numberOfBigSizeGraphics;

        return $this;
    }

    public function getNumberOfCustomGraphics(): ?int
    {
        return $this->numberOfCustomGraphics;
    }

    public function setNumberOfCustomGraphics(?int $numberOfCustomGraphics): self
    {
        $this->numberOfCustomGraphics = $numberOfCustomGraphics;

        return $this;
    }

    public function getNumberOfSvgGraphics(): ?int
    {
        return $this->numberOfSvgGraphics;
    }

    public function setNumberOfSvgGraphics(?int $numberOfSvgGraphics): self
    {
        $this->numberOfSvgGraphics = $numberOfSvgGraphics;

        return $this;
    }
}
