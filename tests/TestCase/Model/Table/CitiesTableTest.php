<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CitiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CitiesTable Test Case
 */
class CitiesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CitiesTable
     */
    public $Cities;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.cities',
        'app.states',
        'app.countries',
        'app.users',
        'app.social_profiles',
        'app.requests',
        'app.user_ratings',
        'app.responses',
        'app.testimonial',
        'app.user_chats',
        'app.hotels',
        'app.request_stops',
        'app.transports',
        'app.credits',
        'app.promotion',
        'app.userdetails'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Cities') ? [] : ['className' => 'App\Model\Table\CitiesTable'];
        $this->Cities = TableRegistry::get('Cities', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Cities);

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
     * Test getAllCities method
     *
     * @return void
     */
    public function testGetAllCities()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
