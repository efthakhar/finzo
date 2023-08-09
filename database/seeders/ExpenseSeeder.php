<?php

namespace Database\Seeders;

use App\Models\Expense;
use Error;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class ExpenseSeeder extends Seeder
{
    public $expenses = [
        [
            'id' => 1,
            'title' => 'Buying books for new semister',
            'date' => '2024-1-7',
            'description' => '',
            'category' => 6,
            'amount' => 5000,
        ],
        [
            'id' => 2,
            'title' => 'Paying House Rental for August Month',
            'date' => '2023-7-7',
            'description' => '',
            'category' => 4,
            'amount' => 20000,
        ],
        [
            'id' => 3,
            'title' => 'Restaurant Bill for Friends Meetup',
            'date' => '2020-3-2',
            'description' => '',
            'category' => 5,
            'amount' => 1200,
        ],

    ];

    public function run(): void
    {
        foreach ($this->expenses as $item) {

            try {
                $expense = Expense::create($item);
                $expense->categories()->attach($item['category']);
            } catch (Error $e) {
                Log::info('seed error: '.$e->getMessage());
            }

        }
    }
}
