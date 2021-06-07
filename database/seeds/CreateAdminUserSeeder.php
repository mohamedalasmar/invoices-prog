<?php
use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class CreateAdminUserSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{
    $user = User::create([
        'name' => 'mohamed khaled',
        'email' => 'mohamed.alasmar.1994@gmail.com',
        'password' => bcrypt('12345678'),
        'roles_name' => ["Admin"],
        'Status' => 'مفعل',
        ]);

        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
}
}
