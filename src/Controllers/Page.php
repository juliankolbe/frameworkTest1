<?php

namespace FrameworkTest\Controllers;


use Http\Response;
use FrameworkTest\Template\FrontendRenderer;
use FrameworkTest\Page\PageReader;
use FrameworkTest\Page\InvalidPageException;

class Page
{
    private $pageReader;
    private $response;
    private $frontendRenderer;
    
    public function __construct(
        PageReader $pageReader,
        Response $response,
        FrontendRenderer $frontendRenderer
    ) {
        $this->pageReader = $pageReader;
        $this->response = $response;
        $this->frontendRenderer = $frontendRenderer;
    }

    public function show($params)
    {
        $slug = $params['slug'];
        try {
            $data['content'] = $this->pageReader->readBySlug($slug);
        } catch (InvalidPageException $e) {
            $this->response->setStatusCode(404);
            return $this->response->setContent('404 - Page not found');
        }
        $html = $this->frontendRenderer->render('Page', $data);
        $this->response->setContent($html);
    }
}