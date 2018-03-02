# micro-form

Micro-form is a library to translate Json objects into Html forms. Boostrap forms are used as the default template but can easily add new templates.

### Installation

First you need to install Composer. You may do so by following the instructions at [getcomposer.org](https://getcomposer.org/download/). After that run

> composer require fullstackpe/micro-form

If you prefer you can create a composer.json in your project folder.

```json
{
    "require": {
        "fullstackpe/micro-form": "^1.0"
    }
}
```

#### How it works?

Create an instance of the class micro\form\Builder 

```php 
<?php

$json = '[
    "name",
    "lastname"
]';

$builder = new \micro\form\Builder();
$form = $builder->render($json);
echo $form;
```

The php code will produce the following html form inputs.


```html 
<div class="form-group">
    <label>Name</label>
    <input type="text" class="form-control" name="name" value="marco">
</div>
<div class="form-group">
    <label>Lastname</label>
    <input type="text" class="form-control" name="lastname" value="milon">
</div>
```

It is possible to use more complex Json objects for example

```php 
<?php

$json = '[
    {
        "input": "text",
        "name": "username", 
        "id": "username",
        "placeholder": "Username",
        "label": "Enter username"
    }
]';

$builder = new \micro\form\Builder();
$form = $builder->render($json);
echo $form;
```

The example will output the following html inputs.

```html
<div class="form-group">
    <label for="username">Enter username</label>
    <input type="text" class="form-control" name="username" placeholder="Username" id="username">
</div>
```

Repeaters are supported out of the box for example

```php 
<?php

$json = '[
    {
        "input": "text",
        "name": "username",
        "repeat": true
    }
]';

$builder = new \micro\form\Builder();
$form = $builder->render($json);
echo $form;
```

html output 

```html
<div class="toolbar--add">
    <a href="#" class="toolbar--add__add">Add Item</a>
</div>
<div class="repeater">
    <div class="element">
        <div class="toolbar--delete">
            <a href="#" class="toolbar--delete__delete">Delete Item</a>
        </div>
        <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" name="username[]">
        </div>
    </div>
</div>
```

You can create block with inputs to repeat for example

```php 
<?php

// Json represent a block with id "users" and with two imputs: username and password.
$json = '[
    {
        "users": [
            {
                "input": "text",
                "name": "username"
            },
            {
                "input": "text",
                "name": "password"
            }
        ]
    }
]';

$builder = new \micro\form\Builder();
$form = $builder->render($json);
echo $form;
```

html output

```html
<div class="repeater">
    <div class="element">
        <div class="toolbar--delete" style="display:none">
            <a href="#" class="toolbar__delete">Delete Item</a>
        </div>
        <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" name="users[0][username]">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="text" class="form-control" name="users[0][password]">
        </div>
    </div>
</div>
```

> Please note that in order to the repeater to work you need to add the file micro-form.js to your project.

Micro-form supports default values too. Just send a key value array as the second parameter for the render method, for example

```php 
<?php

$json = '[
    "name",
    "lastname"
]';

$builder = new \micro\form\Builder();
$form = $builder->render($json, ['name' => 'marco', 'lastname' => 'milon']);
echo $form;
```

output

```html
<div class="form-group">
    <label>Name</label>
    <input type="text" class="form-control" name="name" value="marco">
</div>
<div class="form-group">
    <label>Lastname</label>
    <input type="text" class="form-control" name="lastname" value="milon">
</div>
```

### Templates

Templates are easy to add. for now only too types of templates are supported: input-text and textarea. 
To add a template just create a php file as following

#### input-text 

A bootstrap horizontal input text will look like this::

```php
<?php 
    // Template variables
    $for = isset($id) ? " for=\"$id\"" : "";
    $id = isset($id) ? " id=\"$id\"" : "";
    $value = isset($value) ? " value=\"$value\"" : "";
    $placeholder = isset($placeholder) ? " placeholder=\"$placeholder\"" : "";
?>
<div class="form-group row">
    <label<?= $for ?> class="col-sm-2 col-form-label"><?= $label ?></label>
    <div class="col-sm-10">
        <input type="<?= $input ?>" class="form-control" name="<?= $name ?>"<?= $placeholder . $id . $value ?>>
    </div>
</div>
```

#### text-area 

A bootstrap horizontal textarea will look like this:

```php
<?php 
    // Template variables
    $for = isset($id) ? " for=\"$id\"" : "";
    $id = isset($id) ? " id=\"$id\"" : "";
    $value = isset($value) ? $value : "";
    $rows = isset($row) ? $row : '3';
    $placeholder = isset($placeholder) ? " placeholder=\"$placeholder\"" : "";
?>
<div class="form-group row">
    <label<?= $for ?> class="col-sm-2 col-form-label"><?= $label ?></label>
    <div class="col-sm-10">
        <textarea class="form-control"<?= $id ?> rows="<?= $rows ?>" name="<?= $name ?>"><?= $value ?></textarea>
    </div>
</div>
```

#### How to use your custom templates

You only need to pass the path to your custom template as an array to the constructor, for example:

```php
<?php 

$templates = [
    'textarea' => dirname(__FILE__) . '/../../../templates/horizontal/textarea.php'
];


$builder = new \micro\form\Builder($templates);
$form = $builder->render($microForm);
$this->string($form)->isEqualToContentsOfFile($expectedRendering);
```

### Contribution

Feel free to contribute! Just create a new issue or a new pull request.

### License

This library is released under the MIT License.