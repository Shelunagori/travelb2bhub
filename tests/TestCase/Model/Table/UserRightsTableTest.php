<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserRightsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserRightsTable Test Case
 */
class UserRightsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UserRightsTable
     */
    public $UserRights;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.user_rights',
        'app.users',
        'app.social_profiles',
        'app.cities',
        'app.states',
        'app.countries',
        'app.hotels',
        'app.requests',
        'app.categories',
        'app.pages',
        'app.finals',
        'app.references',
        'app.request_stops',
        'app.responses',
        'app.testimonial',
        'app.authors',
        'app.transports',
        'app.credits',
        'app.promotion',
        'app.user_chats',
        'app.user_chats123',
        'app.user_ratings',
        'app.userdetails',
        'app.roles',
        'app.admin_role',
        'app.admins',
        'app.permission_role',
        'app.modules'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UserRights') ? [] : ['className' => 'App\Model\Table\UserRightsTable'];
        $this->UserRights = TableRegistry::get('UserRights', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserRights);

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
