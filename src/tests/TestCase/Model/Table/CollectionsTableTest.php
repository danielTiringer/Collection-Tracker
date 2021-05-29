<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CollectionsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CollectionsTable Test Case
 */
class CollectionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CollectionsTable
     */
    protected $Collections;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Collections',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Collections') ? [] : ['className' => CollectionsTable::class];
        $this->Collections = $this->getTableLocator()->get('Collections', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Collections);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
