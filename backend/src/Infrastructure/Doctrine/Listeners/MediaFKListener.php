<?php

namespace App\Infrastructure\Doctrine\Listeners;

use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Tools\Event\GenerateSchemaEventArgs;

#[AsDoctrineListener(event: 'postGenerateSchema')]
class MediaFKListener
{
    public function postGenerateSchema(GenerateSchemaEventArgs $eventArgs): void
    {
        $eventArgs
            ->getSchema()
            ->getTable('expense_attachment')
            ->addForeignKeyConstraint(
                'media',
                ['media_ref_key'],
                ['id'],
                ['onDelete' => 'RESTRICT'],
                'fk_expense_attachment_file',
            );
    }
}
