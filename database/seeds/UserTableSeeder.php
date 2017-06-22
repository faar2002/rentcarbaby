<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        factory(App\User::class)->create([
            'name' => 'Francisco A. Aponte R.',
            'username' => 'faar2002',
            'email' => 'faar2002@gmail.com',
            'role' => 'superadmin',
            'password' => bcrypt('10348010'),
            'active' => true
        ]);
        factory(App\User::class,19)->create();
    }
}
