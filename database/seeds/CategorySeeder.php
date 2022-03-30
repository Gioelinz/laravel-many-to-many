<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['label' => 'HTML', 'color' => 'danger'],
            ['label' => 'CSS', 'color' => 'info'],
            ['label' => 'JS ES6', 'color' => 'warning'],
            ['label' => 'VueJS', 'color' => 'success'],
            ['label' => 'PHP', 'color' => 'primary'],
            ['label' => 'SQL', 'color' => 'secondary'],
            ['label' => 'Laravel', 'color' => 'danger'],
        ];

        foreach ($categories as $category) {
            $c = new Category();
            $c->label = $category['label'];
            $c->color = $category['color'];
            $c->save();
        }
    }
}
