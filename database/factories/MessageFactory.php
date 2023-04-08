<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userIds = User::pluck('id');
        if(count($userIds) >= 10) {
            $userId = $userIds->random();
        }else {
            $userId = rand(1, 30);
        }
        return [
            'from' => $userId,
            'to' =>  $userId,
            'message' => $this->faker->text(20),
            'is_read'=>rand(0,1),
        ];
    }
}
