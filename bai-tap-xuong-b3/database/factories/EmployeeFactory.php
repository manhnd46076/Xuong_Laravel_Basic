<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name'       =>fake()->firstName       ,
            'last_name'        =>fake()->lastName        ,
            'email'            =>fake()->unique()->email()        ,
            'phone'            =>fake()->unique()->phoneNumber()         ,
            'date_of_birth'    =>fake()->date()        ,
            'hire_date'        =>fake()->dateTime()        ,
            'salary'           =>fake()->randomFloat(2,1000000,100000000)       ,
            'is_active'        =>rand(0,1)        ,
            'department_id'    =>fake()->numberBetween(1,10)        ,
            'manager_id'       =>fake()->numberBetween(1,100)       ,
            'address'          =>fake()->address      ,
            
        ];
    }
}
