<?php

namespace infoweb\flexmail;

use Yii;

class Module extends \yii\base\Module
{
    /**
     * The Flexmail API user id
     * @var int
     */
    public $userId = null;
    
    /**
     * The Flexmail API user token
     * @var string
     */
    public $userToken = null;
    
    public function init()
    {
        parent::init();

        Yii::configure($this, require(__DIR__ . '/config.php'));
    }
}