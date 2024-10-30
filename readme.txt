=== Plugin Name ===
Contributors: Gerald S. Fuller, Sam Wilson
Donate link: http://geraldsfuller.com/donations/
Tags: contacts, people, lists, addresses
Requires at least: 2.1
Tested up to: 3.8.1
Stable tag: 1.1.4

A simple address book plugin.  View addresses in the admin back-end or embedded
in a post or page.

== Description ==

A simple address book plugin.

You can view and edit addresses (names, addresses, phone numbers, email
addresses, etc.) in the administration interface (under Manage > Little Black
Book), or embed a read-only, semantically marked-up, list of addresses in posts
and/or pages. You can embed a list of your addresses in a blog post or page by
putting `~LBB~` wherever you want the list to appear. The generated HTML is
semantically marked-up, so you can fine-tune it's appearance through your
theme's stylesheet. Here are the entries I use:

/*----:[ Little Black Book styles]:----*/
.timediff { color:red }
.name, .address, .homephone, .cellphone { font-family:"Courier New"; font-weight:bold; font-size:larger; }
.homephone { color:blue; }
.cellphone { color:green; }
.notes { font-family:Arial, sans-serif; font-size:smaller; }

== Installation ==

1. Upload the `LBB` directory to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.

== Upgrading ==

There is no need to de-activate and then re-activate Addressbook to upgrade.

== Download ==

The latest version is always available from the <a title="LBB"
 href="http://wordpress.org/extend/plugins/lbb-little-black-book/" target="_blank">WordPress Plugin Repository</a>.

== Donate ==
If you feel so inclined, a donation in any amount would be greatly appreciated.

<form style="text-align: left;" action="https://www.paypal.com/cgi-bin/webscr" enctype="application/x-www-form-urlencoded" method="post"><input name="cmd" type="hidden" value="_xclick" /> <input name="business" type="hidden" value="jerryf@cox.net" /> <input name="item_name" type="hidden" value="LBB Wordpress Plugin" /> <input name="no_shipping" type="hidden" value="0" /> <input name="no_note" type="hidden" value="1" /> <input name="currency_code" type="hidden" value="USD" /> <input name="tax" type="hidden" value="0" /> <input name="lc" type="hidden" value="US" /> <input name="bn" type="hidden" value="PP-DonationsBF" /> <input alt="Make payments with PayPal - it's fast, free and secure!" name="submit" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" type="image" /> <img src="https://www.paypal.com/en_US/i/scr/pixel.gif" border="0" alt="" width="1" height="1" />
</form>


== Version History ==
1.0 First version in the repository

1.1.1 Changed the background color of the contact area for use with Wordpress 2.5

1.1.2 Restored normal colors for the Edit and Delete links in the contact area.
	(Thanks to John Marcotte)

1.1.3 Added "Cell: " when the cellphone is not blank to make it clear,
	especially when printed.

1.1.4 In listings, added a <br /> after the email addresses so the website appears on a
separate line. (Requested by Aaron Patrick Michaud)
