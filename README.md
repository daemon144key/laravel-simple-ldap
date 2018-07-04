# Laravel Simple LDAP #

## Description ##
Provide simple wrapping class to LDAP services.

## Setup / Initiation ##
* Install packages
```
composer require daemon144key/laravel-simple-ldap
```
* Add to app/config.php
```
<?php
return [
	// ...
    'providers' => [
    	// ...
        TuxDaemon\LaravelSimpleLdap\LaravelSimpleLdapServiceProvider::class
    ],
    'aliases' => [
    	// ...
        'LDAP'      => TuxDaemon\LaravelSimpleLdap\Services\Facades\LdapService::class,
    ],
];
```
* Optimize
```
php artisan optimize
```
* Set up config with default environment variabel key (LDAP Server hostname / ip-address, LDAP Server Port, Base Distinguished Name/DN, and administrator level user Relative-DN & password) or publish config for further configuration
```
SIMPLE_LDAP_HOST=
SIMPLE_LDAP_PORT=389
SIMPLE_LDAP_BASE_DN=
SIMPLE_LDAP_PASSWORD=
SIMPLE_LDAP_USER_RDN=
```
or
```
php artisan vendor:publish --tag=laravel-simple-ldap-config
```
then edit in config/laravel_simple_ldap.php

## Services Usages ##
* First Initiate Connection
```
LDAP::connnect()
```
* Binding Users
```
LDAP::bindUser($optionalUserRDN = "");
```
* Search based on filters
```
LDAP::search ($filter, $extendedBaseDN = ""); 
```
* Add Record
```
LDAP::add($rdn, $data);
```
* Modify Record (object level)
```
LDAP::modify($rdn, $data);
```
* Modify Record (object attribute level)
```
LDAP::modifyReplace($rdn, $data);
```
* Delete Record
```
LDAP::delete($rdn);
```
* Finally Close Connection
```
LDAP::close();
```

## Sample Usages ##
```
<?php
	// .....
	if (LDAP::connnect())
	{
		// Bind to LDAP
		$bind			= LDAP::bindUser();

		// Search in LDAP
		$inputFilter["gender"] = "male";
		$result			= LDAP::search ($inputFilter, "ou=people"); 
		info($result);

		// Add to LDAP
		$data["objectclass"][0]	= "orgPerson";
		$data["objectclass"][1]	= "orgEmail";
		$data["objectclass"][2]	= "orgProxyClient";	
		$data["userpassword"] 	= 'secret';
		$data["usingstatus"]	= "TRUE";
		$data["gender"]			= "male";
		$data["homedir"]		= "/home/someperson";
		$addResult = LDAP::add("orgAccountID=someperson,ou=people", $data);
		info($addResult);

		// Modify Data in LDAP
		$data["gender"]			= "female";
		$modifyResult = LDAP::modify("orgAccountID=someperson,ou=people", $data);
		info($modifyResult);

		// Delete Data in LDAP
		$deleteResult = LDAP::delete("orgAccountID=someperson,ou=people");
		info($deleteResult);
		
		// Close Connection in LDAP
		LDAP::close();
	} else {
		return "Can't connect to LDAP!";
	}
	// .....
```

## License ##
The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
