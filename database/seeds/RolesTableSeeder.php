<?php

use Illuminate\Database\Seeder;
use App\Role;
class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = ["main_admin",'manager'];
        foreach ($roles as $value) {
        	$role = new Role();
        	$role->name = $value;
        	$role->save();
        }
    }
}
