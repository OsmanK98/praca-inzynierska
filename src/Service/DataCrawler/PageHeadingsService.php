<?php


namespace App\Service\DataCrawler;


use App\Entity\Page;
use App\Entity\PageHeadings;
use App\Repository\PageHeadingsRepository;
use App\Repository\PageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DomCrawler\Crawler;

class PageHeadingsService
{
    private ?PageHeadings $pageHeadings;
    private Crawler $content;
    private int $counter = 0;

    private $headings = ['H1', 'H2', 'H3', 'H4', 'H5', 'H6'];

    public function __construct(private PageHeadingsRepository $pageHeadingsRepository,
                                private EntityManagerInterface $em)
    {
    }

    public function execute(Page $page, Crawler $content)
    {
        $this->content = $content;
        $this->pageHeadings = $this->pageHeadingsRepository->findOneBy(['page' => $page]);
        if (!$this->pageHeadings instanceof PageHeadings) {
            $this->pageHeadings = new PageHeadings();
            $this->pageHeadings->setPage($page);
        }
        $this->getPageHeadingsData();
        $this->em->persist($this->pageHeadings);
        $this->em->flush();
        dd('xd');
    }

    private function getPageHeadingsData()
    {
        foreach ($this->headings as $heading) {
            $this->counter=0;
            $this->getHeadingData($heading);
        }
    }

    private function getHeadingData(string $heading)
    {
        $h = $this->content->filter($heading);
        $methodOfSetQuantity = "setQuantity$heading";
        $methodOfSetAverageWords = "setAverageWordCountIn$heading";
        if (count($h) > 0) {
            $averageWordCountInHeading = $this->getAverageWordCountInHeading($h);
            $this->pageHeadings->$methodOfSetQuantity(count($h));
            $this->pageHeadings->$methodOfSetAverageWords($averageWordCountInHeading);
        }
    }

    private function getAverageWordCountInHeading($h): int
    {
        foreach ($h as $hNode) {
            foreach ($hNode->childNodes as $childNode) {
                $this->getTextFromNodes($childNode);
            }
        }
        dump($this->counter);
        dump(count($h));
        dump($this->counter / count($h));
//        dd('xd');
        if (count($h) > 0) {
            return $this->counter / count($h);
        } else {
            return 0;
        }
    }

    private function getTextFromNodes($childNode)
    {
        if ($childNode == null) {
            return 1;
        }
        if ($childNode->nodeName === '#text') {
            dump($childNode->data);
            $this->counter += str_word_count($childNode->data);
            return 1;
        } else {
            return $this->getTextFromNodes($childNode->firstChild);
        }
    }
}



//            foreach ($node->childNodes as $childNode) {
//                //dump($childNode->nodeName);
//                //dump($childNode);
//                if ($childNode->nodeName === 'span') {
//                    if(isset($childNode->firstChild->data)) {
//                        $text = $childNode->firstChild->data;
//                        dump($text);
//                        $count += str_word_count($text);
//                    }else{
//                        $text = $childNode->firstChild->firstChild->data;
//                        dump($text);
//                        $count += str_word_count($text);
//                    }
//                }
//                if ($childNode->nodeName === '#text') {
//                    $text = $childNode->data;
//                    dump($text);
//                    $count += str_word_count($text);
//                }
//            }
