<?php return function ($in, $debugopt = 1) {
    $cx = array(
        'flags' => array(
            'jstrue' => false,
            'jsobj' => false,
            'spvar' => true,
            'prop' => false,
            'method' => false,
            'mustlok' => false,
            'mustsec' => false,
            'echo' => false,
            'debug' => $debugopt,
        ),
        'constants' => array(),
        'helpers' => array(            'html' => 'Flow\TemplateHelper::htmlHelper',
            'l10nParse' => 'Flow\TemplateHelper::l10nParse',
            'diffRevision' => 'Flow\TemplateHelper::diffRevision',
),
        'blockhelpers' => array(),
        'hbhelpers' => array(),
        'partials' => array('flow_errors' => function ($cx, $in) {return '<div class="flow-error-container">
'.((LCRun3::ifvar($cx, ((isset($cx['sp_vars']['root']['errors']) && is_array($cx['sp_vars']['root'])) ? $cx['sp_vars']['root']['errors'] : null))) ? '	<div class="flow-errors errorbox">
		<ul>
'.LCRun3::sec($cx, ((isset($cx['sp_vars']['root']['errors']) && is_array($cx['sp_vars']['root'])) ? $cx['sp_vars']['root']['errors'] : null), $in, true, function($cx, $in) {return '				<li>'.LCRun3::ch($cx, 'html', array(array(((isset($in['message']) && is_array($in)) ? $in['message'] : null)),array()), 'encq').'</li>
';}).'		</ul>
	</div>
' : '').'</div>
';},),
        'scopes' => array($in),
        'sp_vars' => array('root' => $in),

    );
    
    return '<div class="flow-board">
'.LCRun3::p($cx, 'flow_errors', array(array($in),array())).'	<div class="flow-compare-revisions-header plainlinks">
		'.LCRun3::ch($cx, 'l10nParse', array(array('flow-compare-revisions-header-postsummary',((isset($in['revision']['new']['rev_view_links']['board']['title']) && is_array($in['revision']['new']['rev_view_links']['board'])) ? $in['revision']['new']['rev_view_links']['board']['title'] : null),((isset($in['revision']['new']['properties']['post-of-summary']) && is_array($in['revision']['new']['properties'])) ? $in['revision']['new']['properties']['post-of-summary'] : null),((isset($in['revision']['new']['rev_view_links']['board']['url']) && is_array($in['revision']['new']['rev_view_links']['board'])) ? $in['revision']['new']['rev_view_links']['board']['url'] : null),((isset($in['revision']['new']['rev_view_links']['root']['url']) && is_array($in['revision']['new']['rev_view_links']['root'])) ? $in['revision']['new']['rev_view_links']['root']['url'] : null),((isset($in['revision']['new']['rev_view_links']['hist']['url']) && is_array($in['revision']['new']['rev_view_links']['hist'])) ? $in['revision']['new']['rev_view_links']['hist']['url'] : null)),array()), 'encq').'
	</div>
	<div class="flow-compare-revisions">
		'.LCRun3::ch($cx, 'diffRevision', array(array(((isset($in['revision']['diff_content']) && is_array($in['revision'])) ? $in['revision']['diff_content'] : null),((isset($in['revision']['old']['human_timestamp']) && is_array($in['revision']['old'])) ? $in['revision']['old']['human_timestamp'] : null),((isset($in['revision']['new']['human_timestamp']) && is_array($in['revision']['new'])) ? $in['revision']['new']['human_timestamp'] : null),((isset($in['revision']['old']['author']['name']) && is_array($in['revision']['old']['author'])) ? $in['revision']['old']['author']['name'] : null),((isset($in['revision']['new']['author']['name']) && is_array($in['revision']['new']['author'])) ? $in['revision']['new']['author']['name'] : null),((isset($in['revision']['old']['rev_view_links']['single-view']['url']) && is_array($in['revision']['old']['rev_view_links']['single-view'])) ? $in['revision']['old']['rev_view_links']['single-view']['url'] : null),((isset($in['revision']['new']['rev_view_links']['single-view']['url']) && is_array($in['revision']['new']['rev_view_links']['single-view'])) ? $in['revision']['new']['rev_view_links']['single-view']['url'] : null),((isset($in['revision']['links']['previous']) && is_array($in['revision']['links'])) ? $in['revision']['links']['previous'] : null),((isset($in['revision']['links']['next']) && is_array($in['revision']['links'])) ? $in['revision']['links']['next'] : null)),array()), 'encq').'
	</div>
</div>
';
}
?>