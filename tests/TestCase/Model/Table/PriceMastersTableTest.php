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
        'app.countries',
        'app.hotels',
        'app.users',
        'app.social_profiles',
        'app.roles',
        'app.admin_role',
        'app.admins',
        'app.user_rights',
        'app.modules',
        'app.user_chats',
        'app.requests',
        'app.categories',
        'app.pages',
        'app.finals',
        'app.states',
        'app.cities',
        'app.request_stops',
        'app.transports',
        'app.userdetails',
        'app.references',
        'app.responses',
        'app.testimonial',
        'app.authors',
        'app.credits',
        'app.promotion',
        'app.business_buddies',
        'app.user_chats123',
        'app.user_ratings',
        'app.post_travle_packages',
        'app.currencies',
        'app.post_travle_package_cities',
        'app.post_travle_package_rows',
        'app.post_travle_package_categories',
        'app.post_travle_package_likes',
        'app.post_travle_package_views',
        'app.post_travle_package_states',
        'app.post_travle_package_countries',
        'app.post_travle_package_price_before_renews',
        'app.post_travle_package_carts',
        'app.post_travle_package_reports',
        'app.report_reasons',
        'app.event_planner_promotion_reports',
        'app.taxi_fleet_promotion_reports',
        'app.taxi_fleet_promotions',
        'app.taxi_fleet_promotion_cities',
        'app.taxi_fleet_promotion_rows',
        'app.taxi_fleet_car_buses',
        'app.taxi_fleet_promotion_likes',
        'app.taxi_fleet_promotion_views',
        'app.taxi_fleet_promotion_states',
        'app.taxi_fleet_promotion_price_before_renews',
        'app.taxi_fleet_promotion_carts',
        'app.hotel_promotions',
        'app.hotel_categories',
        'app.hotel_promotion_cities',
        'app.hotel_promotion_likes',
        'app.hotel_promotion_price_before_renews',
        'app.hotel_promotion_reports',
        'app.hotel_promotion_views',
        'app.hotel_promotion_carts',
        'app.permission_role',
        'app.event_planner_promotion_cities',
        'app.event_planner_promotion_likes',
        'app.event_planner_promotion_views',
        'app.event_planner_promotion_states',
        'app.event_planner_promotion_price_before_renews',
        'app.event_planner_promotion_carts'
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
