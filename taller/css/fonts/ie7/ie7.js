/* To avoid CSS expressions while still supporting IE 7 and IE 6, use this script */
/* The script tag referencing this file must be placed before the ending body tag. */

/* Use conditional comments in order to target IE 7 and older:
	<!--[if lt IE 8]><!-->
	<script src="ie7/ie7.js"></script>
	<!--<![endif]-->
*/

(function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'iconos\'">' + entity + '</span>' + html;
	}
	var icons = {
		'icon-alert': '&#xf02d;',
		'icon-alignment-align': '&#xf08a;',
		'icon-alignment-aligned-to': '&#xf08e;',
		'icon-alignment-unalign': '&#xf08b;',
		'icon-arrow-down': '&#xf03f;',
		'icon-arrow-left': '&#xf040;',
		'icon-arrow-right': '&#xf03e;',
		'icon-arrow-small-down': '&#xf0a0;',
		'icon-arrow-small-left': '&#xf0a1;',
		'icon-arrow-small-right': '&#xf071;',
		'icon-arrow-small-up': '&#xf09f;',
		'icon-arrow-up': '&#xf03d;',
		'icon-beer': '&#xf069;',
		'icon-book': '&#xf007;',
		'icon-bookmark': '&#xf07b;',
		'icon-briefcase': '&#xf0d3;',
		'icon-broadcast': '&#xf048;',
		'icon-browser': '&#xf0c5;',
		'icon-bug': '&#xf091;',
		'icon-calendar2': '&#xf068;',
		'icon-check': '&#xf03a;',
		'icon-checklist': '&#xf076;',
		'icon-chevron-down': '&#xf0a3;',
		'icon-chevron-left': '&#xf0a4;',
		'icon-chevron-right': '&#xf078;',
		'icon-chevron-up': '&#xf0a2;',
		'icon-circle-slash': '&#xf084;',
		'icon-circuit-board': '&#xf0d6;',
		'icon-clippy': '&#xf035;',
		'icon-clock2': '&#xf046;',
		'icon-cloud-download': '&#xf00b;',
		'icon-cloud-upload': '&#xf00c;',
		'icon-code': '&#xf05f;',
		'icon-color-mode': '&#xf065;',
		'icon-comment': '&#xf02b;',
		'icon-comment-discussion': '&#xf04f;',
		'icon-credit-card': '&#xf045;',
		'icon-dash': '&#xf0ca;',
		'icon-dashboard': '&#xf07d;',
		'icon-database': '&#xf096;',
		'icon-device-camera': '&#xf056;',
		'icon-device-camera-video': '&#xf057;',
		'icon-device-desktop': '&#xf27c;',
		'icon-device-mobile': '&#xf038;',
		'icon-diff': '&#xf04d;',
		'icon-diff-added': '&#xf06b;',
		'icon-diff-ignored': '&#xf099;',
		'icon-diff-modified': '&#xf06d;',
		'icon-diff-removed': '&#xf06c;',
		'icon-diff-renamed': '&#xf06e;',
		'icon-ellipsis': '&#xf09a;',
		'icon-eye2': '&#xf04e;',
		'icon-file-binary': '&#xf094;',
		'icon-file-code': '&#xf010;',
		'icon-file-directory': '&#xf016;',
		'icon-file-media': '&#xf012;',
		'icon-file-pdf': '&#xf014;',
		'icon-file-submodule': '&#xf017;',
		'icon-file-symlink-directory': '&#xf0b1;',
		'icon-file-symlink-file': '&#xf0b0;',
		'icon-file-text': '&#xf011;',
		'icon-file-zip': '&#xf013;',
		'icon-flame': '&#xf0d2;',
		'icon-fold': '&#xf0cc;',
		'icon-gear': '&#xf02f;',
		'icon-gift': '&#xf042;',
		'icon-gist': '&#xf00e;',
		'icon-gist-secret': '&#xf08c;',
		'icon-git-branch': '&#xf020;',
		'icon-git-commit': '&#xf01f;',
		'icon-git-compare': '&#xf0ac;',
		'icon-git-merge': '&#xf023;',
		'icon-git-pull-request': '&#xf009;',
		'icon-globe': '&#xf0b6;',
		'icon-graph': '&#xf043;',
		'icon-heart2': '&#x2665;',
		'icon-history': '&#xf07e;',
		'icon-home': '&#xf08d;',
		'icon-horizontal-rule': '&#xf070;',
		'icon-hourglass': '&#xf09e;',
		'icon-hubot': '&#xf09d;',
		'icon-inbox': '&#xf0cf;',
		'icon-info': '&#xf059;',
		'icon-issue-closed': '&#xf028;',
		'icon-issue-opened': '&#xf026;',
		'icon-issue-reopened': '&#xf027;',
		'icon-jersey': '&#xf019;',
		'icon-jump-down': '&#xf072;',
		'icon-jump-left': '&#xf0a5;',
		'icon-jump-right': '&#xf0a6;',
		'icon-jump-up': '&#xf073;',
		'icon-key2': '&#xf049;',
		'icon-keyboard': '&#xf00d;',
		'icon-law': '&#xf0d8;',
		'icon-light-bulb': '&#xf000;',
		'icon-link': '&#xf05c;',
		'icon-link-external': '&#xf07f;',
		'icon-list-ordered': '&#xf062;',
		'icon-list-unordered': '&#xf061;',
		'icon-location2': '&#xf060;',
		'icon-lock2': '&#xf06a;',
		'icon-logo-github': '&#xf092;',
		'icon-mail2': '&#xf03b;',
		'icon-mail-read': '&#xf03c;',
		'icon-mail-reply': '&#xf051;',
		'icon-mark-github': '&#xf00a;',
		'icon-markdown': '&#xf0c9;',
		'icon-megaphone2': '&#xf077;',
		'icon-mention': '&#xf0be;',
		'icon-microscope': '&#xf089;',
		'icon-milestone': '&#xf075;',
		'icon-mirror': '&#xf024;',
		'icon-mortar-board': '&#xf0d7;',
		'icon-move-down': '&#xf0a8;',
		'icon-move-left': '&#xf074;',
		'icon-move-right': '&#xf0a9;',
		'icon-move-up': '&#xf0a7;',
		'icon-mute': '&#xf080;',
		'icon-no-newline': '&#xf09c;',
		'icon-octoface': '&#xf008;',
		'icon-organization': '&#xf037;',
		'icon-package': '&#xf0c4;',
		'icon-paintcan': '&#xf0d1;',
		'icon-pencil': '&#xf058;',
		'icon-person': '&#xf018;',
		'icon-pin': '&#xf041;',
		'icon-playback-fast-forward': '&#xf0bd;',
		'icon-playback-pause': '&#xf0bb;',
		'icon-playback-play': '&#xf0bf;',
		'icon-playback-rewind': '&#xf0bc;',
		'icon-plug': '&#xf0d4;',
		'icon-plus': '&#xf05d;',
		'icon-podium': '&#xf0af;',
		'icon-primitive-dot': '&#xf052;',
		'icon-primitive-square': '&#xf053;',
		'icon-pulse': '&#xf085;',
		'icon-puzzle': '&#xf0c0;',
		'icon-question': '&#xf02c;',
		'icon-quote': '&#xf063;',
		'icon-radio-tower': '&#xf030;',
		'icon-repo': '&#xf001;',
		'icon-repo-clone': '&#xf04c;',
		'icon-repo-force-push': '&#xf04a;',
		'icon-repo-forked': '&#xf002;',
		'icon-repo-pull': '&#xf006;',
		'icon-repo-push': '&#xf005;',
		'icon-rocket': '&#xf033;',
		'icon-rss': '&#xf034;',
		'icon-ruby': '&#xf047;',
		'icon-screen-full': '&#xf066;',
		'icon-screen-normal': '&#xf067;',
		'icon-search2': '&#xf02e;',
		'icon-server': '&#xf097;',
		'icon-settings2': '&#xf07c;',
		'icon-sign-in': '&#xf036;',
		'icon-sign-out': '&#xf032;',
		'icon-split': '&#xf0c6;',
		'icon-squirrel': '&#xf0b2;',
		'icon-star2': '&#xf02a;',
		'icon-steps': '&#xf0c7;',
		'icon-stop': '&#xf08f;',
		'icon-sync': '&#xf087;',
		'icon-tag2': '&#xf015;',
		'icon-telescope': '&#xf088;',
		'icon-terminal': '&#xf0c8;',
		'icon-three-bars': '&#xf05e;',
		'icon-tools': '&#xf031;',
		'icon-trashcan': '&#xf0d0;',
		'icon-triangle-down': '&#xf05b;',
		'icon-triangle-left': '&#xf044;',
		'icon-triangle-right': '&#xf05a;',
		'icon-triangle-up': '&#xf0aa;',
		'icon-unfold': '&#xf039;',
		'icon-unmute': '&#xf0ba;',
		'icon-versions': '&#xf064;',
		'icon-x': '&#xf081;',
		'icon-zap': '&#x26a1;',
		'icon-heart': '&#xe600;',
		'icon-cloud': '&#xe601;',
		'icon-star': '&#xe602;',
		'icon-tv': '&#xe603;',
		'icon-sound': '&#xe604;',
		'icon-video': '&#xe605;',
		'icon-trash': '&#xe606;',
		'icon-user': '&#xe607;',
		'icon-key': '&#xe608;',
		'icon-search': '&#xe609;',
		'icon-settings': '&#xe60a;',
		'icon-camera': '&#xe60b;',
		'icon-tag': '&#xe60c;',
		'icon-lock': '&#xe60d;',
		'icon-bulb': '&#xe60e;',
		'icon-pen': '&#xe60f;',
		'icon-diamond': '&#xe610;',
		'icon-display': '&#xe611;',
		'icon-location': '&#xe612;',
		'icon-eye': '&#xe613;',
		'icon-bubble': '&#xe614;',
		'icon-stack': '&#xe615;',
		'icon-cup': '&#xe616;',
		'icon-phone': '&#xe617;',
		'icon-news': '&#xe618;',
		'icon-mail': '&#xe619;',
		'icon-like': '&#xe61a;',
		'icon-photo': '&#xe61b;',
		'icon-note': '&#xe61c;',
		'icon-clock': '&#xe61d;',
		'icon-paperplane': '&#xe61e;',
		'icon-params': '&#xe61f;',
		'icon-banknote': '&#xe620;',
		'icon-data': '&#xe621;',
		'icon-music': '&#xe622;',
		'icon-megaphone': '&#xe623;',
		'icon-study': '&#xe624;',
		'icon-lab': '&#xe625;',
		'icon-food': '&#xe626;',
		'icon-t-shirt': '&#xe627;',
		'icon-fire': '&#xe628;',
		'icon-clip': '&#xe629;',
		'icon-shop': '&#xe62a;',
		'icon-calendar': '&#xe62b;',
		'icon-wallet': '&#xe62c;',
		'icon-vynil': '&#xe62d;',
		'icon-truck': '&#xe62e;',
		'icon-world': '&#xe62f;',
		'0': 0
		},
		els = document.getElementsByTagName('*'),
		i, c, el;
	for (i = 0; ; i += 1) {
		el = els[i];
		if(!el) {
			break;
		}
		c = el.className;
		c = c.match(/icon-[^\s'"]+/);
		if (c && icons[c[0]]) {
			addIcon(el, icons[c[0]]);
		}
	}
}());