<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FeedsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FeedsTable Test Case
 */
class FeedsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FeedsTable
     */
    public $Feeds;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.feeds',
        'app.projects',
        'app.users',
        'app.profiles',
        'app.projects_users',
        'app.attachments',
        'app.tasks',
        'app.comments',
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
        $config = TableRegistry::exists('Feeds') ? [] : ['className' => 'App\Model\Table\FeedsTable'];
        $this->Feeds = TableRegistry::get('Feeds', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Feeds);

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
