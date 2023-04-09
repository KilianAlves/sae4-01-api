<?php

namespace App\Tests\Api\Client;

use App\Entity\Client;
use App\Factory\ClientFactory;
use App\Tests\Support\ApiTester;
use Codeception\Util\HttpCode;

class UserGetMeCest
{
    protected static function expectedProperties(): array
    {
        return [
            'prenom' => 'string',
            'nom' => 'string',
            'email' => 'string:email',
            'solde' => 'double'

        ];
    }

    public function anonymousMeIsUnauthorized(ApiTester $I): void
    {
        // 1. 'Arrange'
        ClientFactory::createOne();

        // 2. 'Act'
        $I->sendGet('/api/me');

        // 3. 'Assert'
        $I->seeResponseCodeIs(HttpCode::UNAUTHORIZED);
    }

    public function authenticatedUserOnMeGetData(ApiTester $I): void
    {
        // 1. 'Arrange'
        /** @var $user Client */
        $user = ClientFactory::createOne()->object();
        ClientFactory::createOne();
        $I->amLoggedInAs($user);

        // 2. 'Act'
        $I->sendGet('/api/me');

        // 3. 'Assert'
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(Client::class, '/api/me');
        $I->seeResponseIsAnItem(self::expectedProperties(), ['login' => $user->getLogin()]);
    }
}
