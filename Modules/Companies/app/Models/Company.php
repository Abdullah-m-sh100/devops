<?php

namespace Modules\Companies\Models;

use Modules\Subscription\Models\Subscription;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Models\Domain;
use Stancl\Tenancy\Database\Models\Tenant;

class Company extends Tenant implements TenantWithDatabase
{
    use HasDatabase;

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'name',
            'email',
            'phone',
            'status',
            'created_at',
            'updated_at',
        ];
    }

    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'status',
        'data',
    ];

    public function domains()
    {
        return $this->hasMany(Domain::class, 'tenant_id');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'tenant_id');
    }

    public function activeSubscription()
    {
        return $this->hasOne(Subscription::class, 'tenant_id')->latestOfMany();
    }
}
