<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PromotionTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PromotionTypesTable Test Case
 */
class PromotionTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PromotionTypesTable
     */
    public $PromotionTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.promotion_types',
        'app.price_masters'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PromotionTypes') ? [] : ['className' => 'App\Model\Table\PromotionTypesTable'];
        $this->PromotionTypes = TableRegistry::get('PromotionTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PromotionTypes);

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
}
