<?php

namespace App\Services\Seo;

use Spatie\SchemaOrg\Schema as Builder;

class Schema
{
    public function company()
    {
        return Builder::localBusiness()
            ->name(__('company.name'))
            ->email(__('company.email'))
            ->telephone(__('company.telephone'))
            ->url(url('/'))
            ->address(Builder::postalAddress()
                ->streetAddress(__('company.address'))
                ->postalCode(__('company.postal'))
                ->addressLocality(__('company.city'))
                ->addressCountry('BE'))
            ->sameAs([
                __('company.googleMyBusinessUrl'),
            ]);
    }
}
