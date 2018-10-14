<?php

namespace UrlShortener\Controller;

use UrlShortener\Service\ResponseFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use UrlShortener\Component\Url\UrlShortenerService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UrlShortener\Component\Url\UrlManager;
use UrlShortener\Exception\ValidationFailed;

class AppController extends Controller
{
    private $responseFactory;

    public function __construct(ResponseFactory $response)
    {
        $this->responseFactory = $response;
    }

    /**
     * @Route("/", name="homepage", methods={"GET"})
     */
    public function homepage()
    {
        $path = $this->get('kernel')->getProjectDir().'/public/dist/index.html';

        return $this->responseFactory->response(file_get_contents($path));
    }

    /**
     * @Route("/{short}", name="url_redirector", methods={"GET"})
     */
    public function urlRedirector(UrlManager $repo, string $short)
    {
        $long = $repo->getLong($short);

        if (!$long) {
            return $this->responseFactory->jsonError('Resource not found', 404);
        }

        return $this->responseFactory->response(['url' => $long], 301);
    }

    /**
     * @Route("/", name="url_shortener", methods={"POST"})
     */
    public function shortenUrl(Request $request, UrlShortenerService $shortener)
    {
        try {
            $content = json_decode($request->getContent(), true);

            $url = $content['url'] ?? null;

            $short = $shortener->shorten($url);

            return $this->responseFactory->jsonResponse(['url' => $url, 'short_url' => $short]);
        } catch (ValidationFailed $e) {
            return $this->responseFactory->jsonError('Validation failed', 400);
        }
    }
}
