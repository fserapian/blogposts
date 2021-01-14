<?php

use App\User;
use Illuminate\Database\Seeder;

// @codingStandardsIgnoreLine
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $usersCount = max((int) $this->command->ask('How many users would you like to create?', 20), 1);

        // Default user using states
        factory(User::class)->states('default-user')->create();

        // Create 20 users
        factory(User::class, $usersCount)->create();
    }
}
