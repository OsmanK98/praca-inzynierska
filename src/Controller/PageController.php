<?php

namespace App\Controller;

use App\Service\CrawlerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PageController extends AbstractController
{
    public function __construct(private CrawlerService $crawlerService)
    {
    }

    #[Route('/get-content', name: 'get_content')]
    public function index()
    {
        $this->crawlerService->execute();
        return new Response('success');
    }
}
