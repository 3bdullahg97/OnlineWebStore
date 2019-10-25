<?php

namespace App\Providers;


use function foo\func;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Address' => \App\Policies\AddressPolicy::class,
        'App\Brand' => \App\Policies\BrandPolicy::class,
        'App\Category' => \App\Policies\CategoryPolicy::class,
        'App\ItemImage' => \App\Policies\ItemImagePolicy::class,
        'App\Item' => \App\Policies\ItemPolicy::class,
        'App\ItemSpecification' => \App\Policies\ItemSpecificationPolicy::class,
        'App\OrderItem' => \App\Policies\OrderItemPolicy::class,
        'App\Order' => \App\Policies\OrderPolicy::class,
        'App\Review' => \App\Policies\ReviewPolicy::class,
        'App\SpecificationGroup' => \App\Policies\SpecificationGroupPolicy::class,
        'App\Specification' => \App\Policies\SpecificationPolicy::class,
        'App\Transaction' => \App\Policies\TransactionPolicy::class,
        'App\User' => \App\Policies\UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}

