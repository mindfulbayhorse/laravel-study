<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Deliverable;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\WorkBreakdownStructure;

class UserFactory extends Factory
{
    protected $model = Deliverable::class;
    public function definition()
    {
        return [ 
            'title' => $thi->faker->sentence(3, true)
        ];
    }
     
}
