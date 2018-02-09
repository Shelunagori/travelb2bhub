<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TestimonialTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TestimonialTable Test Case
 */
class TestimonialTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TestimonialTable
     */
    public $Testimonial;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.testimonial',
        'app.users',
        'app.social_profiles',
        'app.cities',
        'app.states',
        'app.countries',
        'app.hotels',
        'app.requests',
        'app.user_ratings',
        'app.responses',
        'app.user_chats',
        'app.request_stops',
        'app.userdetails',
        'app.transports',
        'app.credits',
        'app.promotion',
        'app.authors'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Testimonial') ? [] : ['className' => 'App\Model\Table\TestimonialTable'];
        $this->Testimonial = TableRegistry::get('Testimonial', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Testimonial);

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
