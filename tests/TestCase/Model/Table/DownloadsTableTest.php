<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DownloadsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DownloadsTable Test Case
 */
class DownloadsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DownloadsTable
     */
    public $Downloads;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.downloads',
        'app.documents',
        'app.courses',
        'app.users',
        'app.profiles',
        'app.courses_users',
        'app.download'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Downloads') ? [] : ['className' => 'App\Model\Table\DownloadsTable'];
        $this->Downloads = TableRegistry::get('Downloads', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Downloads);

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
