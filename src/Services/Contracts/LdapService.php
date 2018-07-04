<?php

namespace TuxDaemon\LaravelSimpleLdap\Services\Contracts;

interface LdapService
{
	/**
  	 * Initiate connection to LDAP server
  	 **/
	public function connect();
  
  	/**
  	 * Binding user to LDAP Server 
  	 **/
	public function bindUser($userRdn = "");
	
	/**
	 * Add node to DIT of LDAP
	 **/
	public function add($rdn, $info);

	/**
	 * Binding user to LDAP server and do filter based on RFC 4515
	 **/
	public function search($filter, $extendedBaseDN = "");
	
	/**
	 * Modify node on DIT in LDAP (object level)
	 **/
	public function modify($rdn, $info);
	
	/**
	 * Modify node on DIT in LDAP (attribute level)
	 **/
	public function modifyReplace($rdn, $info);
	
	/**
	 * Delete node on DIT in LDAP
	 **/
	public function delete($rdn);

	/**
	 * Close connection to LDAP server 
	 **/
	public function close();
}
