<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PostTravlePackageCategoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PostTravlePackageCategoriesTable Test Case
 */
class PostTravlePackageCategoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PostTravlePackageCategoriesTable
     */
    public $PostTravlePackageCategories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.post_travle_package_categories',
        'app.post_travle_package_rows'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PostTravlePackageCategories') ? [] : ['className' => 'App\Model\Table\PostTravlePackageCategoriesTable'];
        $this->PostTravlePackageCategories = TableRegistry::get('PostTravlePackageCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PostTravlePackageCategories);

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
