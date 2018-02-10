<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AdminRoleTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AdminRoleTable Test Case
 */
class AdminRoleTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AdminRoleTable
     */
    public $AdminRole;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.admin_role',
        'app.roles',
        'app.admins'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AdminRole') ? [] : ['className' => 'App\Model\Table\AdminRoleTable'];
        $this->AdminRole = TableRegistry::get('AdminRole', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AdminRole);

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
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
