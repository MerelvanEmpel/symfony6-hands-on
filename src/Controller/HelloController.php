<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use Symfony\Component\Routing\Annotation\Route;

class HelloController {
    private array $messages = ["Hello", "Hi", "Bye!"];

    #[Route('/{limit<\d+>?3}', name: 'app_index')]
    public function index(int $limit): HttpFoundationResponse {
        return new HttpFoundationResponse(implode(',', array_slice($this->messages, 0, $limit)));
    }

    #[Route('/messages/{id<\d+>}', name: 'app_show_one')]
    public function showOne(int $id): HttpFoundationResponse {
        return new HttpFoundationResponse($this->messages[$id]);
    }
}