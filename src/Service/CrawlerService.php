<?php


namespace App\Service;


use App\Entity\Page;
use App\Repository\PageRepository;
use App\Service\DataCrawler\PageHeadingsService;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CrawlerService
{
    public function __construct(
        private HttpClientInterface $client,
        private PageRepository $pageRepository,
        private PageHeadingsService $pageHeadingsService
    )
    {
    }

    public function execute()
    {
        $pages = $this->pageRepository->findAll();
        foreach ($pages as $page) {
            $content = $this->getContentFromPage($page);
            $this->getDataFromContent($page, $content);
        }
    }

    private function getContentFromPage(Page $page): Crawler
    {
        $response = $this->client->request('GET', $page->getUrl());
        return new Crawler($response->getContent());
    }

    private function getDataFromContent(Page $page, Crawler $content)
    {
        $this->pageHeadingsService->execute($page, $content);
    }
}
