<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Test\TestCase\LoginTrait;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\CollectionsController Test Case
 *
 * @uses \App\Controller\CollectionsController
 */
class CollectionsControllerTest extends TestCase
{
    use LoginTrait;
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Collections',
        'app.Elements',
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

        $this->Collections = TableRegistry::get('Collections');
        $this->Users = TableRegistry::get('Users');
    }

    /**
     * Test index method authenticated
     *
     * @return void
     */
    public function testIndexSuccess(): void
    {
        $this->login();

        $this->get('/');

        $this->assertResponseOk();
        $this->assertCount(2, $this->viewVariable('collections'));
    }

    /**
     * Test index method unauthenticated
     *
     * @return void
     */
    public function testIndexUnauthenticatedFails(): void
    {
        $this->get('/');
        $this->assertResponseCode(302);
        $this->assertRedirectEquals(['controller' => 'Users', 'action' => 'login']);
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testViewSuccess(): void
    {
        $this->login();

        $this->get('/1/view');

        $this->assertResponseOk();
        $this->assertSame(1, $this->viewVariable('collection')->id);
        $this->assertCount(1, $this->viewVariable('collection')->elements);
    }

    /**
     * Test view method unauthenticated
     *
     * @return void
     */
    public function testViewUnauthenticatedFails(): void
    {
        $this->get('/1/view');

        $this->assertResponseCode(302);
        $this->assertRedirectEquals(['controller' => 'Users', 'action' => 'login']);
        $this->assertTrue($this->Collections->exists(['id' => 1]));
    }

    /**
     * Test view method unauthorized fails
     *
     * @return void
     */
    public function testViewUnauthorizedFails(): void
    {
        $this->login();

        $this->get('/3/view');

        $this->assertResponseCode(403);
        $this->assertTrue($this->Collections->exists(['id' => 3]));
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAddSuccess(): void
    {
        $this->login();

        $this->post('/collections/add', [
            'name' => 'test name',
            'description' => 'test description',
            'goal' => '20',
            'image' => '',
        ]);

        $this->assertResponseSuccess();
        $this->assertFlashMessage(__('The collection has been saved.'));
        $this->assertRedirect('/');

        $collections = $this->Collections->find()->where(['user_id' => 1])->all();

        $this->assertEquals(3, count($collections));
    }

    /**
     * Test add method unauthenticated
     *
     * @return void
     */
    public function testAddUnauthenticatedFails(): void
    {
        $this->post('/collections/add', [
            'name' => 'test name',
            'description' => 'test description',
            'goal' => '20',
            'image' => '',
        ]);

        $this->assertResponseCode(302);
        $this->assertRedirectEquals(['controller' => 'Users', 'action' => 'login']);

        $collections = $this->Collections->find()->all();

        $this->assertEquals(3, count($collections));
    }

    /**
     * Test add method with validation error
     *
     * @return void
     */
    public function testAddValidationError(): void
    {
        $this->login();

        $this->post('/collections/add', [
            'name' => '',
            'description' => 'test description',
            'goal' => '10',
            'image' => '',
        ]);

        $this->assertFlashMessage(__('The collection could not be saved. Please, try again.'));
        $this->assertNoRedirect();

        $collections = $this->Collections->find()->all();

        $this->assertEquals(3, count($collections));
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEditSuccess(): void
    {
        $this->login();

        $this->post('/1/edit', [
            'name' => 'other name',
            'description' => 'test description',
            'goal' => '20',
            'image' => '',
        ]);

        $this->assertResponseSuccess();
        $this->assertFlashMessage(__('The collection has been saved.'));
        $this->assertRedirect('/');

        $collection = $this->Collections->find()->where(['id' => 1])->first();

        $this->assertEquals('other name', $collection->name);
    }

    /**
     * Test edit method unauthenticated
     *
     * @return void
     */
    public function testEditUnauthenticatedFails(): void
    {
        $this->post('/1/edit', [
            'name' => 'other name',
            'description' => 'test description',
            'goal' => '20',
            'image' => '',
        ]);

        $this->assertResponseCode(302);
        $this->assertRedirectEquals(['controller' => 'Users', 'action' => 'login']);

        $collection = $this->Collections->find()->where(['id' => 1])->first();

        $this->assertNotEquals('other name', $collection->name);
    }

    /**
     * Test edit method unauthorized
     *
     * @return void
     */
    public function testEditUnauthorizedFails(): void
    {
        $this->login();

        $this->post('/3/edit', [
            'name' => 'other name',
            'description' => 'test description',
            'goal' => '20',
            'image' => '',
        ]);

        $this->assertResponseCode(403);
        $this->assertNoRedirect();

        $collection = $this->Collections->find()->where(['id' => 1])->first();

        $this->assertNotEquals('other name', $collection->name);
    }

    /**
     * Test edit method with validation error
     *
     * @return void
     */
    public function testEditValidationError(): void
    {
        $this->login();

        $this->post('/1/edit', [
            'name' => '',
            'description' => 'test description',
            'goal' => '10',
            'image' => '',
        ]);

        $this->assertFlashMessage(__('The collection could not be saved. Please, try again.'));
        $this->assertNoRedirect();

        $collection = $this->Collections->find()->where(['id' => 1])->first();

        $this->assertNotEquals('', $collection->name);
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDeleteSuccess(): void
    {
        $this->login();

        $this->post('/1/delete');

        $this->assertRedirect('/');
        $this->assertFalse($this->Collections->exists(['id' => 1]));
    }

    /**
     * Test delete method unauthenticated
     *
     * @return void
     */
    public function testDeleteUnauthenticatedFails(): void
    {
        $this->post('/1/delete');

        $this->assertResponseCode(302);
        $this->assertRedirectEquals(['controller' => 'Users', 'action' => 'login']);
        $this->assertTrue($this->Collections->exists(['id' => 1]));
    }

    /**
     * Test delete method unauthorized
     *
     * @return void
     */
    public function testDeleteUnauthorizedFails(): void
    {
        $this->login();

        $this->post('/3/delete');

        $this->assertResponseCode(403);
        $this->assertNoRedirect();
        $this->assertTrue($this->Collections->exists(['id' => 3]));
    }
}
