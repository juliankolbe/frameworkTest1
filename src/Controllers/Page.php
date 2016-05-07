<?php

namespace FrameworkTest\Controllers;


use Http\Response;
use FrameworkTest\Template\Renderer;
use FrameworkTest\Page\PageReader;
use FrameworkTest\Page\InvalidPageException;

class Page
{
    private $pageReader;
    private $response;
    private $renderer;
    
    public function __construct(
        PageReader $pageReader,
        Response $response,
        Renderer $renderer
    ) {
        $this->pageReader = $pageReader;
        $this->response = $response;
        $this->renderer = $renderer;
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
        $html = $this->renderer->render('Page', $data);
        $this->response->setContent($html);
    }
}