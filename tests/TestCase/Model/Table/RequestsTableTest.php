<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RequestsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RequestsTable Test Case
 */
class RequestsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RequestsTable
     */
    public $Requests;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.requests',
        'app.users',
        'app.social_profiles',
        'app.cities',
        'app.states',
        'app.countries',
        'app.hotels',
        'app.userdetails',
        'app.request_stops',
        'app.transports',
        'app.responses',
        'app.testimonial',
        'app.authors',
        'app.user_chats',
        'app.credits',
        'app.promotion',
        'app.user_ratings'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Requests') ? [] : ['className' => 'App\Model\Table\RequestsTable'];
        $this->Requests = TableRegistry::get('Requests', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Requests);

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
}
