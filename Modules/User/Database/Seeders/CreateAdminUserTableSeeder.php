<?php

namespace Modules\User\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        

        $user = User::where('email','root@master.com')->first();
        if(!$user){
            $user = User::updateOrCreate([
                'name' => 'Admin', 
                'email' => 'root@master.com',
                'password' => bcrypt('password'),            
            ]);
        }
        
        $role = Role::updateOrCreate(['name' => 'superadmin']);
   
        $permissions = Permission::pluck('id','id')->all();
  
        $role->syncPermissions($permissions);
   
        $user->assignRole([$role->id]);
    }
}
