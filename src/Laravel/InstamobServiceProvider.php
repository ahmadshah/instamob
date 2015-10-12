<?php

namespace Instamob\Laravel;

use Instamob\Auth;
use Instamob\Gateway;
use Instamob\Services\User;
use Illuminate\Support\ServiceProvider;
use League\OAuth2\Client\Provider\Instagram as OAuthProvider;

class InstamobServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerAuth();
        $this->registerGateway();
    }

    protected function registerAuth()
    {
        $this->app->bindShared('instamob.auth', function ($app) {
            $credentials = $app->make('config')->get('services.instagram', []);
            $oauth = new OAuthProvider($credentials);

            return new Auth($oauth, $app->make('session.store'));
        });
    }

    protected function registerGateway()
    {
        $this->app->bindShared('instamob', function ($app) {
            $auth = $app->make('instamob.auth');

            $user = new User($auth);

            return new Gateway($user);
        });
    }
}
