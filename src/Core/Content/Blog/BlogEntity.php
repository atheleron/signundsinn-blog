<?php declare(strict_types=1);

namespace SignundsinnBlog\Core\Content\Blog;

use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityCustomFieldsTrait;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;
use Shopware\Core\System\User\UserEntity;

class BlogEntity extends Entity
{
    use EntityIdTrait;
    use EntityCustomFieldsTrait;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var bool
     */
    protected $status = false;

    protected UserEntity $author;

    /**
     * @var \DateTimeInterface|null
     */
    protected $publishedAt;


    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }

    public function getAuthor(): UserEntity
    {
        return $this->author;
    }

    public function setAuthor(UserEntity $author): void
    {
        $this->author = $author;
    }

    public function getAuthorFullName(): ?string
    {
        return $this->getAuthor()->getFirstName() . ' ' . $this->getAuthor()->getLastName();
    }

    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(\DateTimeInterface $publishedAt): void
    {
        $this->publishedAt = $publishedAt;
    }

}