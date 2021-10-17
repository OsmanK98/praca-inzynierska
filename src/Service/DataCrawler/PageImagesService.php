<?php

namespace App\Service\DataCrawler;

use App\Entity\Page;
use App\Entity\PageImages;
use App\Repository\PageImagesRepository;
use App\Service\Enum\ImageSize;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DomCrawler\Crawler;

class PageImagesService
{
    private Crawler $content;
    private ?PageImages $pageImages;
    private int $counterImages = 0;
    private int $counterSvgImage = 0;
    private int $counterSmallImage = 0;
    private int $counterMediumImage = 0;
    private int $counterBigImage = 0;
    private int $counterCustomImage = 0;

    public function __construct(private PageImagesRepository $pageImagesRepository,
                                private EntityManagerInterface $em)
    {
    }

    public function execute(Page $page, Crawler $content)
    {
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
        $this->resetCounters();
        $images = $this->content
            ->filterXpath('//img')->extract(array('src'));

        foreach ($images as $image) {
            if (!$this->isAllowedExtensionOfImage($image)) {
                continue;
            }
            $this->getSizeOfImages($image);
            $this->counterImages++;
        }

        $this->pageImages->setNumberOfSmallSizeGraphics($this->counterSmallImage);
        $this->pageImages->setNumberOfMediumSizeGraphics($this->counterMediumImage);
        $this->pageImages->setNumberOfBigSizeGraphics($this->counterBigImage);
        $this->pageImages->setNumberOfCustomGraphics($this->counterCustomImage);
        $this->pageImages->setNumberOfSvgGraphics($this->counterSvgImage);
        $this->pageImages->setNumberOfGraphics($this->counterImages);
    }

    private function isAllowedExtensionOfImage($image): bool
    {
        foreach (ImageSize::ALLOWED_IMAGE_EXTENSION as $extension) {
            if (str_contains($image, $extension) && str_contains($image, 'http')) {
                return true;
            }
        }
        return false;
    }

    private function getSizeOfImages($image)
    {
        if (str_contains($image, '.svg')) {
            $this->counterSvgImage++;
            return;
        }

        $imageSize = getimagesize($image);

        if ($imageSize == false) {
            $this->counterCustomImage++;
            return;
        }

        $widthSize = $imageSize[0];
        $heightSize = $imageSize[1];

        if ($widthSize < ImageSize::SMALL_SIZE_WIDTH && $heightSize < ImageSize::SMALL_SIZE_HEIGHT) {
            $this->counterSmallImage++;
            return;
        }

        if ($widthSize < ImageSize::MEDIUM_SIZE_WIDTH && $heightSize < ImageSize::MEDIUM_SIZE_HEIGHT) {
            $this->counterMediumImage++;
            return;
        }

        if ($widthSize < ImageSize::BIG_SIZE_WIDTH && $heightSize < ImageSize::BIG_SIZE_HEIGHT) {
            $this->counterBigImage++;
            return;
        }
        $this->counterCustomImage++;
    }

    private function resetCounters()
    {
        $this->counterImages = 0;
        $this->counterSvgImage = 0;
        $this->counterSmallImage = 0;
        $this->counterMediumImage = 0;
        $this->counterBigImage = 0;
        $this->counterCustomImage = 0;
    }
}
