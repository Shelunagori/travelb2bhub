<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HotelPromotionCitiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HotelPromotionCitiesTable Test Case
 */
class HotelPromotionCitiesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\HotelPromotionCitiesTable
     */
    public $HotelPromotionCities;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.hotel_promotion_cities',
        'app.hotel_promotions',
        'app.cities',
        'app.states',
        'app.countries',
        'app.event_planner_promotions',
        'app.price_masters',
        'app.promotion_types',
        'app.post_travle_packages',
        'app.currencies',
        'app.users',
        'app.social_profiles',
        'app.roles',
        'app.admin_role',
        'app.admins',
        'app.user_rights',
        'app.modules',
        'app.permission_role',
        'app.userdetails',
        'app.requests',
        'app.categories',
        'app.pages',
        'app.finals',
        'app.references',
        'app.request_stops',
        'app.responses',
        'app.user_chats',
        'app.testimonial',
        'app.authors',
        'app.hotels',
        'app.transports',
        'app.credits',
        'app.promotion',
        'app.user_chats123',
        'app.user_ratings',
        'app.post_travle_package_cities',
        'app.post_travle_package_rows',
        'app.post_travle_package_categories',
        'app.post_travle_package_likes',
        'app.post_travle_package_views',
        'app.post_travle_package_states',
        'app.post_travle_package_countries',
        'app.post_travle_package_price_before_renews',
        'app.post_travle_package_carts',
        'app.taxi_fleet_promotions',
        'app.taxi_fleet_promotion_cities',
        'app.taxi_fleet_promotion_rows',
        'app.taxi_fleet_car_buses',
        'app.taxi_fleet_promotion_likes',
        'app.taxi_fleet_promotion_views',
        'app.taxi_fleet_promotion_states',
        'app.taxi_fleet_promotion_price_before_renews',
        'app.taxi_fleet_promotion_carts',
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
        $config = TableRegistry::exists('HotelPromotionCities') ? [] : ['className' => 'App\Model\Table\HotelPromotionCitiesTable'];
        $this->HotelPromotionCities = TableRegistry::get('HotelPromotionCities', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->HotelPromotionCities);

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
