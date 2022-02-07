<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Test\TestCase\LoginTrait;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\Fixture\FixtureStrategyInterface;
use Cake\TestSuite\Fixture\TransactionStrategy;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\UsersController Test Case
 *
 * @uses \App\Controller\UsersController
 */
class UsersControllerTest extends TestCase
{
    use LoginTrait;
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Users',
    ];

    /**
     * Create the fixtures strategy used for this test case.
     * You can use a base class/trait to change multiple classes.
     */
    protected function getFixtureStrategy(): FixtureStrategyInterface
    {
        return new TransactionStrategy();
    }

    /**
     * Sets up the tests with common configuration
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->enableCsrfToken();

        $this->enableRetainFlashMessages();

        $this->Users = TableRegistry::get('Users');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd(): void
    {
        $this->post('/users/register', [
            'name' => 'Test Name',
            'email' => 'user@example.com',
            'password' => 'testpassword',
            'password_confirm' => 'testpassword',
        ]);

        $this->assertResponseSuccess();
        $this->assertFlashMessage(__('Registration was successful.'));
        $this->assertRedirect('/');
    }

    /**
     * Test add method when passwords don't match
     *
     * @return void
     */
    public function testAddWhenPasswordsDontMatch(): void
    {
        $this->post('/users/register', [
            'name' => 'Test Name',
            'email' => 'user@example.com',
            'password' => 'testpassword',
            'password_confirm' => 'anotherpassword',
        ]);

        $this->assertFlashMessage(__('Registration was not successful. Please, try again.'));
        $this->assertNoRedirect();
    }

    /**
     * Test add method when user already exists
     *
     * @return void
     */
    public function testAddWhileUserExists(): void
    {
        $this->post('/users/register', [
            'name' => 'Existing User',
            'email' => 'test@example.com',
            'password' => 'testpassword',
            'password_confirm' => 'testpassword',
        ]);

        $this->assertFlashMessage(__('Registration was not successful. Please, try again.'));
        $this->assertNoRedirect();
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEditSuccess(): void
    {
        $this->login();

        $this->post('/users/1/edit', [
            'name' => 'Updated User',
            'email' => 'updated@example.com',
        ]);

        $this->assertRedirect('/');
        $this->assertFlashMessage(__('The user has been saved.'));

        $user = $this->Users->get(1);

        $this->assertEquals('Updated User', $user->name);
        $this->assertEquals('updated@example.com', $user->email);
    }

    /**
     * Test edit method unauthorized
     *
     * @return void
     */
    public function testEditUnauthorizedFails(): void
    {
        $this->login();

        $this->post('/users/2/edit', [
            'name' => 'Updated User',
            'email' => 'updated@example.com',
        ]);

        $this->assertResponseCode(403);
        $this->assertNoRedirect();

        $user = $this->Users->get(2);

        $this->assertNotEquals('Updated User', $user->name);
        $this->assertNotEquals('updated@example.com', $user->email);
    }

    /**
     * Test edit method without login
     *
     * @return void
     */
    public function testEditWithoutLogin(): void
    {
        $this->get('/users/1/edit');

        $this->assertRedirectContains('/users/login');
    }

    /**
     * Test update password method
     *
     * @return void
     */
    public function testUpdatePasswordSuccess(): void
    {
        $this->login();

        $this->post('/users/1/password', [
            'current_password' => 'password',
            'password' => 'newpassword',
            'password_confirm' => 'newpassword',
        ]);

        $this->assertRedirect('/');
        $this->assertFlashMessage(__('The password has been updated.'));
    }

    /**
     * Test update password method unauthorized
     *
     * @return void
     */
    public function testUpdatePasswordUnauthorized(): void
    {
        $this->login();

        $this->post('/users/2/password', [
            'current_password' => 'password',
            'password' => 'newpassword',
            'password_confirm' => 'newpassword',
        ]);

        $this->assertResponseCode(403);
        $this->assertNoRedirect();
    }

    /**
     * Test update password method with current password missing
     *
     * @return void
     */
    public function testUpdatePasswordCurrentPasswordMissing(): void
    {
        $this->login();

        $this->post('/users/1/password', [
            'password' => 'newpassword',
            'password_confirm' => 'newpassword',
        ]);

        $this->assertFlashMessage(__('The password could not be updated. Please, try again.'));
        $this->assertRedirect(['controller' => 'Users', 'action' => 'edit', 1]);
    }

    /**
     * Test update password method with passwords not matching
     *
     * @return void
     */
    public function testUpdatePasswordPasswordsDontMatch(): void
    {
        $this->login();

        $this->post('/users/1/password', [
            'current_password' => 'password',
            'password' => 'newpassword',
            'password_confirm' => 'wrongpassword',
        ]);

        $this->assertFlashMessage(__('The password could not be updated. Please, try again.'));
        $this->assertRedirect(['controller' => 'Users', 'action' => 'edit', 1]);
    }

    /**
     * Test delete method with non-existing user
     *
     * @return void
     */
    public function testDeleteUserUnauthorized(): void
    {
        $this->delete('/users/2/delete');

        $this->assertRedirectEquals(['controller' => 'Users', 'action' => 'login']);
    }

    /**
     * Test delete method with existing user
     *
     * @return void
     */
    public function testDeleteExistingUser(): void
    {
        $this->login();

        $this->delete('/users/1/delete');

        $this->assertResponseSuccess();
        $this->assertRedirect(['controller' => 'Users', 'action' => 'login']);
    }

    /**
     * Test login method
     *
     * @return void
     */
    public function testLoginSuccess(): void
    {
        $this->post('/users/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $this->assertRedirect('/');
        $this->assertSession('test@example.com', 'Auth.email');
    }

    /**
     * Test login method with invalid email address
     *
     * @return void
     */
    public function testLoginWithInvalidEmailAddress(): void
    {
        $this->post('/users/login', [
            'email' => 'nonexistent@example.com',
            'password' => 'somepassword',
        ]);

        $this->assertFlashMessage(__('Invalid email or password.'));
        $this->assertNoRedirect();
    }

    /**
     * Test login method with invalid password
     *
     * @return void
     */
    public function testLoginWithInvalidPassword(): void
    {
        $this->post('/users/login', [
            'email' => 'test@example.com',
            'password' => 'wrongpassword',
        ]);

        $this->assertFlashMessage(__('Invalid email or password.'));
        $this->assertNoRedirect();
    }

    /**
     * Test logout method
     *
     * @return void
     */
    public function testLogoutSuccess(): void
    {
        $this->get('/users/logout');

        $this->assertResponseSuccess();
        $this->assertRedirectEquals(['controller' => 'Users', 'action' => 'login']);
        $this->assertSessionNotHasKey('Auth.email');
    }
}
