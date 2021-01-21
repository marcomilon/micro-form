# micro-form

Micro-form is a library to translate any datasource into into html form elements. Only Json Objects can be use as datasources.

### Installation

First you need to install Composer. You may do so by following the instructions at [getcomposer.org](https://getcomposer.org/download/). After that run

> composer require fullstackpe/micro-form

If you prefer you can create a composer.json in your project folder.

```json
{
    "require": {
        "fullstackpe/micro-form": "^3.0"
    }
}
```

### How it works?

Create a `jsform` object.

```
use micro\FormFactory;
$jsonForm = FormFactory::jsonForm();
echo $jsonForm->render($json);
```

then call render to get the form elements. The render method accepts a Json Object.

**Examples**

**Input**

```php 
<?php

$json = '[
    {
        "tag": "input",
        "type": "text",
        "name": "username",
        "class": "form-control"
    }
]';

use micro\FormFactory;
$jsonForm = FormFactory::jsonForm();
echo $jsonForm->render($json);
```

*output*

```html 
<input type="text" name="username" class="form-control">
```

**Textarea**

```php 
<?php

$json = '[
    {
        "tag": "textarea",
        "id": "story",
        "name": "story",
        "rows": "5",
        "cols": "33",
        "value": "It was a dark and stormy night..."
    }
]';

use micro\FormFactory;
$jsonForm = FormFactory::jsonForm();
echo $jsonForm->render($json);
```

*output*

```html
<textarea id="story" name="story" rows="5" cols="33">
It was a dark and stormy night...
</textarea>
```

**Select**

```php 
<?php

$json = '[
    {
        "tag": "select",
        "name": "pets",
        "id": "pet-select",
        "value": [
            {
                "tag": "option",
                "label": "--Please choose an option--",
                "value": ""
            },
            {
                "tag": "option",
                "label": "Dog",
                "value": "dog"
            },
            {
                "tag": "option",
                "label": "Cat",
                "value": "cat"
            }
        ]
    }
]';

use micro\FormFactory;
$jsonForm = FormFactory::jsonForm();
echo $jsonForm->render($json);
```

*output*

```html
<select name="pets" id="pet-select">
    <option value="">--Please choose an option--</option>
    <option value="dog">Dog</option>
    <option value="cat">Cat</option>
</select>
```

### Contribution

Feel free to contribute! Just create a new issue or a new pull request.

### License

This library is released under the MIT License.