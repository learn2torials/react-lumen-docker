<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\TenantDomain;
use Illuminate\Http\Request;

class TenantMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $currentHost = $request->header('host');
        $tenantDomain = \Cache::remember($currentHost, 60, function () use ($currentHost) {
            return TenantDomain::where('domain', $currentHost)->first();
        });

        if(!$tenantDomain) {
            abort(403);
        }

        $tenant = $tenantDomain->tenant;
        $request->request->add(['tenant' => $tenant]);

        $moduleConfigs = \Cache::remember('tenant-configs', 60, function () use ($tenant) {
            $moduleConfigs = [];
            $tenantConfigs = $tenant->configs()->get();
            foreach ($tenantConfigs as $tenantConfig) {
                $moduleConfigs[$tenantConfig->module][$tenantConfig->module_key] = $tenantConfig->module_value;
            }
            return $moduleConfigs;
        });

        config($moduleConfigs);

        return $next($request);
    }
}
