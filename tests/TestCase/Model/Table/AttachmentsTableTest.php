<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AttachmentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AttachmentsTable Test Case
 */
class AttachmentsTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.attachments',
        'app.tasks',
        'app.comments',
        'app.users',
        'app.profiles',
        'app.tasks_comments',
        'app.labels',
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
        $config = TableRegistry::exists('Attachments') ? [] : ['className' => 'App\Model\Table\AttachmentsTable'];
        $this->Attachments = TableRegistry::get('Attachments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Attachments);

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
