<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ResponsesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ResponsesTable Test Case
 */
class ResponsesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ResponsesTable
     */
    public $Responses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.responses',
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
        'app.request_stops',
        'app.testimonial',
        'app.authors',
        'app.user_chats',
        'app.user_chats123',
        'app.user_ratings',
        'app.userdetails',
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
        $config = TableRegistry::exists('Responses') ? [] : ['className' => 'App\Model\Table\ResponsesTable'];
        $this->Responses = TableRegistry::get('Responses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Responses);

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
