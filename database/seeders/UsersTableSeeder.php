<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $init_users =[
           [
               'name' => '管理者',
               'email' => 'webmaster@localhost.localdomain',
               'password' => 'P@ssw0rd#2023'
           ],
           [
               'name' => 'テストユーザー',
               'email' => 'test@localhost.localdomain',
               'password' => 'P@ssw0rd#2023'
           ],
       ];

       foreach($init_users as $user){
           $data = new User();
           $data->name = $user['name'];
           $data->email = $user['email'];
           $data->password = Hash::make($user['password']);
           $data->save();
       }
    }
}
