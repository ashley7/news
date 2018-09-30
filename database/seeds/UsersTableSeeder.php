<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Branch;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $branch = Branch::all()->last();
        $user->name = "Admin";
        $user->email = "admin@chims.ug";
        $user->password = bcrypt('chims2018');
        $user->phone_number = "0787555666";
        $user->branch_id = $branch->id;
        $user->remember_token = str_random(32);
        $user->save();

        try {
            $readrole=\DB::table('roles')->where('name','main_admin')->select('id')->first();
            \DB::table('role_user')->insert([['user_id' =>  $user->id, 'role_id' =>  $readrole->id],]);            
        } catch (\Exception $e) {}
    }
}
