<?php

namespace App\Entity;

use App\Repository\PageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PageRepository::class)
 */
class Page
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $url;

    /**
     * @ORM\OneToOne(targetEntity=PageHeadings::class, mappedBy="page", cascade={"persist", "remove"})
     */
    private $pageHeadings;

    /**
     * @ORM\OneToOne(targetEntity=PageImages::class, mappedBy="page", cascade={"persist", "remove"})
     */
    private $pageImages;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getPageHeadings(): ?PageHeadings
    {
        return $this->pageHeadings;
    }

    public function setPageHeadings(?PageHeadings $pageHeadings): self
    {
        if ($pageHeadings === null && $this->pageHeadings !== null) {
            $this->pageHeadings->setPage(null);
        }

        if ($pageHeadings !== null && $pageHeadings->getPage() !== $this) {
            $pageHeadings->setPage($this);
        }

        $this->pageHeadings = $pageHeadings;
        return $this;
    }

    public function getPageImages(): ?PageImages
    {
        return $this->pageImages;
    }

    public function setPageImages(PageImages $pageImages): self
    {
        // set the owning side of the relation if necessary
        if ($pageImages->getPage() !== $this) {
            $pageImages->setPage($this);
        }

        $this->pageImages = $pageImages;

        return $this;
    }
}
