<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        //Make a user
        $user = new User();
        $user->user_type = 'Super Admin';
        $user->name = 'Shahriar Islam';
        $user->email = 'shahriar@gmail.com';
        $user->email_verified_at = now();
        $user->password = Hash::make('12345678');
        // $user->remember_token  = Srt::random(10);
        $user->save();

        //Create default role
        $role = Role::create(['name' => 'admin']);
        $role = Role::create(['name' => 'user']);
    }
}
