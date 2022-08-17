<?php
namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\DataSheet;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name'            => 'Admin',
            'email'           => 'admin',
            'password' => Hash::make('01140404211'),
        ]);

        $data = DataSheet::create([
            'visitors'=>0,
            'projects'=>0,
            'status_v'=>0,
            'ststus_p'=>0
        ]);
    }
}
