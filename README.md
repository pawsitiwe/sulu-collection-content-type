# Sulu Collection Field Extensions

## Installation

```bash
composer require pawsitiwe/sulu-collection-content-type
```

## Setup

### Service Registration

The twig extension need to be registered as [symfony service](http://symfony.com/doc/current/service_container.html).

```yml
services:
    Pawsitiwe\SuluCollectionContentType\Twig\CollectionImagesExtension: ~
```

If autoconfigure is not active you need to tag it with [twig.extension](https://symfony.com/doc/current/service_container.html#the-autoconfigure-option).

## Usage

#### Use content type

To use the collection content type, use the following code.

```xml
<property name="collection" type="single_collection_selection">
    <meta>
        <title lang="en">Collection</title>
        <title lang="de">Ordner</title>
    </meta>
</property>
```

#### Get images of collection

To get all images of a collection, use the following code.

```twig
{% set images = get_images_in_collection(content.collection.id) %}

{% for image in images %}
    <img src="{{ image.thumbnails['sulu-400x400'] }}" alt="{{ image.title }}" title="{{ image.description|default(image.title) }}">
{% endfor %}
```
