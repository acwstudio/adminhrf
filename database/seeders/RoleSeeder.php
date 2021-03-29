<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Clear and fill roles table
        DB::unprepared("TRUNCATE roles RESTART IDENTITY;");

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

        // Clear and fill permissions table
        DB::unprepared("TRUNCATE permissions RESTART IDENTITY;");

        $permissions = [
            [
                'id' => 1,
                'name' => 'global',
                'description' => 'Может управлять всеми ресурсами'
            ],
            [
                'id' => 2,
                'name' => 'section:read',
                'description' => 'Может управлять всеми ресурсами раздела читать'
            ],
            [
                'id' => 3,
                'name' => 'section:watch',
                'description' => 'Может управлять всеми ресурсами раздела смотреть'
            ],
            [
                'id' => 4,
                'name' => 'section:listen',
                'description' => 'Может управлять всеми ресурсами раздела слушать'
            ],
            [
                'id' => 5,
                'name' => 'manage:articles',
                'description' => 'Может управлять ресурсом СТАТЬИ'
            ],
            [
                'id' => 6,
                'name' => 'manage:news',
                'description' => 'Может управлять ресурсом НОВОСТИ'
            ],
            [
                'id' => 7,
                'name' => 'manage:courses',
                'description' => 'Может управлять ресурсом КУРСЫ'
            ],
            [
                'id' => 8,
                'name' => 'manage:biographies',
                'description' => 'Может управлять ресурсом БИОГРАФИИ'
            ],
            [
                'id' => 9,
                'name' => 'manage:documents',
                'description' => 'Может управлять ресурсом ДОКУМЕНТЫ'
            ],
            [
                'id' => 10,
                'name' => 'manage:authors',
                'description' => 'Может управлять ресурсом АВТОРЫ'
            ],

        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }



    }
}
