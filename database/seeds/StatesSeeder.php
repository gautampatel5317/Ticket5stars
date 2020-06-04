<?php

use Illuminate\Database\Seeder;

class StatesSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		if (env('DB_CONNECTION') == 'mysql') {
			\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
			\DB::table(config('tables.states_table'))->truncate();
		}
		$dbInsert = \DB::statement("INSERT INTO `states` (`id`, `name`, `country_id`,`created_by`) VALUES
					(1, 'Andaman and Nicobar Islands', 101,1),
					(2, 'Andhra Pradesh', 101,1),
					(3, 'Arunachal Pradesh', 101,1),
					(4, 'Assam', 101,1),
					(5, 'Bihar', 101,1),
					(6, 'Chandigarh', 101,1),
					(7, 'Chhattisgarh', 101,1),
					(8, 'Dadra and Nagar Haveli', 101,1),
					(9, 'Daman and Diu', 101,1),
					(10, 'Delhi', 101,1),
					(11, 'Goa', 101,1),
					(12, 'Gujarat', 101,1),
					(13, 'Haryana', 101,1),
					(14, 'Himachal Pradesh', 101,1),
					(15, 'Jammu and Kashmir', 101,1),
					(16, 'Jharkhand', 101,1),
					(17, 'Karnataka', 101,1),
					(18, 'Kenmore', 101,1),
					(19, 'Kerala', 101,1),
					(20, 'Lakshadweep', 101,1),
					(21, 'Madhya Pradesh', 101,1),
					(22, 'Maharashtra', 101,1),
					(23, 'Manipur', 101,1),
					(24, 'Meghalaya', 101,1),
					(25, 'Mizoram', 101,1),
					(26, 'Nagaland', 101,1),
					(27, 'Narora', 101,1),
					(28, 'Natwar', 101,1),
					(29, 'Odisha', 101,1),
					(30, 'Paschim Medinipur', 101,1),
					(31, 'Pondicherry', 101,1),
					(32, 'Punjab', 101,1),
					(33, 'Rajasthan', 101,1),
					(34, 'Sikkim', 101,1),
					(35, 'Tamil Nadu', 101,1),
					(36, 'Telangana', 101,1),
					(37, 'Tripura', 101,1),
					(38, 'Uttar Pradesh', 101,1),
					(39, 'Uttarakhand', 101,1),
					(40, 'Vaishali', 101,1),
					(41, 'West Bengal', 101,1)
					;
					");
	}
}
