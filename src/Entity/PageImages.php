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
}
