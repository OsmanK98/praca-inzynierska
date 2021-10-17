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
}
