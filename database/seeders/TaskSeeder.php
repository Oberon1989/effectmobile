<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $tasks= [
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
                ['title' => $tasks['title']],
                ['description' => $tasks['description']],
                ['status_id' => $tasks['status_id']]
            );
        }
    }
}
