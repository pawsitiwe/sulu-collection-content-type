<?php

declare(strict_types=1);

namespace Pawsitiwe\SuluCollectionContentType\Content\Type;

use Sulu\Bundle\ContentBundle\Content\Types\AbstractContentType;
use Sulu\Bundle\MediaBundle\Entity\MediaInterface;

class SingleCollectionSelection extends AbstractContentType
{
    public function getName(): string
    {
        return 'single_collection_selection';
    }

    public function getTranslationKey(): string
    {
        return 'app.single_collection_selection';
    }

    public function getContentData($data, $locale)
    {
        $collectionId = $data['collection'] ?? null;

        return [
            'collection' => $collectionId
        ];
    }
}
