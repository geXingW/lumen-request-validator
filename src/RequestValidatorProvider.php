<?php
/**
 * Created by PhpStorm.
 * User: WangSF
 * Date: 2017/11/17 0017
 * Time: 16:36
 */

namespace GeXingW\LumenValidator;

use GeXingW\LumenValidator\Request\ValidatorRequest;
use Illuminate\Support\ServiceProvider;

class RequestValidatorProvider extends ServiceProvider
{
    public function boot()
    {

        /**
         * Add GeXingW\LumenValidator\Request\ApiRequest resolving event.
         * 1.Prepare for the request validation
         * 2.Handle Request validation
         */
        $this->app->afterResolving(ValidatorRequest::class, function (ValidatorRequest $request, $app) {

            /**
             * Setup current request validations
             * 1. Setup rules
             * 2. Setup messages
             * 3. Setup attributes
             */
            $request->_setupRequestValidation();

            /**
             * Handle current request validations.
             */
            $request->_validate();

        });

    }
}