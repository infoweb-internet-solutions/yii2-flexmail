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
Register the module in `common/config/main.php`
```php
'modules' => [
    ...
    'flexmail' => [
        'class' => 'infoweb\flexmail\Module',
        'userId' => 'xxxxxx',
        'userToken' => 'xxxxx-xxxxx-xxxxx-xxxxx-xxxxxxxxxx'
    ],
    ...

```
This will automatically register the `infoweb\flexmail\components\Flexmail` component that can be used to communicate with your **Flexmail** account. Below is an example of how to create a contact in **Flexmail** by using the **Contact** service:
```php
Yii::$app->flexmail->service('Contact')->create([
    'mailingListId'     => xxxxxx,
    'emailAddressType'  => [
        'emailAddress'  => 'example@email.com',
        'name'          => 'John',
        'surname'       => 'Doe',
        'company'       => 'Infoweb'
    ]
]);
```
