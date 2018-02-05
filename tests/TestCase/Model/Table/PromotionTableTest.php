<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PromotionTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PromotionTable Test Case
 */
class PromotionTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PromotionTable
     */
    public $Promotion;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.promotion',
        'app.users',
        'app.social_profiles',
        'app.cities',
        'app.states',
        'app.requests',
        'app.user_ratings',
        'app.responses',
        'app.testimonial',
        'app.user_chats',
        'app.hotels',
        'app.request_stops',
        'app.transports',
        'app.countries',
        'app.credits'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Promotion') ? [] : ['className' => 'App\Model\Table\PromotionTable'];
        $this->Promotion = TableRegistry::get('Promotion', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Promotion);

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
