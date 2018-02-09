<?php
namespace App\Test\TestCase\Controller;

use App\Controller\RequestsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\RequestsController Test Case
 */
class RequestsControllerTest extends IntegrationTestCase
{

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
