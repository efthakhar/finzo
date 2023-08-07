<?php

namespace Database\Seeders;

use App\Models\Income;
use Error;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class IncomeSeeder extends Seeder
{
    public $incomes = [
        [
            'id' => 1,
            'title' => 'tution salary received',
            'date' => '2023-7-7',
            'description' => '',
            'category' => 1,
            'amount' => 5000,
        ],
        [
            'id' => 2,
            'title' => 'boss paid part time job salary',
            'date' => '2023-7-7',
            'description' => '',
            'category' => 2,
            'amount' => 13040.30,
        ],
        [
            'id' => 3,
            'title' => 'earned dollar from fiverr',
            'date' => '2023-7-7',
            'description' => '',
            'category' => 3,
            'amount' => 12000,
        ],

    ];

    public function run(): void
    {
        foreach ($this->incomes as $item) {

            try {
                $income = Income::create($item);
                $income->categories()->attach($item['category']);
            } catch (Error $e) {
                Log::info('seed error: '.$e->getMessage());
            }

        }
    }
}
