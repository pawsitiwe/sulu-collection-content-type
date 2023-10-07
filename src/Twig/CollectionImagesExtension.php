<?php

namespace Pawsitiwe\SuluCollectionContentType\Twig;

use Sulu\Bundle\MediaBundle\Media\Manager\MediaManagerInterface;
use Sulu\Bundle\MediaBundle\Api\Media;
use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class CollectionImagesExtension extends AbstractExtension
{
    private $mediaManager;
    private $requestStack;

    public function __construct(MediaManagerInterface $mediaManager, RequestStack $requestStack)
    {
        $this->mediaManager = $mediaManager;
        $this->requestStack = $requestStack;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('get_images_in_collection', [$this, 'getImagesInCollection']),
        ];
    }

    public function getImagesInCollection($collectionId)
    {
        $collection = $this->mediaManager->getCollectionById($collectionId);

        if (!$collection) {
            return [];
        }

        $images = [];
        foreach ($collection->getMedia() as $mediaEntity) {
            $images[] = $this->convertToApiMedia($mediaEntity);
        }

        return $images;
    }

    private function convertToApiMedia(\Sulu\Bundle\MediaBundle\Entity\Media $mediaEntity)
    {
        $request = $this->requestStack->getCurrentRequest();

        if (!$request) {
            throw new \RuntimeException('No request found.');
        }

        $locale = $request->getLocale();
        $apiMedia = $this->mediaManager->getById($mediaEntity->getId(), $locale);

        return $apiMedia;
    }
}
