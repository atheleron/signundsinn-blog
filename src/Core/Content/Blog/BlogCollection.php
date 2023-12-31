<?php declare(strict_types=1);

namespace SignundsinnBlog\Core\Content\Blog;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @method void             add(BlogEntity $entity)
 * @method void             set(string $key, BlogEntity $entity)
 * @method BlogEntity[]     getIterator()
 * @method BlogEntity[]     getElements()
 * @method BlogEntity|null  get(string $key)
 * @method BlogEntity|null  first()
 * @method BlogEntity|null  last()
 */
class BlogCollection extends EntityCollection
{
    public function getApiAlias(): string
    {
        return 'sig_blog_posts_collection';
    }

    protected function getExpectedClass(): string
    {
        return BlogEntity::class;
    }
}