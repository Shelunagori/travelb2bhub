<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ResponsesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ResponsesController Test Case
 */
class ResponsesControllerTest extends IntegrationTestCase
{

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
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
