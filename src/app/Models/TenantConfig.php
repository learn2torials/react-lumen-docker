<?php
/**
 * Created by PhpStorm.
 * User: sandip.patel
 * Date: 2019-09-13
 * Time: 3:34 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenantConfig extends Model
{
    /**
     * @var string
     */
    protected $table = 'tenant_configs';

    /**
     * @return mixed
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
