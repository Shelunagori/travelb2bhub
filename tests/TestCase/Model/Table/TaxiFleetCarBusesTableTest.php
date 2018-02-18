<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TaxiFleetCarBusesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TaxiFleetCarBusesTable Test Case
 */
class TaxiFleetCarBusesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TaxiFleetCarBusesTable
     */
    public $TaxiFleetCarBuses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.taxi_fleet_car_buses',
        'app.taxi_fleet_promotion_rows'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TaxiFleetCarBuses') ? [] : ['className' => 'App\Model\Table\TaxiFleetCarBusesTable'];
        $this->TaxiFleetCarBuses = TableRegistry::get('TaxiFleetCarBuses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TaxiFleetCarBuses);

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
