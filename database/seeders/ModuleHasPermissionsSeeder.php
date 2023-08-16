<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Modules;
use Spatie\Permission\Models\Permission;
use App\Models\Module_Has_Permissions;

class ModuleHasPermissionsSeeder extends Seeder
{
    public function run()
    {
        $modules = Modules::all();
        $permissions = Modules::all();

        foreach($modules as $module){
            foreach($permissions as $permission){
                if(strpos($permission->name, $module->name) == true){
                    Module_Has_Permissions::create([
                        "module_id" => $module->id,
                        "permission_id" => $permission->id
                    ]);
                }
            }
        }
    }
}