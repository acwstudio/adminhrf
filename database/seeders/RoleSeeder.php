<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create([
            'id' => 1,
            'role' => 'admin',
            'name' => 'Администратор',
            'description' => 'Обладает полными правами и может управлять всем функционалом сервиса'
        ]);

        $redactor = Role::create([
            'id' => 2,
            'role' => 'redactor',
            'name' => 'Редактор',
            'description' => 'Ограниченный доступ к административной бэкенд-части сервиса, публикация,
            редактирование и удаление контента, модерация комментариев и управление пользователями'
        ]);
    }
}
