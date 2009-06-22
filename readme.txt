=== Simple TTIW List ===
Contributors: dartiss
Donate link: http://tinyurl.com/bdc4uu
Tags: paypal, donate, money
Requires at least: 2.0.0
Tested up to: 2.8
Stable tag: 2.1

Simple TTIW List is a WordPress plugin that displays a list of the items that you are after, as provided by the TheThingsIWant.com website.

== Description ==

**If you are using version 1.0 of this plugin you must update your code before using this version**

*It would appear that TheThingsIWant.com use different formats for their XML filenames, so the plugin has been updated to take that into account. Unfortunately, it rules out compatibility with the original 1.0 version of the plugin. Apologies. If you install this plugin, and were previously using version 1.0, a message will appear on your site showing that you need to upgrade the code.*

You must be signed up to TTIW (http://www.thethingsiwant.com) to use this plugin.

When you sign into one of your lists you'll notice an XML/RSS 2 icon on the left. If you right click on this and select "Copy Shortcut" or "Copy Link Location" then this will copy a filename to your clipboard. You will need this for this plugin.

To display your want list on your WordPress site you will need to insert the following code, where appropriate, into your theme…

`<?php ttiw_list('listurl','limit','priceflag'); ?>`

Where..

`listurl` : This is your TTIW list URL that you copied to your clipboard earlier and must be specified

`limit` : The number of items to display from 1 to 99 (default is 99)

`priceflag` : This indicates whether you wish to display prices on your list or not. Specify either Yes or No. Leaving this as blank will default to No.

This will then display the list of wanted items in an HTML list (i.e. with `<li>` and `</li>` around each entry).

An example would be...

`<?php ttiw_list('http://www.thethingsiwant.com/dartiss/list/davids%20list/','20','No'); ?>`

This would display a list of my 20 most recent wanted items, with no prices displayed.

The following is an example of how it could be used, with a `function_exists` check so that it doesn't cause problems if the plugin is not active...

`<?php if (function_exists('ttiw_list')) : ?>`
`<h2>The Things I Want</h2>`
`<ul><?php ttiw_list('http://www.thethingsiwant.com/dartiss/list/davids%20list/','20','No'); ?></ul>`
`<?php endif; ?>`

== Installation ==

1. Upload the entire simple-ttiw-list folder to your wp-content/plugins/ directory.
2. Activate the plugin through the ‘Plugins’ menu in WordPress.
3. There is no options screen - configuration is done in your code.

== Frequently Asked Questions ==

= Can I display the list in another order? =

Sadly, the XML format provided by TTIW is in the other of when the items were addedand the required fields that will allow me to sequence it by, say, the order in which you have it on your lists is not provided.

I could re-sequence it by other data in the XML file (e.g. alphabetically) but as these files contain the whole of your list - and you can have 100's, 1000's of items on it - then it's more than likely going to slow down your WordPress by reading the whole list in and re-sorting it each time.

= How can I get help or request possible changes =

Feel free to report any problems, or suggestions for enhancements, to me either via my contact form or by the plugins homepage at http://www.artiss.co.uk/simple-ttiw-list

== Changelog ==  
  
= 1.0 =  
* Initial release

= 2.0 =  
* The filename of the XML file is now explicitly provided
* You can display the price
* An item will not be displayed if all the quantity you wanted have been purchased
* If the remaining number of items to buy is greater than 1, the quantity will be displayed along with the item
* The "More..." link to your total list is dynamically fetched from the XML

= 2.1 = 
* Improvements in efficiency - less CPU cycles are now taken up extracting the relevant data from your TTIW lists
* If you specify a list limit of 1, the `<li>` and `</li>` tags will be suppressed. This is useful if you wish to embed the latest "wish" in the middle of a sentence.