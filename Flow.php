<?php
/**
 * MediaWiki Extension: Flow
 *
 * Flow, a discussion system for MediaWiki
 * Copyright (C) 2013-2015 Flow contributors
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 * ---
 * Older parts of Flow are also available under the terms:
 *
 * ---
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * This program is distributed WITHOUT ANY WARRANTY.
 * ---
 *
 * Third-party libraries are under their own licenses.  See vendor and modules/vendor.
 */

/**
 *
 * @file
 * @ingroup Extensions
 */

// Extension credits that will show up on Special:Version
$wgExtensionCredits['other'][] = array(
	'path' => __FILE__,
	'name' => 'Flow',
	'url' => 'https://www.mediawiki.org/wiki/Extension:Flow',
	'author' => array(
		// Alphabetical by last name
		'Erik Bernhardson',
		'Stephane Bisson',
		'Matthew Flaschen',
		'Andrew Garrett',
		'Shahyar Ghobadpour',
		'Pau Giner',
		'Roan Kattouw',
		'Chris McMahon',
		'Kunal Mehta',
		'Matthias Mullie',
		'S Page',
		'Jon Robson',
		'Moriel Schottlender',
		'Benny Situ',
	),
	'descriptionmsg' => 'flow-desc',
	'license-name' => 'GPL-2.0+', // Appears with link to COPYING on Special:Version
	'version' => '1.1',
);

require_once __DIR__ . '/defines.php';

// Only matters when $wgCapitalLinks has non-default setting, but always safe
$wgCapitalLinkOverrides[NS_TOPIC] = true;

define( 'CONTENT_MODEL_FLOW_BOARD', 'flow-board' );
$wgNamespacesWithSubpages[NS_TOPIC] = false;
$wgNamespaceContentModels[NS_TOPIC] = CONTENT_MODEL_FLOW_BOARD;

$dir = __DIR__ . '/';
require $dir . 'Resources.php';

$wgHooks['ResourceLoaderRegisterModules'][] = 'FlowHooks::onResourceLoaderRegisterModules';
$wgHooks['BeforePageDisplay'][] = 'FlowHooks::onBeforePageDisplay';

$wgMessagesDirs['Flow'] = __DIR__ . '/i18n';
$wgExtensionMessagesFiles['FlowNamespaces'] = $dir . '/Flow.namespaces.php';

// This file is autogenerated by scripts/gen-autoload.php
require __DIR__ . '/autoload.php';

$wgAPIModules['flow-parsoid-utils'] = 'Flow\Api\ApiParsoidUtilsFlow';
$wgAPIModules['flow'] = 'Flow\Api\ApiFlow';
$wgAPIPropModules['flowinfo'] = 'Flow\Api\ApiQueryPropFlowInfo';

// Special:Flow
$wgExtensionMessagesFiles['FlowAlias'] = $dir . 'Flow.alias.php';
$wgSpecialPages['Flow'] = 'Flow\Specials\SpecialFlow';
$wgSpecialPages['EnableFlow'] = 'Flow\Specials\SpecialEnableFlow';

// Housekeeping hooks
$wgHooks['LoadExtensionSchemaUpdates'][] = 'FlowHooks::getSchemaUpdates';
$wgHooks['GetPreferences'][] = 'FlowHooks::onGetPreferences';
$wgHooks['UnitTestsList'][] = 'FlowHooks::getUnitTests';
$wgHooks['OldChangesListRecentChangesLine'][] = 'FlowHooks::onOldChangesListRecentChangesLine';
$wgHooks['ChangesListInsertArticleLink'][] = 'FlowHooks::onChangesListInsertArticleLink';
$wgHooks['ChangesListInitRows'][] = 'FlowHooks::onChangesListInitRows';
$wgHooks['EnhancedChangesList::getLogText'][] = 'FlowHooks::onGetLogText';
$wgHooks['EnhancedChangesListModifyLineData'][] = 'FlowHooks::onEnhancedChangesListModifyLineData';
$wgHooks['EnhancedChangesListModifyBlockLineData'][] = 'FlowHooks::onEnhancedChangesListModifyBlockLineData';
$wgHooks['SkinTemplateNavigation::Universal'][] = 'FlowHooks::onSkinTemplateNavigation';
$wgHooks['Article::MissingArticleConditions'][] = 'FlowHooks::onMissingArticleConditions';
$wgHooks['SpecialWatchlistGetNonRevisionTypes'][] = 'FlowHooks::onSpecialWatchlistGetNonRevisionTypes';
$wgHooks['UserGetReservedNames'][] = 'FlowHooks::onUserGetReservedNames';
$wgHooks['ResourceLoaderGetConfigVars'][] = 'FlowHooks::onResourceLoaderGetConfigVars';
$wgHooks['ContribsPager::reallyDoQuery'][] = 'FlowHooks::onContributionsQuery';
$wgHooks['DeletedContribsPager::reallyDoQuery'][] = 'FlowHooks::onDeletedContributionsQuery';
$wgHooks['ContributionsLineEnding'][] = 'FlowHooks::onContributionsLineEnding';
$wgHooks['DeletedContributionsLineEnding'][] = 'FlowHooks::onDeletedContributionsLineEnding';
$wgHooks['ApiFeedContributions::feedItem'][] = 'FlowHooks::onContributionsFeedItem';
$wgHooks['AbuseFilter-computeVariable'][] = 'FlowHooks::onAbuseFilterComputeVariable';
$wgHooks['AbortEmailNotification'][] = 'FlowHooks::onAbortEmailNotification';
$wgHooks['EchoAbortEmailNotification'][] = 'FlowHooks::onEchoAbortEmailNotification';
$wgHooks['BeforeEchoEventInsert'][] = 'FlowHooks::onBeforeEchoEventInsert';
$wgHooks['ArticleEditUpdateNewTalk'][] = 'FlowHooks::onArticleEditUpdateNewTalk';
$wgHooks['InfoAction'][] = 'FlowHooks::onInfoAction';
$wgHooks['SpecialCheckUserGetLinksFromRow'][] = 'FlowHooks::onSpecialCheckUserGetLinksFromRow';
$wgHooks['CheckUserInsertForRecentChange'][] = 'FlowHooks::onCheckUserInsertForRecentChange';
$wgHooks['SkinMinervaDefaultModules'][] = 'FlowHooks::onSkinMinervaDefaultModules';
$wgHooks['IRCLineURL'][] = 'FlowHooks::onIRCLineURL';
$wgHooks['WhatLinksHereProps'][] = 'FlowHooks::onWhatLinksHereProps';
$wgHooks['ResourceLoaderTestModules'][] = 'FlowHooks::onResourceLoaderTestModules';
$wgHooks['ShowMissingArticle'][] = 'FlowHooks::onShowMissingArticle';
$wgHooks['MessageCache::get'][] = 'FlowHooks::onMessageCacheGet';
$wgHooks['WatchArticle'][] = 'FlowHooks::onWatchArticle';
$wgHooks['UnwatchArticle'][] = 'FlowHooks::onWatchArticle';
$wgHooks['CanonicalNamespaces'][] = 'FlowHooks::onCanonicalNamespaces';
$wgHooks['MovePageIsValidMove'][] = 'FlowHooks::onMovePageIsValidMove';
$wgHooks['AbortMove'][] = 'FlowHooks::onAbortMove';
$wgHooks['TitleMove'][] = 'FlowHooks::onTitleMove';
$wgHooks['TitleMoveComplete'][] = 'FlowHooks::onTitleMoveComplete';
$wgHooks['TitleSquidURLs'][] = 'FlowHooks::onTitleSquidURLs';
$wgHooks['WatchlistEditorBuildRemoveLine'][] = 'FlowHooks::onWatchlistEditorBuildRemoveLine';
$wgHooks['WatchlistEditorBeforeFormRender'][] = 'FlowHooks::onWatchlistEditorBeforeFormRender';
$wgHooks['NamespaceIsMovable'][] = 'FlowHooks::onNamespaceIsMovable';
$wgHooks['CategoryViewer::doCategoryQuery'][] = 'FlowHooks::onCategoryViewerDoCategoryQuery';
$wgHooks['CategoryViewer::generateLink'][] = 'FlowHooks::onCategoryViewerGenerateLink';
$wgHooks['ArticleConfirmDelete'][] = 'FlowHooks::onArticleConfirmDelete';
$wgHooks['ArticleDelete'][] = 'FlowHooks::onArticleDelete';
$wgHooks['ArticleUndelete'][] = 'FlowHooks::onArticleUndelete';
$wgHooks['SearchableNamespaces'][] = 'FlowHooks::onSearchableNamespaces';

// Extension:UserMerge support
$wgHooks['UserMergeAccountFields'][] = 'FlowHooks::onUserMergeAccountFields';
$wgHooks['MergeAccountFromTo'][] = 'FlowHooks::onMergeAccountFromTo';

// Special case: Flow is the successor to LiquidThreads and any Flow boards should automatically
// not be LiquidThreads talk pages.
$wgHooks['LiquidThreadsIsLqtPage'][] = 'FlowHooks::onIsLiquidThreadsPage';

// Echo integration
$wgHooks['BeforeCreateEchoEvent'][] = 'Flow\NotificationController::onBeforeCreateEchoEvent';
$wgHooks['EchoGetDefaultNotifiedUsers'][] = 'Flow\NotificationController::getDefaultNotifiedUsers';
$wgHooks['EchoGetBundleRules'][] = 'Flow\NotificationController::onEchoGetBundleRules';

// Beta feature Flow on user talk page
$wgHooks['GetBetaFeaturePreferences'][] = 'FlowHooks::onGetBetaFeaturePreferences';
$wgHooks['UserSaveOptions'][] = 'FlowHooks::onUserSaveOptions';

// Extension initialization
$wgExtensionFunctions[] = 'FlowHooks::initFlowExtension';

// Flow Content Type
$wgContentHandlers['flow-board'] = 'Flow\Content\BoardContentHandler';

// User permissions
// Added to $wgFlowGroupPermissions instead of $wgGroupPermissions immediately,
// to easily fetch Flow-specific permissions in tests/PermissionsTest.php.
// If you wish to make local permission changes, add them to $wgGroupPermissions
// directly - tests will fail otherwise, since they'll be based on a different
// permissions config than what's assumed to test.
$wgFlowGroupPermissions = array();
$wgFlowGroupPermissions['*']['flow-hide'] = true;
$wgFlowGroupPermissions['user']['flow-lock'] = true;
$wgFlowGroupPermissions['sysop']['flow-lock'] = true;
$wgFlowGroupPermissions['sysop']['flow-delete'] = true;
$wgFlowGroupPermissions['sysop']['flow-edit-post'] = true;
$wgFlowGroupPermissions['oversight']['flow-suppress'] = true;
$wgFlowGroupPermissions['suppress']['flow-suppress'] = true;
$wgFlowGroupPermissions['flow-bot']['flow-create-board'] = true;
$wgGroupPermissions = array_merge_recursive( $wgGroupPermissions, $wgFlowGroupPermissions );

// Make sure all of these are granted via OAuth in Hooks.php
$wgAvailableRights[] = 'flow-hide';
$wgAvailableRights[] = 'flow-lock';
$wgAvailableRights[] = 'flow-delete';
$wgAvailableRights[] = 'flow-suppress';
$wgAvailableRights[] = 'flow-edit-post';
$wgAvailableRights[] = 'flow-create-board';

// Register Flow import paths
$wgResourceLoaderLESSImportPaths = array_merge( $wgResourceLoaderLESSImportPaths, array(
	$dir . "modules/styles/flow.less/",
) );

// Configuration

// URL for more information about the Flow notification system
$wgFlowHelpPage = '//www.mediawiki.org/wiki/Special:MyLanguage/Extension:Flow';

// $wgFlowCluster will define what external DB server should be used.
// If set to false, the current database (wfGetDB) will be used to read/write
// data from/to. If Flow data is supposed to be stored on an external database,
// set the value of this variable to the $wgExternalServers key representing
// that external connection.
$wgFlowCluster = false;

// Database to use for Flow metadata.  Set to false to use the wiki db.  Any number of wikis can
// and should share the same Flow database.
$wgFlowDefaultWikiDb = false;

// Used for content storage.  False to store content in flow db. Otherwise a cluster or
// list of clusters to use with ExternalStore.  Provided clusters must exist in
// $wgExternalStores. Multiple clusters required for HA, so inserts can continue
// if one of the masters is down for maint or any other reason.
// ex:
//     $wgFlowExternalStore = array( 'DB://cluster24', 'DB://cluster25' );
$wgFlowExternalStore = false;

// By default, Flow will store content in HTML.  However, this requires having Parsoid up
// and running, as it'll be necessary to convert HTML to wikitext for the basic editor.
// (n.b. to use VisualEditor, you'll definitely need Parsoid, so if you do support VE,
// might as well set this to HTML right away)
// If $wgFlowParsoidURL is null, $wgFlowContentFormat will be forced to wikitext.
//
// The 'wikitext' format is likely to be deprecated in the future.
$wgFlowContentFormat = 'html'; // possible values: html|wikitext XXX bug 70148 with wikitext

// Flow Parsoid config
// THESE VARIABLES ARE DEPRECATED.
// Use the VirtualRESTService ($wgVirtualRestConfig) to configure
// Parsoid and/or RESTBase.
// Please note that this configuration is separate from VE's Parsoid config:
// you'll have to fill out these variables too if you want to use Parsoid.
$wgFlowParsoidURL = null; // also see $wgVisualEditorParsoidURL
$wgFlowParsoidPrefix = null; // also see $wgVisualEditorParsoidPrefix
$wgFlowParsoidTimeout = null; // In seconds; also see $wgVisualEditorParsoidTimeout
$wgFlowParsoidHTTPProxy = null; // see also $wgVisualEditorParsoidHTTPProxy
// Forward users' Cookie: headers to Parsoid. Required for private wikis (login required to read).
// If the wiki is not private (i.e. $wgGroupPermissions['*']['read'] is true) this configuration
// variable will be ignored.
//
// This feature requires a non-locking session store. The default session store will not work and
// will cause deadlocks when trying to use this feature. If you experience deadlock issues, enable
// $wgSessionsInObjectCache.
//
// WARNING: ONLY enable this on private wikis and ONLY IF you understand the SECURITY IMPLICATIONS
// of sending Cookie headers to Parsoid over HTTP. For security reasons, it is strongly recommended
// that $wgVisualEditorParsoidURL be pointed to localhost if this setting is enabled.
$wgFlowParsoidForwardCookies = false;

// Limits for paging
$wgFlowDefaultLimit = 10;
$wgFlowMaxLimit = 100;

// Echo notification subscription preference
$wgDefaultUserOptions['echo-subscriptions-web-flow-discussion'] = true;
$wgDefaultUserOptions['echo-subscriptions-email-flow-discussion'] = false;

// Default sort order of a topiclist view. See TopicListBlock::getFindOptions()
// for more information.
$wgDefaultUserOptions['flow-topiclist-sortby'] = 'updated';

// Default editor to use in Flow
$wgDefaultUserOptions['flow-editor'] = 'wikitext';

// Default state of the side rail
$wgDefaultUserOptions['flow-side-rail-state'] = 'expanded';

// Maximum number of users that can be mentioned in one comment
$wgFlowMaxMentionCount = 100;

// Max threading depth
$wgFlowMaxThreadingDepth = 8;

// A list of editors to use, in priority order
$wgFlowEditorList = array( 'visualeditor', 'wikitext' );

// Action details config file
require $dir . 'FlowActions.php';

// Register activity log formatter hooks
foreach( $wgFlowActions as $action => $options ) {
	if ( is_string( $options ) ) {
		continue;
	}
	if ( isset( $options['log_type'] ) ) {
		$log = $options['log_type'];

		// Some actions are more complex closures - to be added manually.
		if ( is_string( $log ) ) {
			$wgLogActionsHandlers["$log/flow-$action"] = 'Flow\Log\ActionFormatter';
		}
	}
}
// Manually add that more complex actions
$wgLogActionsHandlers['delete/flow-restore-post'] = 'Flow\Log\ActionFormatter';
$wgLogActionsHandlers['suppress/flow-restore-post'] = 'Flow\Log\ActionFormatter';
$wgLogActionsHandlers['delete/flow-restore-topic'] = 'Flow\Log\ActionFormatter';
$wgLogActionsHandlers['suppress/flow-restore-topic'] = 'Flow\Log\ActionFormatter';
$wgLogActionsHandlers['lock/flow-restore-topic'] = 'Flow\Log\ActionFormatter';
$wgLogActionsHandlers['import/lqt-to-flow-topic'] = 'Flow\Log\LqtImportFormatter';

// Register URL actions
foreach( $wgFlowActions as $action => $options ) {
	if ( is_array( $options ) && isset( $options['handler-class'] ) ) {
		$wgActions[$action] = true;
	}
}

// Set this to false to disable all memcache usage.  Do not just turn the cache
// back on, it will be out of sync with the database.  There is not yet an official
// process for re-sync'ing the cache yet, currently the per-index versions would
// need to incremented(ask the flow team).
//
// This will reduce, but not necessarily kill, performance.  The queries issued
// will be the queries necessary to fill the cache rather than only the queries
// needed to answer the request.  A bit of a refactor in ObjectManager::findMulti
// to allow query without indexes, along with adjusting container.php to only
// include the indexes when this is true, would get most of the way towards making
// this a reasonably performant option.
$wgFlowUseMemcache = true;

// The default length of time to cache flow data in memcache.  This value can be tuned
// in conjunction with measurements of cache hit/miss ratios to achieve the desired
// tradeoff between memory usage, db queries, and response time. The initial default
// of 3 days means Flow will attempt to keep in memcache all data models requested in
// the last 3 days.
$wgFlowCacheTime = 60 * 60 * 24 * 3;
// A version string appended to cache keys. Bump this if cache format or logic changes.
// Flow can be a cross-wiki database accessed by wikis running different versions of the
// Flow code; WMF sometimes overrides this globally in wmf-config/CommonSettings.php
$wgFlowCacheVersion = '4.8';

// ElasticSearch servers
$wgFlowSearchServers = array( 'localhost' );

// Flow search config setting - akin to CirrusSearch
// See CirrusSearch.php for documentation for these params, which have similar
// variable names (s/FlowSearch/CirrusSearch/)
$wgFlowSearchConnectionAttempts = 1; // see $wgCirrusSearchConnectionAttempts
$wgFlowSearchBannedPlugins = array(); // see $wgCirrusSearchBannedPlugins
$wgFlowSearchOptimizeIndexForExperimentalHighlighter = false; // see $wgCirrusSearchOptimizeIndexForExperimentalHighlighter
$wgFlowSearchMaxShardsPerNode = array(); // see $wgCirrusSearchMaxShardsPerNode
$wgFlowSearchRefreshInterval = 1; // see $wgCirrusSearchRefreshInterval
$wgFlowSearchMaintenanceTimeout = 3600; // see $wgCirrusSearchMaintenanceTimeout
$wgFlowSearchReplicas = '0-2'; // see $wgCirrusSearchReplicas
$wgFlowSearchShardCount = array( 'flow' => 4 ); // see $wgCirrusSearchShardCount
$wgFlowSearchCacheWarmers = array(); // see $wgCirrusSearchCacheWarmers
$wgFlowSearchMergeSettings = array(
	'flow' => array(
		'max_merge_at_once' => 10,
		'segments_per_tier' => 10,
		'reclaim_deletes_weight' => 2.0,
		'max_merged_segment' => '5g',
	),
); // see $wgCirrusSearchMergeSettings
$wgFlowSearchIndexAllocation = array(
	'include' => array(),
	'exclude' => array(),
	'require' => array(),
); // see $wgCirrusSearchIndexAllocation

// This allows running Flow without the search functionality.  Right now, it's because
// the search functionality isn't ready for production, but we need to test it locally.
// We can decide later (after it's in production) whether to get rid of this setting.
// For example, this controls whether ApiFlowSearch is available.
$wgFlowSearchEnabled = false;

// Custom group name for AbuseFilter
// Acceptable values:
// * a specific value for flow-specific filters
// * 'default' to use core filters; make sure they are compatible with both core
//   and Flow (e.g. Flow has no 'summary' variable to test on)
// * false to not use AbuseFilter
$wgFlowAbuseFilterGroup = 'flow';

// AbuseFilter emergency disable values for Flow
$wgFlowAbuseFilterEmergencyDisableThreshold = 0.10;
$wgFlowAbuseFilterEmergencyDisableCount = 50;
$wgFlowAbuseFilterEmergencyDisableAge = 86400; // One day.

// Timeout for Flow's AJAX requests (only affects ones that go through flow-api.js), in seconds
$wgFlowAjaxTimeout = 30;

// Actions that must pass through to MediaWiki on Flow-enabled pages
$wgFlowCoreActionWhitelist = array( 'info', 'protect', 'unprotect', 'unwatch', 'watch', 'history', 'wikilove', 'move', 'delete' );

// When set to true Flow will compile templates into their intermediate forms
// on every run.  When set to false Flow will use the versions already written
// to disk. Production should always have this set to false.
$wgFlowServerCompileTemplates = false;

// Enable/disable event logging
$wgFlowEventLogging = false;

// Enable/Disable Opt-in beta feature
$wgFlowEnableOptInBetaFeature = false;
