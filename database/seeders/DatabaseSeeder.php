<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Expense;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Diana',
            'last_name' => 'Siebiesiewicz',
            'email' => 'diana.siebie@o2.pl',
            'password' => '1111',
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
