<?php

// config for Maylancer/Paystack

return [

    /**
     * Paystack enviroment prod|test
     *
     */
    'production' => getenv('PAYSTACK_PAYMENT_URL'),


    /**
     * Secret Key From Paystack Dashboard
     *
     */
    'secretKey' => getenv('PAYSTACK_SECRET_KEY'),


    /**
     * Optional email address of the merchant
     *
     */
    'encryption_key' => getenv('PAYSTACK_ENCRYPTION_KEY'),



];
