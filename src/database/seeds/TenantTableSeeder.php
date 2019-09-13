<?php
/**
 * Created by PhpStorm.
 * User: sandip.patel
 * Date: 2019-09-13
 * Time: 3:39 PM
 */

use Illuminate\Database\Seeder;

class TenantTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('tenants')->insert([
            'name' => 'local',
            'code' => 'local',
            'active' => true
        ]);

        DB::table('tenant_domains')->insert([
            'tenant_id' => 1,
            'domain' => 'localhost:8080',
        ]);
    }
}
