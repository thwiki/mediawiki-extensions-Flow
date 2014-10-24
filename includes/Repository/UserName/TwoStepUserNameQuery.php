<?php
/**
 * Provide usernames filtered by per-wiki ipblocks. Batches together
 * database requests for multiple usernames when possible.
 */
namespace Flow\Repository\UserName;

use Flow\DbFactory;
use Flow\Exception\FlowException;

/**
 * Helper query for UserNameBatch fetches requested userIds
 * from the wiki with two independent queries.  There is
 * a different implementation that does this in one query
 * with a join.
 *
 * @todo Is TwoStep usefull? shouldn't we always use the join?
 */
class TwoStepUserNameQuery implements UserNameQuery {
	public function __construct( DbFactory $dbFactory ) {
		$this->dbFactory = $dbFactory;
	}

	/**
	 * Look up usernames while respecting ipblocks with two queries
	 *
	 * @param string $wiki
	 * @param array $userIds
	 * @return \ResultWrapper|bool
	 * @throws FlowException
	 */
	public function execute( $wiki, array $userIds ) {
		if ( !$wiki ) {
			throw new FlowException( 'No wiki provided with user ids' );
		}

		$dbr = $this->dbFactory->getWikiDB( DB_SLAVE, array(), $wiki );
		$res = $dbr->select(
			'ipblocks',
			'ipb_user',
			array(
				'ipb_user' => $userIds,
				'ipb_deleted' => 1,
			),
			__METHOD__
		);
		if ( !$res ) {
			return $res;
		}
		$blocked = array();
		foreach ( $res as $row ) {
			$blocked[] = $row->ipb_user;
		}
		// return ids in $userIds that are not in $blocked
		$allowed = array_diff( $userIds, $blocked );
		if ( !$allowed ) {
			return false;
		}
		return $dbr->select(
			'user',
			array( 'user_id', 'user_name' ),
			array( 'user_id' => $allowed ),
			__METHOD__
		);
	}
}
