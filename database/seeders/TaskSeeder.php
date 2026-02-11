<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $tasks = [
            [
                'title' => 'Доработка модуля корзины',
                'description' => 'Доработать модуль корзина в проекте для обработки заказов',
                'status_id' => 1,
            ],
            [
                'title' => 'Рефакторинг API',
                'description' => 'Отрефакторить апи для работы с Yandex market',
                'status_id' => 2,
            ],
            [
                'title' => 'Настроить деплой',
                'description' => 'написать скрипт для деплоера',
                'status_id' => 1,
            ],
        ];

        foreach ($tasks as $task) {
            Task::updateOrCreate(
                ['title' => $task['title']],
                [
                    'description' => $task['description'],
                    'status_id' => $task['status_id'],
                ]
            );
        }
    }
}
