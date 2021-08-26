<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\JobListsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\JobListsTable Test Case
 */
class JobListsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\JobListsTable
     */
    public $JobLists;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.job_lists',
        'app.clients',
        'app.assign_drivers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('JobLists') ? [] : ['className' => JobListsTable::class];
        $this->JobLists = TableRegistry::getTableLocator()->get('JobLists', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->JobLists);

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
