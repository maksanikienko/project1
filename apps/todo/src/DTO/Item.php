<?php

namespace Manikienko\Todo\DTO; // autoload by psr-4

use DateTimeImmutable;
use DateTimeInterface;
use InvalidArgumentException;
use LogicException;

class Item
{

    const AVAILABLE_STATUSES = ['new', 'in-progress', 'done'];

    protected DateTimeImmutable $createdAt;

    // new Item(...) -> Item::__construct(...)
    public function __construct(
        protected string $id,
        protected string $content,
        protected string $status,
        int $timestamp
    ) {
        $this->createdAt = new DateTimeImmutable(date(DateTimeInterface::ATOM, $timestamp));
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $value): self
    {
        $this->id = $value;

        // used for chaining (chain - цепь)
        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $newStatus): Item /* $this */
    {
        if (!in_array($newStatus, self::AVAILABLE_STATUSES)) {
            $availableStatuses = implode(", ", self::AVAILABLE_STATUSES);
            throw new InvalidArgumentException(
                "Status '$newStatus' cannot be used. Use please one of these: $availableStatuses."
            );
        };

        $this->status = $newStatus;
        return $this;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'timestamp' => $this->createdAt->getTimestamp(),
            'status' => $this->status,
        ];
    }
}
