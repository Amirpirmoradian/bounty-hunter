<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use App\Models\User;
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
            'first_name' => 'امیر', 
            'last_name' => 'پیرمرادیان', 
            'type' => 'admin', 
            'phone_number' => '09134744677', 
            'mootanroo_id' => '275284',
            'phone_number_verified_at' => now()
        ]);
    
        $role = Role::findByName('admin');
        $user->assignRole([$role->id]);


        $user = User::create([
            'first_name' => 'محسن', 
            'last_name' => 'قائم مقامی', 
            'type' => 'admin', 
            'phone_number' => '09131678992', 
            'mootanroo_id' => '272419',
            'phone_number_verified_at' => now()
        ]);
        $user->assignRole([$role->id]);

    }
}