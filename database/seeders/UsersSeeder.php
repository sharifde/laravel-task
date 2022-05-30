<?php
  
  namespace Database\Seeders;
  
  use Illuminate\Database\Seeder;
  use App\Models\User;
  use Spatie\Permission\Models\Role;
  use Spatie\Permission\Models\Permission;
  
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin', 
            'email' => 'admin@admin.com',
            'password' => bcrypt('password')
        ]);
    
        $role = Role::create(['name' => 'Admin']);
        $permissions = Permission::pluck('id', 'id')->all();
        // dd($permissions)
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);
    }
}