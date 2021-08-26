<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NewDriverRequestsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NewDriverRequestsTable Test Case
 */
class NewDriverRequestsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\NewDriverRequestsTable
     */
    public $NewDriverRequests;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.new_driver_requests',
        'app.clients'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('NewDriverRequests') ? [] : ['className' => NewDriverRequestsTable::class];
        $this->NewDriverRequests = TableRegistry::getTableLocator()->get('NewDriverRequests', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->NewDriverRequests);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
