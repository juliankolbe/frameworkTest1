<?php

namespace FrameworkTest\Template;

interface Renderer
{
    public function render($template, $data = []);
}