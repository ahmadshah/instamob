<?php

namespace spec\Instamob;

use Prophecy\Argument;
use PhpSpec\ObjectBehavior;
use Instamob\Contracts\SessionInterface;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Provider\Instagram as OAuthProvider;

class AuthSpec extends ObjectBehavior
{
    function let(OAuthProvider $provider, StubSession $session)
    {
        $this->beConstructedWith($provider, $session);
    }

    function it_should_authorize(OAuthProvider $provider, StubSession $session, AccessToken $accessToken)
    {
        $authorizationCode = 'foobar-authorization-code';

        $provider->getAccessToken('authorization_code', ['code' => $authorizationCode])->shouldBeCalled()->willReturn($accessToken);

        $accessToken->getToken()->shouldBeCalled()->willReturn($token = 'foo-token');
        $session->put('instamob.oauth_access_token', $token)->shouldBeCalled();

        $this->authorize($authorizationCode)->shouldBeAnInstanceOf($this);
    }

    function it_should_return_access_token(OAuthProvider $provider, StubSession $session, AccessToken $accessToken)
    {
        $authorizationCode = 'foobar-authorization-code';

        $provider->getAccessToken('authorization_code', ['code' => $authorizationCode])->shouldBeCalled()->willReturn($accessToken);

        $accessToken->getToken()->shouldBeCalled()->willReturn($token = 'foo-token');
        $session->put('instamob.oauth_access_token', $token)->shouldBeCalled();

        $this->authorize($authorizationCode);

        $session->get('instamob.oauth_access_token')->shouldBeCalled()->willReturn('foo-token');

        $this->accessToken()->shouldBeEqualTo('foo-token');
    }
}

class StubSession implements SessionInterface
{
    public function put($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get($key)
    {
        return $_SESSION[$key];
    }
}
