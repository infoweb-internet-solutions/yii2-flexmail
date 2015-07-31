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
    public $options = [];

    public function init()
    {
        parent::init();

        $options['target'] = 'iframe_flxml_submit';
    }
    
    public function run()
    {

        return $this->render('subscribe', [
            'publicKeys' => $this->publicKeys,
            'mailingLists' => $this->mailingLists,
            'template' => $this->template,
            'options' => $this->options,
        ]);
    }
}
