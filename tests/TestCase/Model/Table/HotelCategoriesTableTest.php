<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HotelCategoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HotelCategoriesTable Test Case
 */
class HotelCategoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\HotelCategoriesTable
     */
    public $HotelCategories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.hotel_categories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('HotelCategories') ? [] : ['className' => 'App\Model\Table\HotelCategoriesTable'];
        $this->HotelCategories = TableRegistry::get('HotelCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->HotelCategories);

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
