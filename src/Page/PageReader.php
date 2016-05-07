<?php

namespace FrameworkTest\Page;

interface PageReader
{
    public function readBySlug($slug);
}