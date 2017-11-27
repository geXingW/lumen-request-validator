<?php

namespace GeXingW\LumenValidator\Request;

use GeXingW\Exceptions\RequestValidatorSetupException;
use GeXingW\LumenValidator\Interfaces\RequestValidatorInterface;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

/**
 * Created by PhpStorm.
 * User: WangSF
 * Date: 2017/11/20 0020
 * Time: 17:00
 */
class ValidatorRequest extends Request implements RequestValidatorInterface
{
    use ProvidesConvenienceMethods;

    protected $_rules = [];

    protected $_messages = [];

    protected $_attributes = [];

    /**
     * Get custom rules for validator errors.
     *
     * @return array
     */
    protected function _rules(): array
    {
        return [];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    protected function _messages(): array
    {
        return [];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    protected function _attributes(): array
    {
        return [];
    }

    /**
     * Set validator rules by accessing request instance.
     *
     * @param array $_rules
     */
    public function _setRules(array $_rules = [])
    {
        $this->_rules = array_merge($this->_rules(), $_rules);
    }

    /**
     * Set validator messages by accessing request instance.
     *
     * @param array $_messages
     */
    public function _setMessages(array $_messages = [])
    {
        $this->_messages = array_merge($this->_messages(), $_messages);
    }

    /**
     * Set validator rules by accessing request instance.
     *
     * @param array $_attributes
     */
    public function _setAttributes(array $_attributes = [])
    {
        $this->_attributes = array_merge($this->_attributes(), $_attributes);
    }

    /**
     * Setup request validator:
     * 1.Setup validation rules
     * 2.Setup validation messages
     * 3.Setup validation attributes
     *
     * @throws RequestValidatorSetupException
     */
    public function _setupRequestValidation()
    {
        try {

            $this->_setRules();

            $this->_setMessages();

            $this->_setAttributes();

        } catch (\RuntimeException $e) {

            // Throw \GeXingW\Exceptions\ValidatorRequestSetupException
            throw new RequestValidatorSetupException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Handle this request validator
     */
    public function _validate()
    {

        $validator = $this->_getValidatorInstance();

        $this->_setupRequestValidation();

        /**
         * Call lumen validation.
         */
        $validator = $validator->make($this->all(), $this->_rules, $this->_messages, $this->_attributes);

        if ($validator->fails()) {
            $this->throwValidationException($this->instance(), $validator);
        }
    }

    /**
     * Get validator instance
     * @return \Laravel\Lumen\Application|mixed
     */
    protected function _getValidatorInstance()
    {
        return app('validator');
    }

}