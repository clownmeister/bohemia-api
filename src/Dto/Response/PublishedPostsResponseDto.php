<?php

declare(strict_types=1);

namespace ClownMeister\BohemiaApi\Dto\Response;

use ClownMeister\BohemiaApi\Entity\Post;
use Symfony\Component\Serializer\Annotation\Groups;

final class PublishedPostsResponseDto
{
    /**
     * @param Post[] $items
     */
    public function __construct(private array $items, private int $page, private int $pageSize, private int $total)
    {
    }

    /**
     * @return Post[]
     * @Groups("post")
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @Groups("post")
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @Groups("post")
     */
    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    /**
     * @Groups("post")
     */
    public function getTotal(): int
    {
        return $this->total;
    }
}
