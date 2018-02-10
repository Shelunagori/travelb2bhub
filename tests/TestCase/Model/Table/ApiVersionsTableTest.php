<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ApiVersionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ApiVersionsTable Test Case
 */
class ApiVersionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ApiVersionsTable
     */
    public $ApiVersions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.api_versions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ApiVersions') ? [] : ['className' => 'App\Model\Table\ApiVersionsTable'];
        $this->ApiVersions = TableRegistry::get('ApiVersions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ApiVersions);

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
