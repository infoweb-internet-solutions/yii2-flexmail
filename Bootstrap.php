<?php
namespace infoweb\flexmail;

use Yii;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        if ($app->hasModule('flexmail') && ($module = $app->getModule('flexmail')) instanceof Module) {            
            // Register the flexmail component
            Yii::$app->set('flexmail', [
                'class' => 'infoweb\flexmail\components\Flexmail',
                'userId' => $module->userId,
                'userToken' => $module->userToken
            ]);
        }
    }
}