<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LabelsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LabelsTable Test Case
 */
class LabelsTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.labels',
        'app.tasks',
        'app.attachments',
        'app.comments',
        'app.users',
        'app.profiles',
        'app.tasks_comments',
        'app.tasks_labels',
        'app.users_tasks'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Labels') ? [] : ['className' => 'App\Model\Table\LabelsTable'];
        $this->Labels = TableRegistry::get('Labels', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Labels);

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
}
