<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Expense;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'polodev10@gmail.com',
            'password' => Hash::make('secret2'),
        ]);

        $categoryList = json_decode(file_get_contents(public_path('./categories.json')), true);

        foreach ($categoryList as $cat) {

            $cat = Category::create([
                'name' => $cat['name'],
                'description' => $cat['description']
            ]);

            if ($cat) {
                $cat->expenses()->createMany(Expense::factory(10)->make()->toArray());
            }
        }
    }
}
