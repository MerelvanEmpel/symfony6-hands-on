<?php
namespace App\Controller;

use DateTime;
use App\Entity\User;
use App\Entity\Comment;
use App\Entity\MicroPost;
use App\Entity\UserProfile;
use App\Repository\CommentRepository;
use App\Repository\MicroPostRepository;
use App\Repository\UserProfileRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class HelloController extends AbstractController {
    private array $messages = [
        ['message' => 'Hello', 'created' => '2025/08/12'], // Must be within the last three months
        ['message' => 'Hi', 'created' => '2025/06/12'], // Must be within the last three months
        ['message' => 'Bye!', 'created' => '2021/05/12'] // Must be at least a year ago
    ];

    #[Route('/', name: 'app_index')]
    public function index(MicroPostRepository $posts, UserProfileRepository $profiles, CommentRepository $comments): HttpFoundationResponse {
        // $post = new MicroPost();
        // $post->setTitle('Hello');
        // $post->setText('Hello');
        // $post->setCreated(new DateTime());

        // $post = $posts->find(16);
        // $comment = $post->getComments()[0];
        // $post->removeComment($comment);
        // $posts->add($post, true);

        // dd($post);

        // $comment = new Comment();
        // $comment->setText('Hello');
        // $comment->setPost($post);
        // // $post->addComment($comment);
        // // $posts->add($post, true);
        // $comments->add($comment, true);

        // $user = new User();
        // $user->setEmail('email@email.com');
        // $user->setPassword('12345678');

        // $profile = new UserProfile();
        // $profile->setUser($user);
        // $profiles->add($profile, true);

        // $profile = $profiles->find(1);
        // $profiles->remove($profile, true);

        return $this->render('hello/index.html.twig', [
            'messages' => $this->messages,
            'limit' => 3
        ]);
    }

    #[Route('/messages/{id<\d+>}', name: 'app_show_one')]
    public function showOne(int $id): HttpFoundationResponse {
        return $this->render('hello/show_one.html.twig', ['message' => $this->messages[$id]]);
    }
}
