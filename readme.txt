=== Simple TTIW List ===
Contributors: dartiss
Donate link: http://tinyurl.com/bdc4uu
Tags: paypal, donate, money
Requires at least: 2.0.0
Tested up to: 2.7
Stable tag: 1.0

Simple TTIW List is a WordPress plugin that displays a list of the items that you are after, as provided by the TheThingsIWant.com website.

== Description ==

You must be signed up to TTIW (http://www.thethingsiwant.com) to use this plugin.

When you sign into one of your lists you'll notice an XML/RSS 2 icon on the left. If you right click on this and select "Properties" then the provided link URL should be in the following format...

`http://www.thethingsiwant.com/rss/username/list/listname/`

Where username and listname are the details you need to note down for use in this plugin.

To display your want list on your WordPress site you will need to insert the following code, where appropriate, into your theme…

`<?php simple_ttiw_list('username','listname','limit'); ?>`

Where..

`username` : This is your TTIW username and must be specified

`listname` : This is the name of your list, as mentioned above. Again, this must be specified.

`limit` : The number of items to display from 1 to 99 (default is 99)

This will then display the list of wanted items in an HTML list (i.e. with `<li>` and `</li>` around each entry).

An example would be...

`<?php simple_ttiw_list('testuser','testlist','20'); ?>`

This would display a list of the 20 most recent wanted items for user "testuser" and list "testlist".

The following is an example of how it could be used, with a `function_exists` check so that it doesn't cause problems if the plugin is not active...

`<?php if (function_exists('simple_ttiw_list')) : ?>`
`<h2>The Things I Want</h2>`
`<ul><?php simple_ttiw_list('testuser','testlist','20'); ?></ul>`
`<?php endif; ?>`

== Installation ==

1. Upload the entire simple-ttiw-list folder to your wp-content/plugins/ directory.
2. Activate the plugin through the ‘Plugins’ menu in WordPress.
3. There is no options screen - configuration is done in your code.

== Frequently Asked Questions ==

= Can I display the list in another order? =

Sadly, the XML format provided by TTIW is in date order only and the required fields that will allow me to sequence it by, say, the order in which you have it on your lists is not provided.

I could re-sequence it by other data in the XML file (e.g. alphabetically) but as these files contain the whole of your list - and you can have 100's, 1000's of items on it - then it's more than likely going to slow down your WordPress by reading the whole list in and re-sorting it each time.

= How can I get help or request possible changes =

Feel free to report any problems, or suggestions for enhancements, to me either via my contact form or by the plugins homepage at http://www.artiss.co.uk/simple-ttiw-list