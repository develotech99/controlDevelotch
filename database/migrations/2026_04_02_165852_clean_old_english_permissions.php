<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Lista de permisos antiguos en inglés a eliminar
        $oldPermissions = [
            'view prospects', 'create prospects', 'edit prospects', 'delete prospects',
            'view clients', 'create clients', 'edit clients', 'delete clients',
            'view services', 'create services', 'edit services', 'delete services',
            'view quotes', 'create quotes', 'edit quotes', 'delete quotes',
            'view projects', 'create projects', 'edit projects', 'delete projects',
            'view tasks', 'create tasks', 'edit tasks', 'delete tasks',
            'view invoices', 'create invoices', 'edit invoices', 'delete invoices',
            'view payments', 'create payments', 'edit payments', 'delete payments',
            'view users', 'create users', 'edit users', 'delete users',
            'view roles', 'create roles', 'edit roles', 'delete roles',
            'view audit logs',
            'view bank accounts', 'create bank accounts', 'edit bank accounts', 'delete bank accounts',
            'view expenses', 'create expenses', 'edit expenses', 'delete expenses',
            'view sales', 'create sales', 'edit sales', 'delete sales',
            'view domains', 'create domains', 'edit domains', 'delete domains',
            'view tickets', 'create tickets', 'edit tickets', 'delete tickets',
            'view servers', 'create servers', 'edit servers', 'delete servers',
            'view server credentials', 'create server credentials', 'edit server credentials', 'delete server credentials',
            'view cash boxes', 'create cash boxes', 'edit cash boxes', 'delete cash boxes',
            'view petty cash', 'create petty cash', 'edit petty cash', 'delete petty cash',
            'view subscriptions', 'create subscriptions', 'edit subscriptions', 'delete subscriptions',
        ];

        // Eliminar permisos antiguos
        DB::table('permissions')->whereIn('name', $oldPermissions)->delete();

        // También eliminar las relaciones en role_has_permissions
        DB::table('role_has_permissions')
            ->whereNotIn('permission_id', function ($query) {
                $query->select('id')->from('permissions');
            })
            ->delete();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No se puede revertir fácilmente, ya que los permisos se eliminaron
        // En producción, se debería hacer backup antes de ejecutar esta migración
    }
};
