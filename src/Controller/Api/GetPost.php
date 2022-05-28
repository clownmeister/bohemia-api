<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Controller\Api;

use ClownMeister\BohemiaApi\Controller\AbstractController;
use ClownMeister\BohemiaApi\Exception\BadRequestException;
use ClownMeister\BohemiaApi\Repository\PostRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

final class GetPost extends AbstractController
{
    public function __construct(
        private PostRepository $postRepository,
        private SerializerInterface $serializer
    ) {
    }

    #[Route('/post', name: 'api_post_get', methods: ['GET'])]
    public function index(Request $request): Response
    {
        try {
            $data = $this->validateSchema($request->getContent(), __DIR__ . '/schema/post/get_post.json');
        } catch (BadRequestException $e) {
            return new JsonResponse(['status' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        $slug = $data['slug'];

        $post = $this->postRepository->findBy(['slug' => $slug], limit: 1);

        if (is_bool($post) || count($post) === 0) {
            return new JsonResponse(['status' => Response::$statusTexts[Response::HTTP_NOT_FOUND]], Response::HTTP_NOT_FOUND);
        }

        return new Response(
            $this->serializer->serialize(
                $post[0],
                self::ENCODE_TYPE_JSON,
                ['groups' => ['post', 'user_short']]
            ),
            Response::HTTP_OK,
            [self::HEADER_CONTENT_TYPE => self::CONTENT_TYPE_APPLICATION_JSON]
        );
    }
}
