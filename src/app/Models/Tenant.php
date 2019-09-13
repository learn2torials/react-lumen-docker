<?php
/**
 * Created by PhpStorm.
 * User: sandip.patel
 * Date: 2019-09-13
 * Time: 3:34 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    /**
     * @var string
     */
    protected $table = 'tenants';

    /**
     * @return mixed
     */
    public function domains()
    {
        return $this->hasMany(TenantDomain::class);
    }

    /**
     * @return mixed
     */
    public function configs()
    {
        return $this->hasMany(TenantConfig::class);
    }
}
