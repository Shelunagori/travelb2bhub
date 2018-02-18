<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TaxiFleetPromotionRowsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TaxiFleetPromotionRowsTable Test Case
 */
class TaxiFleetPromotionRowsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TaxiFleetPromotionRowsTable
     */
    public $TaxiFleetPromotionRows;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.taxi_fleet_promotion_rows',
        'app.taxi_fleet_promotions',
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
        'app.price_masters',
        'app.promotion_types',
        'app.event_planner_promotions',
        'app.post_travle_packages',
        'app.currencies',
        'app.post_travle_package_cities',
        'app.post_travle_package_rows',
        'app.post_travle_package_categories',
        'app.post_travle_package_states',
        'app.taxi_fleet_promotion_cities',
        'app.taxi_fleet_promotion_states',
        'app.taxi_fleet_car_buses'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TaxiFleetPromotionRows') ? [] : ['className' => 'App\Model\Table\TaxiFleetPromotionRowsTable'];
        $this->TaxiFleetPromotionRows = TableRegistry::get('TaxiFleetPromotionRows', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TaxiFleetPromotionRows);

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
