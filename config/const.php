<?php

use App\Models\Admin;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Application Pre-defined Values
|--------------------------------------------------------------------------
 */

return [
    'grant_type' => [
        'password' => 'password',
        'refresh_token' => 'refreshToken',
    ],
    'refresh_token_lifetime' => 180,
    'regex_email_admin' => '/^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/m',
    'password_regex' => '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*\d)(?=.*[@$!%*#?&\/\\\"{}|;<>' .
        '[\]`+~=_,^()-.\:\'])[A-Za-z\d@$!%*#?&\/\\\"{}|;<>[\]`+~=_,^()-.\:\']{8,32}$/',
    'regex_telephone' => '/^([0-9]*)$/',
    'regex_identity_number' => '/^(\d{9}|\d{12})$/',
    'perPage' => 10,
    'prefix_code' => [
        'patient' => 'PA',
        'bed' => 'BED',
        'ipd_opd_patient' => 'IPD',
        'medical_device' => 'DEV'
    ],
    'format' => [
        'datetime' => 'Y-m-d H:i:s',
        'date' => 'd-m-Y',
        'date_form' => 'Y-m-d',
        'date_with_slash' => 'd/m/Y',
        'date_folder_s3' => 'Ymd'
    ],
    'application_cv_file_extension' => ['png, jpeg'],
    'retry_time' => 3,
    'auth' => [
        '3' => 'auth.role:' . User::ROLE_ADMIN_ROOT,
        '2' => 'auth.role:' . User::ROLE_DOCTOR,
        '1' => 'auth.role:' . User::ROLE_PATIENT,
        '0' => 'auth.role:' . User::ROLE_MEMBER,
    ],
    'presigned_get_lifetime' => '7 day',
    'default_password' => 'Aa@123456',
];
