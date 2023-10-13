<?php
return [
    '~^$~' => ['\controllers\RegisterController', 'register'],
    '~^register/login$~' => ['\controllers\RegisterController', 'login'],
    '~^product/create~' => ['\controllers\ProductController', 'create'],
    '~^product/update/(\d+)$~' => ['\controllers\ProductController', 'update'],
    '~^product/delete/(\d+)$~' => ['\controllers\ProductController', 'delete'],

    '~^register/plogin$~' => ['\controllers\RegisterController', 'plogin'],
    '~^register/pregistration~' => ['\controllers\RegisterController', 'pregistration'],
    '~^product/list/(\d+)$~' => ['\controllers\ProductController', 'list'],
    '~^product/list$~' => ['\controllers\ProductController', 'list'],
    '~^auth/logout$~' => ['\controllers\RegisterController', 'logout'],
];