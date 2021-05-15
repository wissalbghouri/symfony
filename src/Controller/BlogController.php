<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
class BlogController {
    public function index(){
        return new Response('hello world');
    }

}
?>