<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PostTravlePackageRowsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PostTravlePackageRowsTable Test Case
 */
class PostTravlePackageRowsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PostTravlePackageRowsTable
     */
    public $PostTravlePackageRows;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.post_travle_package_rows',
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
        'app.price_masters',
        'app.promotion_types',
        'app.event_planner_promotions',
        'app.taxi_fleet_promotions',
        'app.post_travle_package_cities',
        'app.post_travle_package_states',
        'app.post_travle_package_categories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PostTravlePackageRows') ? [] : ['className' => 'App\Model\Table\PostTravlePackageRowsTable'];
        $this->PostTravlePackageRows = TableRegistry::get('PostTravlePackageRows', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PostTravlePackageRows);

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
