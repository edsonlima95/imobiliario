<?php


namespace App\Support;


use CoffeeCode\Optimizer\Optimizer;

class Seo
{

    private $opitimizer;

    public function __construct()
    {
        $this->opitimizer = new Optimizer();
        $this->opitimizer->openGraph(
            env('APP_SITE_NAME'),
            'pt_BR',
            'article'
        )->facebook(
            env('APP_FACE_ID')
        )->publisher(
            env('APP_FACE_PAGE'),
            env('APP_FACE_AUTHOR')
        );
    }


    public function render(string $title, string $description, string $url, string $image, $follow = true)
    {
        return $this->opitimizer->optimize($title, $description, $url, $image, $follow)->render();
    }

}
