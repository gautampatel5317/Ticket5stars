<?php

use App\Models\Permission\Permission;
use App\Models\Role\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder {
	public function run() {
		DB::table('permission_role')->delete();
		DB::table('permissions')->delete();
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
				'title'      => 'customer_show',
				'created_at' => '2020-05-27 16:14:42',
				'updated_at' => '2020-05-27 16:14:42',
			],
			[
				'id'         => '23',
				'title'      => 'customer_access',
				'created_at' => '2020-05-27 16:14:42',
				'updated_at' => '2020-05-27 16:14:42',
			],
			[
				'id'         => '24',
				'title'      => 'customer_edit',
				'created_at' => '2020-05-27 16:14:42',
				'updated_at' => '2020-05-27 16:14:42',
			],
			[
				'id'         => '25',
				'title'      => 'customer_delete',
				'created_at' => '2020-05-27 16:14:42',
				'updated_at' => '2020-05-27 16:14:42',
			],
			[
				'id'         => '26',
				'title'      => 'customer_create',
				'created_at' => '2020-05-27 16:14:42',
				'updated_at' => '2020-05-27 16:14:42',
			],
			[
				'id'         => '27',
				'title'      => 'cms_access',
				'created_at' => '2020-05-27 16:14:42',
				'updated_at' => '2020-05-27 16:14:42',
			],
			[
				'id'         => '28',
				'title'      => 'cms_create',
				'created_at' => '2020-05-27 16:14:42',
				'updated_at' => '2020-05-27 16:14:42',
			],
			[
				'id'         => '29',
				'title'      => 'cms_edit',
				'created_at' => '2020-05-27 16:14:42',
				'updated_at' => '2020-05-27 16:14:42',
			],
			[
				'id'         => '30',
				'title'      => 'cms_show',
				'created_at' => '2020-05-27 16:14:42',
				'updated_at' => '2020-05-27 16:14:42',
			],
			[
				'id'         => '31',
				'title'      => 'cms_delete',
				'created_at' => '2020-05-27 16:14:42',
				'updated_at' => '2020-05-27 16:14:42',
			],

		];

		Permission::insert($permissions);
	}
}
