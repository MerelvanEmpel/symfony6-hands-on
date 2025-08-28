<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class HelloController {
    private array $messages = ["Hello", "Hi", "Bye!"];

    #[Route('/', name: 'app_index')]
    public function index(): HttpFoundationResponse {
        return new HttpFoundationResponse(implode(',', $this->messages));
    }

    #[Route('/messages/{id}', name: 'app_show_one')]
    public function showOne($id): HttpFoundationResponse {
        return new HttpFoundationResponse($this->messages[$id]);
    }
}