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
        'app.permission_role',
        'app.userdetails',
        'app.users',
        'app.social_profiles',
        'app.cities',
        'app.states',
        'app.countries',
        'app.hotels',
        'app.requests',
        'app.categories',
        'app.finals',
        'app.references',
        'app.responses',
        'app.testimonial',
        'app.authors',
        'app.request_stops',
        'app.user_chats',
        'app.user_chats123',
        'app.user_ratings',
        'app.transports',
        'app.credits',
        'app.promotion',
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
