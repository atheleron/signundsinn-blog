<?php declare(strict_types=1);

namespace SignundsinnBlog\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1697459845InitialStructure extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1697459845;
    }

    public function update(Connection $connection): void
    {
        $query = <<<SQL
            CREATE TABLE IF NOT EXISTS `sig_blog_posts` (
                `id` BINARY(16) NOT NULL,
                `title` VARCHAR(255) NOT NULL,
                `content` LONGTEXT NOT NULL,
                `status` BOOLEAN DEFAULT 0,
                `author_id` BINARY(16) NOT NULL,
                `published_at` DATETIME NULL,
                `created_at` DATETIME NOT NULL,
                `updated_at` DATETIME,
                PRIMARY KEY (id),
                CONSTRAINT `fk.sig_blog_posts.author_id` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
            ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci
        SQL;

        $connection->executeStatement($query);
    }

    public function updateDestructive(Connection $connection): void
    {
        // implement update destructive
    }
}
