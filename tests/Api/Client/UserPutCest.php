<?php

namespace App\Tests\Api\Client;

use App\Entity\Client;
use App\Factory\ClientFactory;
use App\Tests\Support\ApiTester;
use Codeception\Util\HttpCode;

class UserPutCest
{
    protected static function expectedProperties(): array
    {
        return [
            'id' => 'integer',
            'prenom' => 'string',
            'nom' => 'string',
            'email' => 'string:email',
            'solde' => 'integer',
            'commentaire' => 'string',
            'CP' => 'string',
            'tel' => 'string',
            'ville' => 'string'
        ];
    }

    public function anonymousUserForbiddenToPutUser(ApiTester $I): void
    {
        // 1. 'Arrange'
        ClientFactory::createOne();

        // 2. 'Act'
        $I->sendPut('/api/clients/1');

        // 3. 'Assert'
        $I->seeResponseCodeIs(HttpCode::UNAUTHORIZED);
    }

    public function authenticatedUserForbiddenToPutOtherUser(ApiTester $I): void
    {
        // 1. 'Arrange'
        /** @var $user Client */
        $user = ClientFactory::createOne()->object();
        ClientFactory::createOne();
        $I->amLoggedInAs($user);

        // 2. 'Act'
        $I->sendPut('/api/clients/2');

        // 3. 'Assert'
        $I->seeResponseCodeIs(HttpCode::FORBIDDEN);
    }

    public function authenticatedUserCanPutOwnData(ApiTester $I): void
    {
        // 1. 'Arrange'
        $dataInit = [
            'prenom' => 'lastname1',
            'nom' => 'firstname1',
            'email' => 'user1@email.com',
            'solde' => 6
        ];
        /** @var $user Client */
        $user = ClientFactory::createOne($dataInit)->object();
        $I->amLoggedInAs($user);

        // 2. 'Act'
        $dataPut = [
            'prenom' => 'lastname2',
            'nom' => 'firstname2',
            'email' => 'user2@email.com',
            'solde' => 6
        ];
        $I->sendPut('/api/clients/1', $dataPut);

        // 3. 'Assert'
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(Client::class, '/api/clients/1');
        $I->seeResponseIsAnItem(self::expectedProperties(), $dataPut);
    }

    public function authenticatedUserCanChangeHisPassword(ApiTester $I): void
    {
        // 1. 'Arrange'
        $dataInit = [
            'email' => 'user1@gmail.com',
            'password' => 'password',
        ];
        /** @var $user Client */
        $user = ClientFactory::createOne($dataInit)->object();
        $I->amLoggedInAs($user);

        // 2. 'Act'
        $dataPut = ['password' => 'new password'];
        $I->sendPut('/api/clients/1', $dataPut);

        // 3. 'Assert'
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(Client::class, '/api/clients/1');
        $I->seeResponseIsAnItem(self::expectedProperties());

        // 2. 'Act'
        $I->amOnPage('/logout');
        // Don't check response code since homepage is not configured (404)
        // $I->seeResponseCodeIsSuccessful();
        $I->amOnPage('/login');
        $I->seeResponseCodeIsSuccessful();
        $I->submitForm(
            'form',
            ['login' => 'user1', 'password' => 'new password'],
            'Authentification'
        );

        // 3. 'Assert'
        $I->seeResponseCodeIsSuccessful();
        $I->seeInCurrentUrl('/api/docs');
    }
}
