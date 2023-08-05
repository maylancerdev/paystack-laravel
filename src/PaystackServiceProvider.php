<?php

namespace Maylancer\Paystack;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Maylancer\Paystack\Commands\PaystackCommand;

class PaystackServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('paystack')
            ->hasConfigFile()
            ->hasCommand(PaystackCommand::class);
    }
}
