<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AdminsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AdminsTable Test Case
 */
class AdminsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AdminsTable
     */
    public $Admins;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.admins',
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
        'app.promotion'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Admins') ? [] : ['className' => 'App\Model\Table\AdminsTable'];
        $this->Admins = TableRegistry::get('Admins', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Admins);

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
