<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController {
    private array $messages = [
        ['message' => 'Hello', 'created' => '2025/08/12'], // Must be within the last three months
        ['message' => 'Hi', 'created' => '2025/06/12'], // Must be within the last three months
        ['message' => 'Bye!', 'created' => '2021/05/12'] // Must be at least a year ago
    ];

    #[Route('/{limit<\d+>?3}', name: 'app_index')]
    public function index(int $limit): HttpFoundationResponse {
        return $this->render('hello/index.html.twig', [
            'messages' => $this->messages,
            'limit' => $limit
        ]);
    }

    #[Route('/messages/{id<\d+>}', name: 'app_show_one')]
    public function showOne(int $id): HttpFoundationResponse {
        return $this->render('hello/show_one.html.twig', ['message' => $this->messages[$id]]);
    }
}
