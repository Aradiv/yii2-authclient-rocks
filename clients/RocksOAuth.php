<?php

namespace aradiv\authclientrocks\clients;

use yii\authclient\OAuth2;

class RocksOAuth extends OAuth2
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