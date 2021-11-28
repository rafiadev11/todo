<?php

    namespace Database\Seeders;

    use App\Models\Role;
    use App\Models\User;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\Hash;

    class DatabaseSeeder extends Seeder
    {
        /**
         * Seed the application's database.
         *
         * @return void
         */
        public function run()
        {
            Role::create([
                'name' => 'User',
                'slug' => 'user'
            ]);
            $role = Role::create([
                'name' => 'Administrator',
                'slug' => 'admin'
            ]);

            $user = User::create([
                'name' => 'John Doe',
                'email' => 'john_doe@admin.com',
                'password' => 'admin1234'
            ]);

            $user->roles()->attach($role);
        }
    }
