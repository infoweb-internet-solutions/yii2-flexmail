Yii2 Flexmail Wrapper.
==========
Installation
--------------------------

The preferred way to install this extension is through http://getcomposer.org/download/.

Either run

```sh
php composer.phar require infoweb-internet-solutions/yii2-flexmail "dev-master"
```

or add

```json
"infoweb-internet-solutions/yii2-flexmail": "dev-master"
```

to the require section of your `composer.json` file.


Usage
--------------------------
Register the component in `common/config/main.php`
```php
'components' => [
    ...
    'flexmail' => [
        'class' => 'infoweb\flexmail\components\Flexmail',
        'userId' => 'xxxxxx',
        'userToken' => 'xxxxx-xxxxx-xxxxx-xxxxx-xxxxxxxxxx'
    ],
    ...

```