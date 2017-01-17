<?php

namespace aradiv\authclient\rocks;

use yii\authclient\OAuth2;

class Client extends OAuth2
{
	    /**
     * @inheritdoc
     */
    public $authUrl = 'https://enlightened.rocks/oauth/authorize';
    /**
     * @inheritdoc
     */
    public $tokenUrl = 'https://enlightened.rocks/oauth/token';
    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'https://enlightened.rocks/api/1.0/';

    public function __construct($config=[]){
        if(!isset($config['css']) || $config['css']===true) {
            \Yii::setAlias('@aradiv\authclient\rocks\assets', __DIR__ . "/assets");
            RocksAsset::register(\Yii::$app->view);
        }
        parent::__construct($config);
    }
	public function init()
    {
        parent::init();
        if ($this->scope === null) {
            $this->scope = implode(' ', [
                'userinfo',
            ]);
        }
    }
    protected function defaultName()
    {
        return 'rocks';
    }

    protected function defaultTitle()
    {
        return 'enl.rocks';
    }

    protected function defaultViewOptions()
    {
        return [
            'popupWidth' => 800,
            'popupHeight' => 500,
        ];
    }
	protected function initUserAttributes()
    {
        return $this->api('userinfo', 'GET');
    }
}