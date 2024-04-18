<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Order;
use App\Models\Business;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_creation()
    {
        $user = User::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@example.com',
        ]);

        $this->assertModelExists($user);
        $this->assertEquals('John', $user->first_name);
        $this->assertEquals('Doe', $user->last_name);
        $this->assertEquals('johndoe@example.com', $user->email);
    }

    public function test_user_relationships()
    {
        $user = User::factory()
            ->has(Order::factory()->count(3))
            ->create();

        $this->assertCount(3, $user->orders);
    }


    public function test_user_business_relationship()
    {
        $user = User::factory()->create();
        $business = Business::factory()->create(['user_id' => $user->id]);

        $this->assertModelExists($user->business);
    }

    public function test_user_admin_methods()
    {
        $user = User::factory()->create();
        $role = Role::factory()->create(['name' => 'admin']);
        $user->roles()->attach($role);

        $this->assertTrue($user->isAdmin());
        $this->assertFalse($user->isRegularUser());
    }

    public function test_user_regular_user_methods()
    {
        $user = User::factory()->regularUser()->create();

        $this->assertFalse($user->isAdmin());
        $this->assertFalse($user->isBusinessOwner());
    }

    public function test_user_password_hashing()
    {
        $user = User::factory()->create([
            'password' => 'plainPassword'
        ]);

        $this->assertNotEquals('plainPassword', $user->password);
        $this->assertTrue(\Hash::check('plainPassword', $user->password));
    }

    public function test_user_factory_states()
    {
        $admin = User::factory()->admin()->create();
        $regular = User::factory()->regularUser()->create();

        $this->assertEquals('admin@admin.com', $admin->email);
        $this->assertEquals('user@user.com', $regular->email);
    }
}
