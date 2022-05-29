<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Controller\Api;

use ClownMeister\BohemiaApi\Controller\AbstractController;
use ClownMeister\BohemiaApi\Repository\PostRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Uid\Ulid;

final class GetPostById extends AbstractController
{
    public function __construct(
        private PostRepository $postRepository,
        private SerializerInterface $serializer
    ) {
    }

    #[Route('/post/{id}', name: 'api_post_get_by_id', methods: ['GET'])]
    public function index(string $id): Response
    {
        if (!Ulid::isValid($id)) {
            return new JsonResponse(['status' => 'INVALID_UUID'], Response::HTTP_BAD_REQUEST);
        }

        $post = $this->postRepository->findBy(['id' => $id], limit: 1);

        if (count($post) === 0) {
            return new JsonResponse(
                ['status' => Response::$statusTexts[Response::HTTP_NOT_FOUND]],
                Response::HTTP_NOT_FOUND
            );
        }

        return new Response(
            $this->serializer->serialize(
                $post[0],
                self::ENCODE_TYPE_JSON,
                ['groups' => ['post', 'user_short', 'post_category']]
            ),
            Response::HTTP_OK,
            [self::HEADER_CONTENT_TYPE => self::CONTENT_TYPE_APPLICATION_JSON]
        );
    }
}