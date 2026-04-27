<?php

namespace AnpiGabon\SSO;

use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

class ANPIProvider extends AbstractProvider implements ProviderInterface
{
    protected $scopes = ['profile', 'email'];

    protected $scopeSeparator = ' ';

    protected function getBaseUri(): string
    {
        return rtrim(config('services.anpi.base_uri', 'https://investingabon.ga'), '/');
    }

    protected function getAuthUrl($state): string
    {
        return $this->buildAuthUrlFromBase(
            $this->getBaseUri() . '/oauth/authorize',
            $state
        );
    }

    protected function getTokenUrl(): string
    {
        return $this->getBaseUri() . '/oauth/token';
    }

    protected function getUserByToken($token): array
    {
        $response = $this->getHttpClient()->get(
            $this->getBaseUri() . '/oauth/userinfo',
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept'        => 'application/json',
                ],
            ]
        );

        return json_decode((string) $response->getBody(), true);
    }

    protected function mapUserToObject(array $user): User
    {
        return (new User)->setRaw($user)->map([
            'id'       => $user['sub'] ?? null,
            'name'     => $user['name'] ?? null,
            'email'    => $user['email'] ?? null,
            'avatar'   => $user['picture'] ?? null,
            'nickname' => null,
        ]);
    }

    /**
     * Génère l'URL de déconnexion du serveur SSO avec redirection.
     */
    public function getLogoutUrl(string $redirectTo): string
    {
        return $this->getBaseUri() . '/logout?redirect_to=' . urlencode($redirectTo);
    }
}
