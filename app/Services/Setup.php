<?php
namespace App\Services;

use Illuminate\Support\Facades\Artisan;
use App\Models\Role;
use App\Models\Permission;

class Setup
{
    /**
     * Create Roles
     * @return void
    **/

    public function createRoles()
    {
        // User Role
        $this->role                 =   new Role;
        $this->role->name           =   __( 'User' );
        $this->role->namespace      =   'user';
        $this->role->description    =   __( 'Basic user role.' );
        $this->role->save(); 

        // Admin Role
        $this->role                 =   new Role;
        $this->role->name           =   __( 'Admin' );
        $this->role->namespace      =   'admin';
        $this->role->description    =   __( 'Advanced role which can access to the dashboard manage settings.' );
        $this->role->save(); 

        // Master User
        $this->role                 =   new Role;
        $this->role->name           =   __( 'Super Admin' );
        $this->role->namespace      =   'master';
        $this->role->description    =   __( 'Master role which can perform all actions like create users, install/update/delete modules and much more.' );
        $this->role->save(); 
    }

    /**
     * Migrate
     * @return void
    **/

    public function createTables()
    {
        Artisan::call( 'migrate:refresh' );
    }

    /**
     * Create Permissions
     * @return void
    **/

    public function createPermissions()
    {
        // Crud for users and options
        foreach( [ 'users', 'options', 'profile' ] as $permission ) {
            foreach( [ 'create', 'read', 'update', 'delete' ] as $crud ) {
                // Create User
                $this->permission                   =   new Permission;
                $this->permission->name             =   ucwords( $crud ) . ' ' . ucwords( $permission );
                $this->permission->namespace        =   $crud . '@' . $permission;
                $this->permission->description      =   sprintf( __( 'Can %s %s' ), $crud, $permission );
                $this->permission->save();
            }
        }

        foreach( [ 'modules' ] as $permission ) {
            foreach( [ 'install', 'enable', 'disable', 'update', 'delete' ] as $crud ) {
                // Create User
                $this->permission                   =   new Permission;
                $this->permission->name             =   ucwords( $crud ) . ' ' . ucwords( $permission );
                $this->permission->namespace        =   $crud . '@' . $permission;
                $this->permission->description      =   sprintf( __( 'Can %s %s' ), $crud, $permission );
                $this->permission->save();
            }
        }

        // for core update
        $this->permission                   =   new Permission;
        $this->permission->name             =   __( 'Update Core' );
        $this->permission->namespace        =   'update@core';
        $this->permission->description      =   __( 'Can update core' );
        $this->permission->save();
    }

    /**
     * Assign Permission to roles
     * @return void
    **/

    public function assignPermissions()
    {
        Role::AddPermissions( 'master', [ 
            'manage@options', 
            'manage@users', 
            'manage@profile', 
            'install@modules', 
            'enable@modules',
            'disable@modules',
            'update@modules',
            'delete@modules' 
        ]);

        Role::AddPermissions( 'admin', [ 
            'manage@options', 
            'manage@users', 
            'manage@profile' 
        ]);

        Role::AddPermissions( 'user', [ 
            'manage@profile' 
        ]);
    }

    /**
     * Save Environment
     * @return void
    **/


}