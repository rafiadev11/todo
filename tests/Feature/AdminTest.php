<?php

    namespace Tests\Feature;

    use App\Models\Item;
    use App\Models\Role;
    use App\Models\User;
    use Tests\TestCase;

    class AdminTest extends TestCase
    {

        protected function setUp(): void
        {
            parent::setUp();
            $user = User::factory()->create();
            $role = Role::factory()->create(['name' => 'Administrator', 'slug' => 'admin']);
            $user->roles()->attach($role);
            $this->actingAs($user);
        }

        public function test_admins_can_view_all_items()
        {
            Item::factory()->count(10)->create(['user_id' => 5]);
            $this->get(route('users'))->assertStatus(200)->assertSee('Items (10)');
        }
    }
