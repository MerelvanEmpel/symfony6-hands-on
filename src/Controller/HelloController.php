<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class HelloController {
    public function index(): HttpFoundationResponse {
        return new HttpFoundationResponse("HI!");
    }
}