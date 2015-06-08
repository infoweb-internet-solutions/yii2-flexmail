<?php
namespace infoweb\flexmail\widgets;

use Yii;
use yii\bootstrap\Widget;
use infoweb\news\models\News as NewsItem;

class FlexmailSubscribe extends Widget
{
    public $template = '_fields';
    public $publicKeys = '';
    public $mailingLists = [];

    public function init()
    {
        parent::init();
    }
    
    public function run()
    {

        return $this->render('subscribe', [
            'publicKeys' => $this->publicKeys,
            'mailingLists' => $this->mailingLists,
            'template' => $this->template,
        ]);
    }
}
