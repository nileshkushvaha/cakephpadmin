<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WorksheetsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WorksheetsTable Test Case
 */
class WorksheetsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WorksheetsTable
     */
    public $Worksheets;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.worksheets',
        'app.drivers',
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
        $config = TableRegistry::getTableLocator()->exists('Worksheets') ? [] : ['className' => WorksheetsTable::class];
        $this->Worksheets = TableRegistry::getTableLocator()->get('Worksheets', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Worksheets);

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
