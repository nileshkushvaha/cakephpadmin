<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AssignDriversTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AssignDriversTable Test Case
 */
class AssignDriversTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AssignDriversTable
     */
    public $AssignDrivers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.assign_drivers',
        'app.jobs',
        'app.drivers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('AssignDrivers') ? [] : ['className' => AssignDriversTable::class];
        $this->AssignDrivers = TableRegistry::getTableLocator()->get('AssignDrivers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AssignDrivers);

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
