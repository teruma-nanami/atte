<?php

namespace Database\Factories;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

     protected $model = Attendance::class;


    public function definition()
    {
        $checkIn = Carbon::instance($this->faker->dateTimeBetween('-1 month', 'now'));
        $checkOut = (clone $checkIn)->addHours(rand(1, 8));
        return [
            'user_id' => $this->faker->numberBetween(1, 100),
            'date' => $checkIn->format('Y-m-d'),
            'check_in' => $checkIn,
            'check_out' => $this->faker->boolean(80) ? $checkOut : null, // 80%の確率でcheck_outを設定
        ];
    }
}
