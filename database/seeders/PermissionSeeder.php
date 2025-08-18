<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define permissions
        Permission::create(['name' => 'view.grades']);
        Permission::create(['name' => 'edit.students']);
        Permission::create(['name' => 'edit.houses']);
        Permission::create(['name' => 'edit.professors']);

        // Define roles
        $studentRole = Role::create(['name' => 'student']);
        $professorRole = Role::create(['name' => 'professor']);
        $headmasterRole = Role::create(['name' => 'headmaster']);
        $adminRole = Role::create(['name' => 'admin']);

        // Assign permissions to roles
        $professorRole->givePermissionTo('edit.students');

        $studentRole->givePermissionTo('view.grades');

        $headmasterRole->givePermissionTo('edit.students');
        $headmasterRole->givePermissionTo('edit.houses');
        $headmasterRole->givePermissionTo('edit.professors');

        $adminRole->givePermissionTo(Permission::all());

        // Assign roles to existing users
        $studentUser = User::where('email', 'vanessa.harbor@hogwarts.net')->first();
        $studentUser->assignRole('student');

        $professorUser = User::where('email', 'minerva.mcgonagall@hogwarts.net')->first();
        $professorUser->assignRole('professor');

        $headmasterUser = User::where('email', 'albus.dumbledore@hogwarts.net')->first();
        $headmasterUser->assignRole('headmaster');
    }
}
