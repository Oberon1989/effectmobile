<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'name' => 'Created',
                'description' => 'Задача создана и ждет исполнителя'
            ],
            [
                'name' => 'InProgress',
                'description' => 'Задача в работе'
            ],
            [
                'name' => 'Completed',
                'description' => 'Задача выполнена'
            ],
        ];

        foreach ($statuses as $status) {
            Status::updateOrCreate(
                ['name' => $status['name']],
                ['description' => $status['description']]
            );
        }
    }
}
