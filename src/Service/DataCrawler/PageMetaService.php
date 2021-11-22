<?php

namespace App\Service\DataCrawler;

use App\Entity\Page;
use App\Entity\PageImages;
use App\Entity\PageMeta;
use App\Repository\PageImagesRepository;
use App\Repository\PageMetaRepository;
use App\Service\Enum\ImageSize;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DomCrawler\Crawler;

class PageMetaService
{
    private Crawler $content;
    private ?PageMeta $pageMeta;

    public function __construct(private PageMetaRepository $pageMetaRepository,
                                private EntityManagerInterface $em)
    {
    }

    public function execute(Page $page, Crawler $content)
    {
        $this->content = $content;
        $this->pageMeta = $this->pageMetaRepository->findOneBy(['page' => $page]);
        if (!$this->pageMeta instanceof PageMeta) {
            $this->pageMeta = new PageMeta();
            $this->pageMeta->setPage($page);
        }
        $this->getPageMetaData($page->getUrl());
        $this->em->persist($this->pageMeta);
        $this->em->flush();
    }

    private function getPageMetaData(string $url)
    {
        $tags=get_meta_tags($url);
        foreach($tags as $key => $tag)
        {
            $method = 'set'.$key;
            if (!method_exists($this->pageMeta, $method)) {
                continue;
            }
            $this->pageMeta->$method(str_word_count($tag));
        }
    }
}
