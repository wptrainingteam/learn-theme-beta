Learn Site Theme Beta
===================================
##### Last updated: June 14, 2019

This is a beta theme to create a new [Learn WordPress website](https://learn.wordpress.org), a project by the [Make WordPress Training team](https://make.wordpress.org/training)

How to Get Involved
--------------------------------------

Please read the Training team's [Getting Started Guide](https://make.wordpress.org/training/handbook/getting-started/)!

Tasks that need help are noted in the *Issues* section of this repository, please let us know if you'd like to tackle one. You can fork the repository and submit your additions as a pull request.

How to set up your Local Development Site
----------------------------------------------

1. Set up a clean local installation of WordPress with your chosen tool (MAMP, WAMP, Local, etc).
2. Rename your `wp-content` folder to something easy to remember, such as `wp-content-original`.
3. Clone this repository with the command:
```bash
	git clone https://github.com/wptrainingteam/learn-theme-beta.git wp-content
```
4. In your `wp-config.php` file, add the following line above the WordPress Stop Editing comment:
```php
define( 'WPORGPATH', __DIR__ . '/wp-content/themes/' );
```
6. Now you should be able to activate the Learn Dev theme and see the homepage when you look at the front-end of the website.
7. Optionally activate the `handbook` plugin, and import the XML file located in the uploads folder to import some demonstration lesson plans. These will be updated to a lesson-plan post type shortly.

You're ready to start developing and contributing!
**All accepted changes appear on [https://learnwp.jco.dev/](https://learnwp.jco.dev/), which refreshes every 5 minutes with updates.**
