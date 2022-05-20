<?php

declare(strict_types=1);


namespace ClownMeister\BohemiaApi\Dto\Response;

use ClownMeister\BohemiaApi\Entity\Post;

final class PublishedPostsResponseDto
{
    /**
     * @param Post[] $items
     * @param int $page
     * @param int $pageSize
     * @param int $total
     */
    public function __construct(
        private array $items,
        private int $page,
        private int $pageSize,
        private int $total,
    ) {
    }

    /**
     * @return Post[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @return int
     */
    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

}
