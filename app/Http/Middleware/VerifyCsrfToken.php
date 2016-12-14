<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
		'stripe/*','distanceList','getDepartmentList','getStorelist','getCategoryList','getSubCategoryList','getProductList','getSingleProduct','getLatitudeCity','customerRegister','customerLogin','updateCustomer','updatePassword','customerImage','sentPassword','getCountryList','saveOrderDetails','orderDetails','orderData',
		
    ];
}
