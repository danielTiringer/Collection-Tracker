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
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
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
