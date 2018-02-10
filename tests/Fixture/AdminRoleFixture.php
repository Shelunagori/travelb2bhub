<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AdminRoleFixture
 *
 */
class AdminRoleFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'admin_role';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'role_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'admin_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'admin_role_admin_id_foreign' => ['type' => 'index', 'columns' => ['admin_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['role_id', 'admin_id'], 'length' => []],
            'admin_role_admin_id_foreign' => ['type' => 'foreign', 'columns' => ['admin_id'], 'references' => ['admins', 'id'], 'update' => 'restrict', 'delete' => 'cascade', 'length' => []],
            'admin_role_role_id_foreign' => ['type' => 'foreign', 'columns' => ['role_id'], 'references' => ['roles', 'id'], 'update' => 'restrict', 'delete' => 'cascade', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_unicode_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'role_id' => 1,
            'admin_id' => 1
        ],
    ];
}
