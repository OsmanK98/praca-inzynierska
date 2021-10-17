<?php

namespace App\Service\DataCrawler;

use App\Entity\Page;
use App\Entity\PageImages;
use App\Repository\PageImagesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DomCrawler\Crawler;

class PageImagesService
{
    private Crawler $content;
    private ?PageImages $pageImages;
    private Page $page;

    public function __construct(private PageImagesRepository $pageImagesRepository,
                                private EntityManagerInterface $em)
    {
    }

    public function execute(Page $page, Crawler $content)
    {
        $this->page = $page;
        $this->content = $content;
        $this->pageImages = $this->pageImagesRepository->findOneBy(['page' => $page]);
        if (!$this->pageImages instanceof PageImages) {
            $this->pageImages = new PageImages();
            $this->pageImages->setPage($page);
        }
        $this->getPageImagesData();
        $this->em->persist($this->pageImages);
        $this->em->flush();
    }

    private function getPageImagesData()
    {
        $images = $this->content
            ->filterXpath('//img')->extract(array('src'));
        $this->saveFiles($images);
    }

    private function saveFiles(array $images)
    {
        if (!file_exists('images/' . $this->page->getId())) {
            mkdir('images/' . $this->page->getId(), 0755, true);
        } else {
            $files = glob('images/' . $this->page->getId());
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
        }

        foreach ($images as $image) {
            dd($image);
            $path = "images/" . $this->page->getId() .'/'. basename($image);
            $file = file_get_contents($image);
            $insert = file_put_contents($path, $file);
            if (!$insert) {
                throw new \Exception('Failed to write image');
            }
        }
    }
}
