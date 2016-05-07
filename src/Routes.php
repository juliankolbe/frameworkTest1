<?php

return [
    ['GET', '/', ['FrameworkTest\Controllers\Homepage', 'show']],
    ['GET', '/{slug}', ['FrameworkTest\Controllers\Page', 'show']],
];