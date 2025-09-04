<?php

namespace App\Controller;

use DateTime;
//use App\Entity\MicroPost;
use App\Repository\MicroPostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class MicroPostController extends AbstractController
{
    #[Route('/micro-post', name: 'app_micro_post')]
    public function index(MicroPostRepository $posts): Response
    {
        // $microPost = new MicroPost();
        // $microPost->setTitle('This comes from the Controller');
        // $microPost->setText('Hi!');
        // $microPost->setCreated(new DateTime());

        $microPost = $posts->find(4);
        $posts->remove($microPost, true);

        // $posts->add($microPost, true);
        // dd($posts->findBy(['title' => 'Welcome to the US!']));

        return $this->render('micro_post/index.html.twig', [
            'controller_name' => 'MicroPostController',
        ]);
    }
}
