<?php

use App\Models\Permission\Permission;
use App\Models\Role\Role;
use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder {
	public function run() {
		DB::table('permission_role')->delete();
		DB::table('permissions')->delete();
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		if (env('DB_CONNECTION') == 'mysql') {
			DB::table(config('tables.permissions_table'))->truncate();
		}
		$permissions = [[
				'id'         => '1',
				'title'      => 'user_management_access',
				'created_at' => '2019-04-15 19:14:42',
				'updated_at' => '2019-04-15 19:14:42',
			],
			[
				'id'         => '2',
				'title'      => 'permission_create',
				'created_at' => '2019-04-15 19:14:42',
				'updated_at' => '2019-04-15 19:14:42',
			],
			[
				'id'         => '3',
				'title'      => 'permission_edit',
				'created_at' => '2019-04-15 19:14:42',
				'updated_at' => '2019-04-15 19:14:42',
			],
			[
				'id'         => '4',
				'title'      => 'permission_show',
				'created_at' => '2019-04-15 19:14:42',
				'updated_at' => '2019-04-15 19:14:42',
			],
			[
				'id'         => '5',
				'title'      => 'permission_delete',
				'created_at' => '2019-04-15 19:14:42',
				'updated_at' => '2019-04-15 19:14:42',
			],
			[
				'id'         => '6',
				'title'      => 'permission_access',
				'created_at' => '2019-04-15 19:14:42',
				'updated_at' => '2019-04-15 19:14:42',
			],
			[
				'id'         => '7',
				'title'      => 'role_create',
				'created_at' => '2019-04-15 19:14:42',
				'updated_at' => '2019-04-15 19:14:42',
			],
			[
				'id'         => '8',
				'title'      => 'role_edit',
				'created_at' => '2019-04-15 19:14:42',
				'updated_at' => '2019-04-15 19:14:42',
			],
			[
				'id'         => '9',
				'title'      => 'role_show',
				'created_at' => '2019-04-15 19:14:42',
				'updated_at' => '2019-04-15 19:14:42',
			],
			[
				'id'         => '10',
				'title'      => 'role_delete',
				'created_at' => '2019-04-15 19:14:42',
				'updated_at' => '2019-04-15 19:14:42',
			],
			[
				'id'         => '11',
				'title'      => 'role_access',
				'created_at' => '2019-04-15 19:14:42',
				'updated_at' => '2019-04-15 19:14:42',
			],
			[
				'id'         => '12',
				'title'      => 'user_create',
				'created_at' => '2019-04-15 19:14:42',
				'updated_at' => '2019-04-15 19:14:42',
			],
			[
				'id'         => '13',
				'title'      => 'user_edit',
				'created_at' => '2019-04-15 19:14:42',
				'updated_at' => '2019-04-15 19:14:42',
			],
			[
				'id'         => '14',
				'title'      => 'user_show',
				'created_at' => '2019-04-15 19:14:42',
				'updated_at' => '2019-04-15 19:14:42',
			],
			[
				'id'         => '15',
				'title'      => 'user_delete',
				'created_at' => '2019-04-15 19:14:42',
				'updated_at' => '2019-04-15 19:14:42',
			],
			[
				'id'         => '16',
				'title'      => 'user_access',
				'created_at' => '2019-04-15 19:14:42',
				'updated_at' => '2019-04-15 19:14:42',
			],
			[
				'id'         => '17',
				'title'      => 'product_create',
				'created_at' => '2019-04-15 19:14:42',
				'updated_at' => '2019-04-15 19:14:42',
			],
			[
				'id'         => '18',
				'title'      => 'product_edit',
				'created_at' => '2019-04-15 19:14:42',
				'updated_at' => '2019-04-15 19:14:42',
			],
			[
				'id'         => '19',
				'title'      => 'product_show',
				'created_at' => '2019-04-15 19:14:42',
				'updated_at' => '2019-04-15 19:14:42',
			],
			[
				'id'         => '20',
				'title'      => 'product_delete',
				'created_at' => '2019-04-15 19:14:42',
				'updated_at' => '2019-04-15 19:14:42',
			],
			[
				'id'         => '21',
				'title'      => 'product_access',
				'created_at' => '2019-04-15 19:14:42',
				'updated_at' => '2019-04-15 19:14:42',
			],
			[
				'id'         => '22',
				'title'      => 'edit-settings',
				'created_at' => '2019-04-15 19:14:42',
				'updated_at' => '2019-04-15 19:14:42',
			],
			[
				'id'         => '23',
				'title'      => 'view-email-template',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
			[
				'id'         => '24',
				'title'      => 'edit-email-template',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
			[
				'id'         => '25',
				'title'      => 'delete-email-template',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
			[
				'id'         => '26',
				'title'      => 'customer_show',
				'created_at' => '2020-05-27 16:14:42',
				'updated_at' => '2020-05-27 16:14:42',
			],
			[
				'id'         => '27',
				'title'      => 'customer_access',
				'created_at' => '2020-05-27 16:14:42',
				'updated_at' => '2020-05-27 16:14:42',
			],
			[
				'id'         => '28',
				'title'      => 'customer_edit',
				'created_at' => '2020-05-27 16:14:42',
				'updated_at' => '2020-05-27 16:14:42',
			],
			[
				'id'         => '29',
				'title'      => 'customer_delete',
				'created_at' => '2020-05-27 16:14:42',
				'updated_at' => '2020-05-27 16:14:42',
			],
			[
				'id'         => '30',
				'title'      => 'customer_create',
				'created_at' => '2020-05-27 16:14:42',
				'updated_at' => '2020-05-27 16:14:42',
			],
			[
				'id'         => '31',
				'title'      => 'cms_access',
				'created_at' => '2020-05-27 16:14:42',
				'updated_at' => '2020-05-27 16:14:42',
			],
			[
				'id'         => '32',
				'title'      => 'cms_create',
				'created_at' => '2020-05-27 16:14:42',
				'updated_at' => '2020-05-27 16:14:42',
			],
			[
				'id'         => '33',
				'title'      => 'cms_edit',
				'created_at' => '2020-05-27 16:14:42',
				'updated_at' => '2020-05-27 16:14:42',
			],
			[
				'id'         => '34',
				'title'      => 'cms_show',
				'created_at' => '2020-05-27 16:14:42',
				'updated_at' => '2020-05-27 16:14:42',
			],
			[
				'id'         => '35',
				'title'      => 'cms_delete',
				'created_at' => '2020-05-27 16:14:42',
				'updated_at' => '2020-05-27 16:14:42',
			],
			[
				'id'         => '36',
				'title'      => 'country_access',
				'created_at' => '2020-06-02 16:14:42',
				'updated_at' => '2020-06-02 16:14:42',
			],
			[
				'id'         => '37',
				'title'      => 'country_create',
				'created_at' => '2020-06-02 16:14:42',
				'updated_at' => '2020-06-02 16:14:42',
			],
			[
				'id'         => '38',
				'title'      => 'country_edit',
				'created_at' => '2020-06-02 16:14:42',
				'updated_at' => '2020-06-02 16:14:42',
			],
			[
				'id'         => '39',
				'title'      => 'country_show',
				'created_at' => '2020-06-02 16:14:42',
				'updated_at' => '2020-06-02 16:14:42',
			],
			[
				'id'         => '40',
				'title'      => 'country_delete',
				'created_at' => '2020-06-02 16:14:42',
				'updated_at' => '2020-06-02 16:14:42',
			],
			[
				'id'         => '41',
				'title'      => 'state_access',
				'created_at' => '2020-06-02 16:14:42',
				'updated_at' => '2020-06-02 16:14:42',
			],
			[
				'id'         => '42',
				'title'      => 'state_create',
				'created_at' => '2020-06-02 16:14:42',
				'updated_at' => '2020-06-02 16:14:42',
			],
			[
				'id'         => '43',
				'title'      => 'state_edit',
				'created_at' => '2020-06-02 16:14:42',
				'updated_at' => '2020-06-02 16:14:42',
			],
			[
				'id'         => '44',
				'title'      => 'state_show',
				'created_at' => '2020-06-02 16:14:42',
				'updated_at' => '2020-06-02 16:14:42',
			],
			[
				'id'         => '45',
				'title'      => 'state_delete',
				'created_at' => '2020-06-02 16:14:42',
				'updated_at' => '2020-06-02 16:14:42',
			],
		];
		Permission::insert($permissions);
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}
}
