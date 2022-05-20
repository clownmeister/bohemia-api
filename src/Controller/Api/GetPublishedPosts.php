<?php

declare(strict_types=1);


namespace ClownMeister\BohemiaApi\Controller\Api;

use ClownMeister\BohemiaApi\Controller\AbstractController;
use ClownMeister\BohemiaApi\Dto\Response\PublishedPostsResponseDto;
use ClownMeister\BohemiaApi\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

final class GetPublishedPosts extends AbstractController
{
    public function __construct(
        private PostRepository $postRepository,
        private SerializerInterface $serializer
    ) {
    }

    #[Route('/post', name: 'api_post_list', methods: ['GET'])]
    public function index(Request $request): Response
    {
        $data = $this->validateSchema($request->getContent(), __DIR__ . '/schema/post/get_posts.json');

        $page = (int)$data['page'];
        $limit = (int)$data['pageSize'];
        $offset = $page * $limit;

        //TODO: Encode html to reduce size but what format. Base64 didn't perform.
        $posts = $this->postRepository->findBy([
            'published' => 1,
            'archived' => 0,
            'deleted' => 0
        ],
            ['createdAt' => 'desc'],
            $limit,
            $offset
        );

        return new Response(
            $this->serializer->serialize(new PublishedPostsResponseDto(
                $posts,
                $page,
                $limit,
                count($posts)
            ), self::ENCODE_TYPE_JSON, ['groups' => ['post', 'user_short']]),
            Response::HTTP_OK,
            [self::HEADER_CONTENT_TYPE => self::CONTENT_TYPE_APPLICATION_JSON]
        );
    }
}
