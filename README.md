# Attribute installer for shopware 5

This package provides a attribute install command based on a yaml config.
This is intended to work with the composer skeleton of shopware 5

## Installation

Install the package:

```bash
$ composer require avarel/sw-attribute-installer
```

Enable it in your ./app/services.xml:

````xml
<imports>
    <import resource="../vendor/avarel/sw-attribute-installer/src/Resources/services.xml"/>
</imports>
````

## Setup

Define a YAML file anywhere you want.

Configure your fields:

```yaml
attributes:
    s_articles_attributes:
        recommended_retail_price:
            type: 'float'
            label: 'UVP'
            displayInBackend: true
        rating_image:
            type: 'single_selection'
            label: 'Image'
            displayInBackend: true
            entity: 'Shopware\Models\Media\Media'
    s_categories_attributes:
        is_bold:
            type: 'boolean'
            label: 'Kategoriename fettgeschrieben darstellen?'
            displayInBackend: true

```

## Execute the command

Use this command to install the attributes

```bash
$ php ./bin/console avarel:attributes:install /path/to/attributes.yml
```