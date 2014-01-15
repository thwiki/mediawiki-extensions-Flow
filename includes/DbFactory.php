<?php

namespace Flow;

/**
 * All classes within Flow that need to access the Flow db will go through
 * this class.  Having it separated into an object greatly simplifies testing
 * anything that needs to talk to the database.
 *
 * The factory receives, in its constructor, the wiki name and cluster name
 * that flow specific data is stored on.  Multiple wiki's can and should be
 * using the same wiki name and cluster to share flow specific data. These values
 * are used.  The $wiki parameter of getDB and getLB must be null to receive
 * the flow database.
 *
 * To access core tables, use wfGetDB() etc. This is solely for Flow-specific
 * data, which may live on a separate database.
 */
class DbFactory {
	/**
	 * @var string|bool Wiki ID, or false for the current wiki
	 */
	protected $wiki;

	/**
	 * @var string|bool External storage cluster, or false for core
	 */
	protected $cluster;

	/**
	 * @var string|bool[optional] $wiki Wiki ID, or false for the current wiki
	 * @var string|bool[optional] $cluster External storage cluster, or false for core
	 */
	public function __construct( $wiki = false, $cluster = false ) {
		$this->wiki = $wiki;
		$this->cluster = $cluster;
	}

	/**
	 * @param integer $db index of the connection to get.  DB_MASTER|DB_SLAVE.
	 * @param mixed $groups query groups. An array of group names that this query
	 *   belongs to.
	 * @return \DatabaseBase
	 */
	public function getDB( $db, $groups = array() ) {
		return $this->getLB()->getConnection( $db, $groups, $this->wiki );
	}

	/**
	 * @return \LoadBalancer
	 */
	public function getLB() {
		if ( $this->cluster !== false ) {
			return wfGetLBFactory()->getExternalLB( $this->cluster, $this->wiki );
		} else {
			return wfGetLB( $this->wiki );
		}
	}

	/**
	 * Mockable version of wfGetDB.
	 *
	 * @param integer $db index of the connection to get.  DB_MASTER|DB_SLAVE.
	 * @param mixed $groups query groups. An array of group names that this query
	 *   belongs to.
	 * @param string|false $wiki The wiki ID, or false for the current wiki
	 * @return \DatabaseBase
	 */
	public function getWikiDB( $db, $groups = array(), $wiki = false ) {
		return wfGetDB( $db, $groups, $wiki );
	}

	/**
	 * Mockable version of wfGetLB.
	 *
	 * @param string $wiki wiki ID, or false for the current wiki
	 * @return \LoadBalancer
	 */
	public function getWikiLB( $wiki = false ) {
		return wfGetLB( $wiki );
	}

	/**
	 * Wait for the slaves of the Flow database
	 */
	public function waitForSlaves() {
		wfWaitForSlaves( false, $this->wiki, $this->cluster );
	}
}
