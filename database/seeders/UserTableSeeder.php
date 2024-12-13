<?php
namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create or ensure a profile exists
        $profile = Profile::firstOrCreate([
            'id' => 1,
        ], [
            'name' => 'Default Profile', // Updated to match the migration
        ]);

        // Create a user associated with the profile
        $u = new User;
        $u->name = "Tony";
        $u->profile_id = $profile->id;  // Ensure the profile_id matches the existing profile
        $u->email = "tonytony@gmail.com";
        $u->password = bcrypt("123");  // Hash the password
        $u->save();

        // Generate random users using the factory
        User::factory()->count(5)->create();
    }
}
