<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DriverScreeningStagesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DriverScreeningStagesTable Test Case
 */
class DriverScreeningStagesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DriverScreeningStagesTable
     */
    public $DriverScreeningStages;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.driver_screening_stages',
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
        $config = TableRegistry::getTableLocator()->exists('DriverScreeningStages') ? [] : ['className' => DriverScreeningStagesTable::class];
        $this->DriverScreeningStages = TableRegistry::getTableLocator()->get('DriverScreeningStages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DriverScreeningStages);

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
