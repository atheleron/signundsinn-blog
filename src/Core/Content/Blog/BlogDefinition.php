<?php declare(strict_types=1);

namespace SignundsinnBlog\Core\Content\Blog;

use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\BoolField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\DateTimeField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\ApiAware;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\LongTextField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\System\User\UserDefinition;

class BlogDefinition extends EntityDefinition
{
    public const ENTITY_NAME = 'sig_blog_posts';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getEntityClass(): string
    {
        return BlogEntity::class;
    }

    public function getCollectionClass(): string
    {
        return BlogCollection::class;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new IdField('id', 'id'))->addFlags(new Required(), new PrimaryKey(), new ApiAware()),
            (new StringField('title', 'title'))->addFlags(new Required(), new ApiAware()),
            (new LongTextField('content', 'content'))->addFlags(new Required(), new ApiAware()),
            (new BoolField('status', 'status'))->addFlags(new ApiAware()),
            (new FkField('author_id', 'authorId', UserDefinition::class))->addFlags(new Required(), new ApiAware()),
            (new DateTimeField('published_at', 'publishedAt'))->addFlags(new ApiAware()),

            (new ManyToOneAssociationField('author', 'author_id', UserDefinition::class, 'id', false))
        ]);
    }
}