<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PostTravlePackagesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PostTravlePackagesTable Test Case
 */
class PostTravlePackagesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PostTravlePackagesTable
     */
    public $PostTravlePackages;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.post_travle_packages',
        'app.currencies',
        'app.countries',
        'app.hotels',
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
        'app.post_travle_package_cities',
        'app.post_travle_package_rows',
        'app.post_travle_package_states'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PostTravlePackages') ? [] : ['className' => 'App\Model\Table\PostTravlePackagesTable'];
        $this->PostTravlePackages = TableRegistry::get('PostTravlePackages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PostTravlePackages);

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
