<?php
/**
 * Created by PhpStorm.
 * User: WangSF
 * Date: 2017/11/20 0020
 * Time: 17:04
 */

namespace GeXingW\LumenValidator\Interfaces;


interface RequestValidatorInterface
{

    /**
     * Set validator rules by accessing request instance.
     *
     * @param array $_rules
     */
    public function _setRules(array $_rules = []);

    /**
     * Set validator messages by accessing request instance.
     *
     * @param array $_messages
     */
    public function _setMessages(array $_messages = []);

    /**
     * Set validator rules by accessing request instance.
     *
     * @param array $_attributes
     */
    public function _setAttributes(array $_attributes = []);

}