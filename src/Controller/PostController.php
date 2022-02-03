<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/news", name="news_")
 * */
class PostController extends AbstractController
{
    /**
     * @Route("/", name="post")
     */
    public function index(PostRepository $postRepository): Response
    {
        //List all posts ordered by descending order (from latest to oldest)
        $posts = $postRepository->findBy([],['created_at' => 'desc']);
        //List all posts
        //$posts = $postRepository->findAll();
        // dd($posts);

        return $this->render('post/index.html.twig', [
            'posts' => $posts,
        ]);
    }
}
