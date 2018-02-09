<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StatesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StatesTable Test Case
 */
class StatesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StatesTable
     */
    public $States;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.states',
        'app.users',
        'app.social_profiles',
        'app.cities',
        'app.requests',
        'app.user_ratings',
        'app.responses',
        'app.testimonial',
        'app.user_chats',
        'app.hotels',
        'app.request_stops',
        'app.transports',
        'app.countries',
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
        $config = TableRegistry::exists('States') ? [] : ['className' => 'App\Model\Table\StatesTable'];
        $this->States = TableRegistry::get('States', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->States);

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
     * Test getAllStates method
     *
     * @return void
     */
    public function testGetAllStates()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
