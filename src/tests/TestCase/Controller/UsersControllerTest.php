<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Test\TestCase\LoginTrait;
use Cake\ORM\TableRegistry;
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
        $this->post('/register', [
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
        $this->post('/register', [
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
        $this->post('/register', [
            'name' => 'Test Name',
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

        $this->post('/profile/1', [
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
     * Test edit method without login
     *
     * @return void
     */
    public function testEditWithoutLogin(): void
    {
        $this->get('/profile/1');

        $this->assertRedirectContains('/login');
    }

    /**
     * Test delete method with non-existing user
     *
     * @return void
     */
    public function testDeleteNonExistingUser(): void
    {
        $this->delete('/users/delete/2');

        $this->assertRedirectEquals(['controller' => 'Users', 'action' => 'login']);
    }

    /**
     * Test delete method with existing user
     *
     * @return void
     */
    public function testDeleteExistingUser(): void
    {
        $this->delete('/users/delete/1');

        $this->assertResponseSuccess();
        $this->assertRedirectEquals(['controller' => 'Users', 'action' => 'login']);
    }

    /**
     * Test login method
     *
     * @return void
     */
    public function testLoginSuccess(): void
    {
        $this->post('/login', [
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
        $this->post('/login', [
            'email' => 'other@example.com',
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
        $this->post('/login', [
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
        $this->get('/logout');

        $this->assertResponseSuccess();
        $this->assertRedirectEquals(['controller' => 'Users', 'action' => 'login']);
        $this->assertSessionNotHasKey('Auth.email');
    }
}
