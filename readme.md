Learn Site Theme Beta
===================================
##### Last updated: 5 August, 2019

This is a beta theme to create a new [Learn WordPress website](https://learn.wordpress.org), a project by the [Make WordPress Training team](https://make.wordpress.org/training)

How to Get Involved
--------------------------------------

Please read the Training team's [Getting Started Guide](https://make.wordpress.org/training/handbook/getting-started/)!

Tasks that need help are noted in the *Issues* section of this repository, please let us know if you'd like to tackle one. You can fork the repository and submit your additions as a pull request.

How to set up your Local Development Site
----------------------------------------------

1. Set up a clean local installation of WordPress with your chosen tool (MAMP, WAMP, Local, VVV, etc).
2. Rename your `wp-content` folder to something easy to remember, such as `wp-content-original`.
3. Clone this repository with the command:
```bash
git clone https://github.com/wptrainingteam/learn-theme-beta.git wp-content
```
4. In your `wp-config.php` file, add the following lines above the WordPress Stop Editing comment:
```php
define( 'WPORGPATH', __DIR__ . '/wp-content/themes/' );
define( 'JETPACK_DEV_DEBUG', true );
```
5. Now you should be able to activate the Learn Theme Beta and see the homepage when you look at the front-end of the website.
6. Activate all of the plugins, and import the XML file located in the uploads folder to import lesson plans and handbook articles.
7. Optionally, you can wait 15-30 minutes (make sure to load the website in your browser to trigger WP Cron) and the lessons will be imported via the WPOrg-Learn plugin, or you can manually import them with WP-CLI:
```bash
wp cron event run wporg_learn_manifest_import
wp cron event run wporg_learn_markdown_import
```
8. Activate the JetPack modules __Contact Form__ and __Markdown__
```bash
wp jetpack module activate contact-form
wp jetpack module activate markdown
```

You're ready to start developing and contributing!
**All accepted changes to the master branch appear on [https://learnwp.jco.dev/](https://learnwp.jco.dev/), which refreshes every 5 minutes with updates.**
