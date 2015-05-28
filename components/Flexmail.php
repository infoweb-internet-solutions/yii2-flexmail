<?php
use infoweb\flexmail\components;

class Flexmail extends \yii\base\Component
{
    /**
     * The Flexmail API user id
     * @var int
     */
    public $userId;
    
    /**
     * The Flexmail API user token
     * @var string
     */
    public $usertoken;
    
    public function init()
    {
        if (!$this->$userId) {
            throw new Exception('The Flexmail API user id is not set');
        } elseif (!$this->privateKey) {
            throw new Exception('The Flexmail API user token is not set');
        }
        
        parent::init();    
    }    
}