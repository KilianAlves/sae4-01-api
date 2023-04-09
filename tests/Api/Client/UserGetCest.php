<?php

namespace App\Tests\Api\Client;

use App\Entity\Client;
use App\Factory\ClientFactory;
use App\Tests\Support\ApiTester;

class UserGetCest
{
    protected static function expectedProperties(): array
    {
        return [
            'prenom' => 'string',
            'nom' => 'string',
            'solde' => 'double'

        ];
    }

    public function anonymousUserGetSimpleUserElement(ApiTester $I): void
    {
        // 1. 'Arrange'
        $data = [
            'email' => 'user1@email.com',
            'nom' => 'firstname1',
            'prenom' => 'lastname1',
        ];
        ClientFactory::createOne($data);

        // 2. 'Act'
        $I->sendGet('/api/clients/1');

        // 3. 'Assert'
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(Client::class, '/api/clients/1');
        $I->seeResponseIsAnItem(self::expectedProperties(), $data);
    }

    public function authenticatedUserGetSimpleUserElementForOthers(ApiTester $I): void
    {
        // 1. 'Arrange'
        $data = [
            'email' => 'user1@email.com',
            'prenom' => 'firstname1',
            'nom' => 'lastname1',

        ];
        /** @var $user Client */
        $user = ClientFactory::createOne()->object();
        ClientFactory::createOne($data);
        $I->amLoggedInAs($user);

        // 2. 'Act'
        $I->sendGet('/api/clients/2');

        // 3. 'Assert'
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(Client::class, '/api/clients/2');
        $I->seeResponseIsAnItem(self::expectedProperties(), $data);
    }
}
