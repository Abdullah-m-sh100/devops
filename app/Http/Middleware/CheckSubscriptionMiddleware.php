<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Subscription\Models\Subscription;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscriptionMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $tenantId = tenant('id');

        if (! $tenantId) {
            return $next($request);
        }

        $subscription = Subscription::on(config('tenancy.database.central_connection'))
            ->where('tenant_id', $tenantId)
            ->latest('starts_at')
            ->first();

        abort_if(! $subscription?->isActive(), 403, 'This company subscription is not active.');

        return $next($request);
    }
}
