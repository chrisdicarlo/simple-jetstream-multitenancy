<?php
namespace Chrisdicarlo\SimpleJetstreamMultitenancy;

use Illuminate\Database\Eloquent\Builder;

trait TenantAware
{
    public static function bootTenantAware()
    {
        if (auth()->check()) {
            $tenantModel = config('simple-jetstream-multitenancy.tenant_model');
            
            static::creating(function ($model) use ($tenantModel) {
                if ($tenantModel == 'App\Models\Team') {
                    $model->tenant_id = auth()->user()->currentTeam->id;
                } else {
                    $model->tenant_id = auth()->id();
                }
            });

            static::addGlobalScope('tenant_id', function (Builder $builder) use ($tenantModel) {
                if (auth()->check()) {
                    if ($tenantModel == 'App\Models\Team') {
                        return $builder->where('tenant_id', auth()->user()->currentTeam->id);
                    }
                    
                    return $builder->where('tenant_id', auth()->id());
                }
            });
        }
    }

    public function tenant()
    {
	return (config('simple-jetstream-multitenancy.tenant_model') == Team::class)
		? $this->belongsTo(Team::class, 'tenant_id')
		: $this->belongsTo(User::class, 'tenant_id');
    }
}
