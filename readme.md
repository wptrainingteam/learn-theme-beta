Learn Site Theme Beta
===================================
##### Last updated: June 1, 2019

This is a beta theme to create a new [Learn WordPress website](https://learn.wordpress.org), a project by the [Make WordPress Training team](https://make.wordpress.org/training)

How to Get Involved
--------------------------------------

Please read the Training team's [Getting Started Guide](https://make.wordpress.org/training/handbook/getting-started/)!

Tasks that need help are noted in the *Issues* section of this repository, please let us know if you'd like to tackle one. You can fork the repository and submit your additions as a pull request.

How to set up your Local Development Site
----------------------------------------------

1. Set up a clean local installation of WordPress with your chosen tool (MAMP, WAMP, Local, etc).
2. Checkout this `repository` into your `themes` folder.
3. In your `themes` folder, create a new file called `header.php` and add the following code to it:

```php
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en">
<head profile="http://gmpg.org/xfn/11">
<meta charset="utf-8" />
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-P24PF4B');</script>
<!--
<meta property="fb:page_id" content="6427302910" />
-->
<link rel="dns-prefetch" href="//s.w.org" />
<link rel="dns-prefetch" href="//fonts.googleapis.com" />
<link rel="dns-prefetch" href="//fonts.gstatic.com" />
<link rel="dns-prefetch" href="//www.googletagmanager.com" />
<meta name="google-site-verification" content="7VWES_-rcHBcmaQis9mSYamPfNwE03f4vyTj4pfuAw0" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>WordPress</title>
<meta name="referrer" content="always">

			<link href="//s.w.org/wp-includes/css/dashicons.min.css?20181204" rel="stylesheet" type="text/css" />
		<link href='//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,400,300,600&subset=latin,cyrillic-ext,greek-ext,greek,vietnamese,latin-ext,cyrillic' rel='stylesheet' type='text/css'>

		<link rel="stylesheet" href="//s.w.org/style/wp4.css?78" />

<link rel="shortcut icon" href="//s.w.org/favicon.ico?2" type="image/x-icon" />
<script type="text/javascript" src="//s.w.org/wp-includes/js/jquery/jquery.js?v=1.11.1"></script>
<script>document.cookie='devicePixelRatio='+((window.devicePixelRatio === undefined) ? 1 : window.devicePixelRatio)+'; path=/';</script>

</head>


<body id="wordpress-org" >
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P24PF4B" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<div id="wporg-header">
	<div class="wrapper">
		<h1><a href="//wordpress.org">WordPress.org</a></h1>				<div id="head-search">
		<form action="//wordpress.org/search/do-search.php" method="get">
			<label for="global-search" class="screen-reader-text">Search WordPress.org for:</label>
			<input id="global-search" class="text" name="search" type="text" value="" maxlength="150" placeholder="Search WordPress.org" />
			<button type="submit" class="button"><span class="screen-reader-text">Submit</span></button>
		</form>
		</div>
				<div style="clear:both"></div>
		<button id="mobile-menu-button" aria-expanded="false"><span class="screen-reader-text">Toggle Menu</span></button>
		
<nav aria-label="Main Menu">
<ul id="wporg-header-menu">
<li class="menu-item"><a href='//wordpress.org/showcase/' data-title='See some of the sites built on WordPress.'>Showcase</a></li>
<li class="menu-item"><a href='//wordpress.org/themes/' data-title='Find just the right look for your website.'>Themes</a></li>
<li class="menu-item"><a href='//wordpress.org/plugins/' data-title='Plugins can extend WordPress to do almost anything you can imagine.'>Plugins</a></li>
<li class="menu-item"><a href='//wordpress.org/mobile/' data-title='Take your website on the go!'>Mobile</a></li>
<li class="menu-item"><a href='//wordpress.org/support/' data-title='Forums, documentation, help.'>Support</a><ul class="nav-submenu"><li><a href='//wordpress.org/support/' title='Documentation, tutorials, best practices.'>Documentation</a></li><li><a href='//wordpress.org/support/forums/' title='Support and discussion forums.'>Forums</a></li></ul><div class="uparrow"></div></li>
<li class="menu-item"><a href='//make.wordpress.org/' data-title='Contribute your knowledge.'>Get Involved</a></li>
<li class="menu-item"><a href='//wordpress.org/about/' data-title='About the WordPress Organization, and where we&#039;re going.'>About</a></li>
<li class="menu-item"><a href='//wordpress.org/news/' data-title='Come here for the latest scoop.'>Blog</a></li>
<li class="menu-item"><a href='//wordpress.org/hosting/' data-title='Find a home for your blog.'>Hosting</a></li>
<li id="download" class="button download-button menu-item"><a href='//wordpress.org/download/' data-title='Get it. Got it? Good.'>Get WordPress</a></li>
</ul>
</nav>
		<div style="clear:both"></div>
	</div>
</div>

<?php wp_head(); ?>

```

4. Also in your `themes` folder, create another file called `footer.php` and add the following code to it:
```php
<div id="wporg-footer">
	<div class="wrapper">
		<ul>
			<li><a href="//wordpress.org/about/" title="An introduction to the WordPress project">About</a></li>
			<li><a href="//wordpress.org/news/" title="News and Updates">Blog</a></li>
			<li><a href="//wordpress.org/hosting/" title="Recommended web hosting providers">Hosting</a></li>
			<li><a href="https://wordpressfoundation.org/donate/" title="Donate to the WordPress Foundation">Donate</a></li>
		</ul>

		<ul>
			<li><a href="//wordpress.org/support/" title="Forums, documentation, and other resources">Support</a></li>
			<li><a href="//developer.wordpress.org" title="Resources for WordPress developers">Developers</a></li>
			<li><a href="//make.wordpress.org/" title="Give back to WordPress through code, support, translation and more">Get Involved</a></li>
		</ul>

		<ul>
			<li><a href="//wordpress.org/showcase/" title="Some of the best WordPress sites on the Web">Showcase</a></li>
			<li><a href="//wordpress.org/plugins/" title="Add extra functionality to WordPress">Plugins</a></li>
			<li><a href="//wordpress.org/themes/" title="Make your WordPress pretty">Themes</a></li>
		</ul>

		<ul>
			<li><a href="//central.wordcamp.org/" title="Find a WordPress event near you">WordCamp</a></li>
			<li><a href="//wordpress.tv/" title="Videos, tutorials, and WordCamp sessions">WordPress.TV</a></li>
			<li><a href="//buddypress.org/" title="A set of plugins to transform your WordPress into a social network">BuddyPress</a></li>
			<li><a href="//bbpress.org/" title="Fast, slick forums built on WordPress">bbPress</a></li>
		</ul>

		<ul>
			<li><a href="//wordpress.com/?ref=wporg-footer" title="Hassle-free WordPress hosting">WordPress.com</a></li>
			<li><a href="//ma.tt/" title="Co-founder of WordPress, an example of what WordPress can do">Matt</a></li>
			<li><a href="//wordpress.org/about/privacy/" title="WordPress.org Privacy Policy">Privacy</a></li>
			<li><a href="https://publiccode.eu/" target="_blank">Public Code</a></li>
		</ul>

		<ul>
			<li><span class="dashicons dashicons-twitter"></span><a href="https://twitter.com/WordPress" title="Follow @WordPress on Twitter">@WordPress</a></li>
			<li><span class="dashicons dashicons-facebook"></span><a href="https://www.facebook.com/WordPress/" title="Like WordPress on Facebook">WordPress</a></li>
		</ul>
	</div>

		<p class="cip cip-image">Code is Poetry.</p>
</div>

<script src="https://s.w.org/style/js/navigation.min.js?20190128"></script>

<script type="text/javascript" src="https://gravatar.com/js/gprofiles.js"></script>
<?php wp_footer(); ?>
	</body>
</html>
```

5. In your `wp-config.php` file, add the following line above the WordPress Stop Editing comment:
```php
define( 'WPORGPATH', __DIR__ . '/wp-content/themes/' );
```

6. Now you should be able to activate the Learn Dev theme and see the homepage when you look at the front-end of the website.

You're ready to start develping and contributing!