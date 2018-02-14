<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MembershipTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MembershipTable Test Case
 */
class MembershipTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MembershipTable
     */
    public $Membership;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.membership'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Membership') ? [] : ['className' => 'App\Model\Table\MembershipTable'];
        $this->Membership = TableRegistry::get('Membership', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Membership);

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
