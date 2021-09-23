<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

// use App\Controller\UsersController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\UsersController Test Case
 *
 * @uses \App\Controller\UsersController
 */
class UsersControllerTest extends TestCase
{
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

        $this->assertFlashMessage(__('The user has been saved.'));

        $this->assertRedirect(['controller' => 'Users', 'action' => 'login']);
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

        $this->assertFlashMessage(__('The passwords did not match. Please, try again.'));

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

        $this->assertFlashMessage(__('The user could not be saved. Please, try again.'));

        $this->assertNoRedirect();
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
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
}
