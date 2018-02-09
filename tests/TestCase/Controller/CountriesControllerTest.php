<?php
namespace App\Test\TestCase\Controller;

use App\Controller\CountriesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\CountriesController Test Case
 */
class CountriesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.countries',
        'app.users',
        'app.social_profiles',
        'app.cities',
        'app.states',
        'app.hotels',
        'app.request_stops',
        'app.requests',
        'app.user_ratings',
        'app.responses',
        'app.testimonial',
        'app.user_chats',
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
