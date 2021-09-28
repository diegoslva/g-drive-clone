<?php
namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
  public function run()
  {
    $permissions = [
      [
        'id'    => 1,
        'name' => 'user_management_access',
        'text' => 'Gerente',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id'    => 2,
        'name' => 'permission_create',
        'text' => 'Permissão de criacao ',
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'id'    => 3,
        'name' => 'permission_edit',
        'text' => 'Permissão para editar',
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'id'    => 4,
        'name' => 'permission_show',
        'text' => 'Permissão visualização',
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'id'    => 5,
        'name' => 'permission_delete',
        'text' => 'Permissão deletar',
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'id'    => 6,
        'name' => 'permission_access',
        'text' => 'Permissão para acessar',
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'id'    => 12,
        'name' => 'folder_create',
        'text' => 'Permissão para criar pastas',
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'id'    => 13,
        'name' => 'folder_edit',
        'text' => 'Permissão para editar',
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'id'    => 14,
        'name' => 'folder_show',
        'text' => 'Permissão para visualizar pastas',
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'id'    => 15,
        'name' => 'folder_delete',
        'text' => 'Permissão para deletar pastas',
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'id'    => 16,
        'name' => 'folder_access',
        'text' => 'Permissão acessar pastas',
        'created_at' => now(),
        'updated_at' => now()
      ]
    ];

    Permission::insert($permissions);
  }
}
