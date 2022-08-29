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
            'username' => 'piramir77', 
            'saloon_name' => 'آفرینا', 
            'phone_number' => '09134744677', 
            'mootanroo_id' => '275284',
            'phone_number_verified_at' => now()
        ]);
    
        $role = Role::findByName('admin');
        $user->assignRole([$role->id]);


        $user = User::create([
            'first_name' => 'محسن', 
            'last_name' => 'قائم مقامی', 
            'username' => 'webgodo', 
            'type' => 'admin', 
            'saloon_name' => 'محمدی', 
            'phone_number' => '09131678992', 
            'mootanroo_id' => '272419',
            'phone_number_verified_at' => now()
        ]);
        $user->assignRole([$role->id]);


        $user = User::create([
            'first_name' => 'مرتضی', 
            'last_name' => 'پیرمرادیان', 
            'type' => 'customer', 
            'username' => 'morteza', 
            'phone_number' => '09131223228', 
            'mootanroo_id' => '12321',
            'phone_number_verified_at' => now()
        ]);


        $user = User::create([
            'first_name' => 'مهدی', 
            'last_name' => 'دشتی', 
            'username' => 'dashti', 
            'type' => 'seller', 
            'saloon_name' => 'آفرینا', 
            'phone_number' => '09131223225', 
            'mootanroo_id' => '1245433',
            'phone_number_verified_at' => now()
        ]);

    }
}