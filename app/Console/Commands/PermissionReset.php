<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionReset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:permission-reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resets the permissions and roles in the application, clearing all caches and truncating the relevant tables.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        DB::table('model_has_permissions')->delete();
        DB::table('model_has_roles')->delete();
        DB::table('role_has_permissions')->delete();
        Permission::query()->delete();
        Role::query()->delete();
        Artisan::call('permission:cache-reset');
        $this->info('Alle roles, permissions and caches has been reset.');
    }
}
