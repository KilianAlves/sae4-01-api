<?php

namespace App\Tests\Api\Client;

use App\Entity\Client;
use App\Factory\ClientFactory;
use App\Tests\Support\ApiTester;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Codeception\Util\HttpCode;

class UserPatchCest
{
    protected static function expectedProperties(): array
    {
        return [
            'nom' => 'string',
            'prenom' => 'string',
            'email' => 'string:email',
            'solde' => 'double',
        ];
    }

    public function anonymousUserForbiddenToPatchUser(ApiTester $I): void
    {
        // 1. 'Arrange'
        ClientFactory::createOne();

        // 2. 'Act'
        $I->sendPatch('/api/clients/1');

        // 3. 'Assert'
        $I->seeResponseCodeIs(HttpCode::UNAUTHORIZED);
    }

    public function authenticatedUserForbiddenToPatchOtherUser(ApiTester $I): void
    {
        // 1. 'Arrange'
        /** @var $user Client */
        $user = ClientFactory::createOne()->object();
        ClientFactory::createOne();
        $I->amLoggedInAs($user);

        // 2. 'Act'
        $I->sendPatch('/api/clients/2');

        // 3. 'Assert'
        $I->seeResponseCodeIs(HttpCode::FORBIDDEN);
    }

    public function authenticatedUserCanPatchOwnData(ApiTester $I): void
    {
        // 1. 'Arrange'
        $dataInit = [
            'prenom' => 'lastname1',
            'nom' => 'firstname1',
            'email' => 'login1@email.com',
        ];

        /** @var $user Client */
        $user = ClientFactory::createOne($dataInit)->object();
        $I->amLoggedInAs($user);

        // 2. 'Act'
        $dataPatch = [
            'prenom' => 'lastname2',
            'nom' => 'firstname2',
            'email' => 'login2@email.com',
        ];
        $I->sendPatch('/api/clients/1', $dataPatch);

        // 3. 'Assert'
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(Client::class, '/api/clients/1');
        $I->seeResponseIsAnItem(self::expectedProperties(), $dataPatch);
    }

    public function authenticatedUserCanChangeHisPassword(ApiTester $I): void
    {
        // 1. 'Arrange'
        $dataInit = [
            'email' => 'user1@email.com',
            'password' => 'password',
        ];
        /** @var $user Client */
        $user = ClientFactory::createOne($dataInit)->object();
        $I->amLoggedInAs($user);

        // 2. 'Act'
        $dataPatch = ['password' => 'new password'];
        $I->sendPatch('/api/clients/1', $dataPatch);

        // 3. 'Assert'
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(Client::class, '/api/clients/1');
        $I->seeResponseIsAnItem(self::expectedProperties());

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
        $I->seeResponseCodeIsSuccessful();
        $I->seeInCurrentUrl('/api/docs');
    }

    // Ajouter les deux méthodes qui suivent
    #[DataProvider('invalidDataLeadsToUnprocessableEntityProvider')]
    public function invalidDataLeadsToUnprocessableEntity(ApiTester $I, Example $example): void
    {
        // 1. 'Arrange'
        /** @var $user Client */
        $user = ClientFactory::createOne()->object();
        $I->amLoggedInAs($user);

        // 2. 'Act'
        $dataPut = [
            $example['property'] => $example['value'],
        ];
        $I->sendPut('/api/clients/1', $dataPut);

        // 3. 'Assert'
        $I->seeResponseCodeIs(422);
        $I->seeResponseIsJson();
    }

    protected function invalidDataLeadsToUnprocessableEntityProvider(): array
    {
        return [
            ['property' => 'nom', 'value' => '<&">'],
            ['property' => 'prenom', 'value' => '<&">'],
            ['property' => 'email', 'value' => 'badmail'],
        ];
    }
}
