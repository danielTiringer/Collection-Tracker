<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Test\TestCase\LoginTrait;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\ElementsController Test Case
 *
 * @uses \App\Controller\ElementsController
 */
class ElementsControllerTest extends TestCase
{
    use LoginTrait;
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Elements',
        'app.Collections',
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

        $this->Elements = TableRegistry::get('Elements');
        $this->Users = TableRegistry::get('Users');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testViewSuccess(): void
    {
        $this->login();

        $this->get('/1/elements/1');

        $this->assertResponseOk();
        $this->assertSame(1, $this->viewVariable('element')->id);
        $this->assertSame(1, $this->viewVariable('element')->collection_id);
    }

    /**
     * Test view method unauthenticated
     *
     * @return void
     */
    public function testViewUnauthenticatedFails(): void
    {
        $this->get('/1/elements/1');

        $this->assertResponseCode(302);
        $this->assertRedirectEquals(['controller' => 'Users', 'action' => 'login']);
        $this->assertTrue($this->Elements->exists(['id' => 1]));
    }

    /**
     * Test view method unauthorized fails
     *
     * @return void
     */
    public function testViewUnauthorizedFails(): void
    {
        $this->login();

        $this->get('/3/elements/2');

        $this->assertResponseCode(403);
        $this->assertTrue($this->Elements->exists(['id' => 2]));

        $element = $this->Elements->find()->where(['id' => 2])->first();

        $this->assertSame(3, $element->collection_id);
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAddSuccess(): void
    {
        $this->login();

        $this->post('/1/elements/add', [
            'name' => 'test name',
            'description' => 'test description',
            'source' => '',
            'image' => '',
            'collection_id' => 1,
        ]);

        $this->assertResponseSuccess();
        $this->assertFlashMessage(__('The element has been saved.'));
        $this->assertRedirect('/1/view');

        $elements = $this->Elements->find()->where(['collection_id' => 1])->all();

        $this->assertEquals(2, count($elements));
    }

    /**
     * Test add method unauthenticated
     *
     * @return void
     */
    public function testAddUnauthenticatedFails(): void
    {
        $this->post('/1/elements/add', [
            'name' => 'test name',
            'description' => 'test description',
            'source' => '',
            'image' => '',
            'collection_id' => 1,
        ]);

        $this->assertResponseCode(302);
        $this->assertRedirectEquals(['controller' => 'Users', 'action' => 'login']);

        $elements = $this->Elements->find()->where(['collection_id' => 1])->all();

        $this->assertEquals(1, count($elements));
    }

    /**
     * Test add method unauthorized
     *
     * @return void
     */
    public function testAddUnauthorizedFails(): void
    {
        $this->login();

        $this->post('/3/elements/add', [
            'name' => 'test name',
            'description' => 'test description',
            'source' => '',
            'image' => '',
            'collection_id' => 3,
        ]);

        $this->assertResponseCode(403);
        $this->assertNoRedirect();

        $elements = $this->Elements->find()->where(['collection_id' => 1])->all();

        $this->assertEquals(1, count($elements));
    }

    /**
     * Test add method with validation error
     *
     * @return void
     */
    public function testAddValidationError(): void
    {
        $this->login();

        $this->post('/1/elements/add', [
            'name' => '',
            'description' => 'test description',
            'source' => '',
            'image' => '',
            'collection_id' => 1,
        ]);

        // $this->assertResponseSuccess();
        $this->assertFlashMessage(__('The element could not be saved. Please, try again.'));
        $this->assertNoRedirect();

        $elements = $this->Elements->find()->where(['collection_id' => 1])->all();

        $this->assertEquals(1, count($elements));
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
    public function testDeleteSuccess(): void
    {
        $this->login();

        $this->post('/1/elements/1/delete');

        $this->assertRedirect(['controller' => 'Collections', 'action' => 'view', 1]);
        $this->assertFalse($this->Elements->exists(['id' => 1]));
    }

    /**
     * Test delete method unauthenticated
     *
     * @return void
     */
    public function testDeleteUnauthenticatedFails(): void
    {
        $this->post('/1/elements/1/delete');

        $this->assertResponseCode(302);
        $this->assertRedirectEquals(['controller' => 'Users', 'action' => 'login']);
        $this->assertTrue($this->Elements->exists(['id' => 1]));
    }

    /**
     * Test delete method unauthorized
     *
     * @return void
     */
    public function testDeleteUnauthorizedFails(): void
    {
        $this->login();

        $this->post('/3/elements/2/delete');

        $this->assertResponseCode(403);
        $this->assertNoRedirect();
        $this->assertTrue($this->Elements->exists(['id' => 2]));
    }
}
