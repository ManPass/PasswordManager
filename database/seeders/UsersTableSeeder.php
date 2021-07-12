<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Services\UserService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public $userService;
    public function __construct(UserService $userService){
        $this->userService = $userService;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'login'=>'root@gmail.com',
            'password'=> Hash::make('root')
        ]);
        $this->userService->addRole(Role::where('login','admin')->first()->id,'root@gmail.com');

    }
}
