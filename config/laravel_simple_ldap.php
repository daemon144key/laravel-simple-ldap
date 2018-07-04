<?php

return [
    'ldap_host' => env('SIMPLE_LDAP_HOST', ''),

    'ldap_port' => env('SIMPLE_LDAP_HOST', 389),

    'ldap_base_dn' => env('SIMPLE_LDAP_BASE_DN', ''),

    'ldap_password' => env('SIMPLE_LDAP_PASSWORD', ''),

    'ldap_user_rdn' => env('SIMPLE_LDAP_USER_RDN', 'cn=Manager')
];
