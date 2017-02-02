<?php

namespace App\Services\Seo;

use Spatie\SchemaOrg\Schema as Builder;

class Schema
{
    public function company()
    {
        return Builder::localBusiness()
            ->name(fragment('company.name'))
            ->email(fragment('company.email'))
            ->telephone(fragment('company.telephone'))
            ->url(url('/'))
            ->address(Builder::postalAddress()
                ->streetAddress(fragment('company.address'))
                ->postalCode(fragment('company.postal'))
                ->addressLocality(fragment('company.city'))
                ->addressCountry('BE')
            )
            ->sameAs([
                fragment('company.googleMyBusinessUrl'),
            ]);
    }
}
