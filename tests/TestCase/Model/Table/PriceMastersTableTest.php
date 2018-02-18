<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PriceMastersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PriceMastersTable Test Case
 */
class PriceMastersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PriceMastersTable
     */
    public $PriceMasters;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.price_masters',
        'app.promotion_types',
        'app.event_planner_promotions',
        'app.post_travle_packages',
        'app.currencies',
        'app.countries',
        'app.users',
        'app.social_profiles',
        'app.roles',
        'app.admin_role',
        'app.admins',
        'app.user_rights',
        'app.modules',
        'app.permission_role',
        'app.userdetails',
        'app.cities',
        'app.states',
        'app.hotels',
        'app.request_stops',
        'app.requests',
        'app.categories',
        'app.pages',
        'app.finals',
        'app.references',
        'app.responses',
        'app.user_chats',
        'app.testimonial',
        'app.authors',
        'app.transports',
        'app.credits',
        'app.promotion',
        'app.user_chats123',
        'app.user_ratings',
        'app.post_travle_package_cities',
        'app.post_travle_package_rows',
        'app.post_travle_package_states',
        'app.taxi_fleet_promotions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PriceMasters') ? [] : ['className' => 'App\Model\Table\PriceMastersTable'];
        $this->PriceMasters = TableRegistry::get('PriceMasters', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PriceMasters);

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
