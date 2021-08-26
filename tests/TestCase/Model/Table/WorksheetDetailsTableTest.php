<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WorksheetDetailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WorksheetDetailsTable Test Case
 */
class WorksheetDetailsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WorksheetDetailsTable
     */
    public $WorksheetDetails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.worksheet_details',
        'app.worksheets'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('WorksheetDetails') ? [] : ['className' => WorksheetDetailsTable::class];
        $this->WorksheetDetails = TableRegistry::getTableLocator()->get('WorksheetDetails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->WorksheetDetails);

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
