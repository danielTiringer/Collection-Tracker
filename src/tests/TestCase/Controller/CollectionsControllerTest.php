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
     * Test add method successfully
     *
     * @return void
     */
    public function testAddSuccess(): void
    {
        $this->login();

        $this->post('collections/add', [
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
}
