<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Create permissions
        $permissions = [
            // Usuarios
            'ver usuarios',
            'crear usuarios',
            'editar usuarios',
            'eliminar usuarios',

            // Clientes
            'ver clientes',
            'crear clientes',
            'editar clientes',
            'eliminar clientes',

            // Cotizaciones
            'ver cotizaciones',
            'crear cotizaciones',
            'editar cotizaciones',
            'eliminar cotizaciones',
            'enviar cotizaciones',

            // Facturas
            'ver facturas',
            'crear facturas',
            'editar facturas',
            'eliminar facturas',
            'enviar facturas',

            // Pagos
            'ver pagos',
            'crear pagos',
            'editar pagos',
            'eliminar pagos',

            // Cuentas bancarias
            'ver cuentas bancarias',
            'crear cuentas bancarias',
            'editar cuentas bancarias',
            'eliminar cuentas bancarias',

            // Gastos
            'ver gastos',
            'crear gastos',
            'editar gastos',
            'eliminar gastos',

            // Ventas
            'ver ventas',
            'crear ventas',
            'editar ventas',
            'eliminar ventas',

            // Servicios
            'ver servicios',
            'crear servicios',
            'editar servicios',
            'eliminar servicios',

            // Proyectos
            'ver proyectos',
            'crear proyectos',
            'editar proyectos',
            'eliminar proyectos',

            // Dominios
            'ver dominios',
            'crear dominios',
            'editar dominios',
            'eliminar dominios',

            // Prospectos
            'ver prospectos',
            'crear prospectos',
            'editar prospectos',
            'eliminar prospectos',

            // Tickets
            'ver tickets',
            'crear tickets',
            'editar tickets',
            'eliminar tickets',

            // Registros de auditoría
            'ver registros de auditoría',

            // Servidores
            'ver servidores',
            'crear servidores',
            'editar servidores',
            'eliminar servidores',

            // Credenciales de servidor
            'ver credenciales de servidor',
            'crear credenciales de servidor',
            'editar credenciales de servidor',
            'eliminar credenciales de servidor',

            // Cajas
            'ver cajas',
            'crear cajas',
            'editar cajas',
            'eliminar cajas',

            // Caja chica
            'ver caja chica',
            'crear caja chica',
            'editar caja chica',
            'eliminar caja chica',

            // Suscripciones
            'ver suscripciones',
            'crear suscripciones',
            'editar suscripciones',
            'eliminar suscripciones',

            // Tareas
            'ver tareas',
            'crear tareas',
            'editar tareas',
            'eliminar tareas',

            // Roles
            'ver roles',
            'crear roles',
            'editar roles',
            'eliminar roles',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $staffRole = Role::firstOrCreate(['name' => 'staff', 'guard_name' => 'web']);
        $clientRole = Role::firstOrCreate(['name' => 'client', 'guard_name' => 'web']);

        // Assign all permissions to admin
        $adminRole->syncPermissions(Permission::all());

        // Assign some permissions to staff
        $staffPermissions = [
            'ver prospectos', 'crear prospectos', 'editar prospectos',
            'ver clientes', 'crear clientes', 'editar clientes',
            'ver servicios', 'crear servicios', 'editar servicios',
            'ver cotizaciones', 'crear cotizaciones', 'editar cotizaciones', 'enviar cotizaciones',
            'ver proyectos', 'crear proyectos', 'editar proyectos',
            'ver tareas', 'crear tareas', 'editar tareas',
            'ver facturas', 'crear facturas', 'editar facturas', 'enviar facturas',
            'ver pagos', 'crear pagos', 'editar pagos',
            'ver usuarios', 'ver roles',
            'ver registros de auditoría',
        ];
        $staffRole->syncPermissions($staffPermissions);

        // Assign limited permissions to client
        $clientPermissions = [
            'ver cotizaciones',
            'ver facturas',
            'ver pagos',
        ];
        $clientRole->syncPermissions($clientPermissions);
    }
}
