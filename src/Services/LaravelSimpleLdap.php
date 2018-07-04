<?php

namespace TuxDaemon\LaravelSimpleLdap\Services;

use TuxDaemon\LaravelSimpleLdap\Services\Contracts\LdapService;

// LDAP Interface class (using LDAP library function - php_ldap.dll)
// OBJECT INSTANTIATION OPERATION LEVEL :
// CONSTRUCT >> CONNECT >> BIND >> ADD|SEARCH|MODIFY|DELETE >> CLOSE >> DESTRUCT
class LaravelSimpleLdap implements LdapService
{
	/* ===== DATA MEMBER ===== */ 
	protected $host; 
	protected $port;
	protected $userRDN;
	protected $baseDN;
	protected $passwd;
	protected $link;
  
	/* ===== METHOD MEMBER ===== */
	/*
	 * CONSTRUCTOR : Base attributes initiation for LDAP connection
	 */
	public function __construct()
	{
		$this->host 	= config('laravel_simple_ldap.ldap_host');
		$this->port		= config('laravel_simple_ldap.ldap_port');
		$this->userRDN = config('laravel_simple_ldap.ldap_user_rdn');
		$this->baseDN 	= config('laravel_simple_ldap.ldap_base_dn');
		$this->passwd 	= config('laravel_simple_ldap.ldap_password');		
	}
  
  	/**
  	 * Initiate connection to LDAP server
  	 **/
	public function connect()
	{
		$this->link	= ldap_connect($this->host, $this->port)
					  or die ("Can't connect to ". $this->host . ":". $this->port . "!");
		return $this->link;
	}
  
  	/**
  	 * Binding user to LDAP Server 
  	 **/
	public function bindUser($userRdn = "")
	{
		$bind		= ldap_bind($this->link,((trim($userRdn) != "") ? $userRdn : $this->userRDN) . "," . $this->baseDN, $this->passwd);
		return $bind;
	}
	
	/**
	 * Add node to DIT of LDAP
	 **/
	public function add($rdn, $info)
	{
		$add 	= ldap_add($this->link, $rdn . "," . $this->baseDN, $info);
		return $add;
	}

	/**
	 * Binding user to LDAP server and do filter based on RFC 4515
	 **/
	public function search($filter, $extendedBaseDN = "")
	{
		$search	= ldap_search($this->link, ((trim($extendedBaseDN) != "") ? $extendedBaseDN."," : "").$this->baseDN, $filter);
		$result	= ldap_get_entries($this->link, $search);
		return $result;
	}
	
	/**
	 * Modify node on DIT in LDAP (object level)
	 **/
	public function modify($rdn, $info)
	{
		$modify	= ldap_modify($this->link, $rdn . "," . $this->baseDN, $info);
		return $modify;
	}
	
	/**
	 * Modify node on DIT in LDAP (attribute level)
	 **/
	public function modifyReplace($rdn, $info)
	{
		$modify	= ldap_mod_replace($this->link, $rdn . "," . $this->baseDN, $info);
		return $modify;
	}
	
	/**
	 * Delete node on DIT in LDAP
	 **/
	public function delete($rdn)
	{
		$delete = ldap_delete($this->link, $rdn . "," . $this->baseDN);
		return $delete;
	}

	/**
	 * Close connection to LDAP server 
	 **/
	public function close()
	{
		ldap_close($this->link);
	}
}
