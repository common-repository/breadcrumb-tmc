=== Breadcrumb TMC ===
Contributors: jetplugs, themastercut
Donate Link: https://jetplugs.com/
Tags: breadcrumb, trail, breadcrumb shortcode, breadcrumb trail, breadcrumb navigation, JSON-LD, Structured Data Markup,
Requires at least: 5.0
Requires PHP: 5.6
Tested up to: 6.5
Stable tag: 1.4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Use [breadcrumb-tmc] shortcode to display the breadcrumb trail.

== Description ==


Agile WordPress plugin to create breadcrumb by using shortcode [breadcrumb-tmc] to display it. We would like to keep the plugin simple and developers friendly, so far Breadcrumb TMC is location-based breadcrumb solution.

Structured Data Markup support. Output format: JSON-LD.


== How to use? ==


= Shortcode =


Just paste the shortcode [breadcrumb-tmc] into to your text editor in WordPress to display it.

` [breadcrumb-tmc] `

= PHP =

or ad anywhere you want in your theme the following line of code.

` <?php echo do_shortcode( '[breadcrumb-tmc]' ); ?> `


**HTML output**


`
 <ol class='breadcrumb-tmc'>
   <li>
      <a href="https://www.example.com/">Home</a>
   </li>
   <span class='breadcrumb-tmc-separator'> » </span>
   <li>
     <a href="https://www.example.com/hello-world">Hello World</a>
   </li>
 <ol>
 `


**FEATURES:**

* Quick use
* Displays breadcrumb
* No options page


**SUPPORT**

Your feedback is WELCOME!

== Installation ==

= Using The WordPress Dashboard =

1. Navigate to the 'Add New' in the plugins dashboard
2. Search for 'breadcrumb tmc'
3. Click 'Install Now'
4. Activate the plugin on the Plugin dashboard

= Uploading in WordPress Dashboard =

1. Navigate to the 'Add New' in the plugins dashboard
2. Navigate to the 'Upload' area
3. Select `breadcrumb-tmc.zip` from your computer
4. Click on 'Install Now' button
5. Activate the plugin in the Plugin dashboard

= Using FTP =

1. Download `breadcrumb-tmc.zip`
2. Extract the `breadcrumb-tmc.zip` directory to your computer
3. Upload the `breadcrumb-tmc` folder to the `/wp-content/plugins/` directory
4. Activate the plugin in the Plugin dashboard


== Screenshots ==

1. Basic view - shows view for single post type 'post'


== Changelog ==



= 1.4.3=
Release date: June 10, 2024
- Tested with WordPress 6.5

= 1.4.2=
Release date: June 10, 2024
- FIX: issue with SVN transfer

= 1.4.1  =
Release date: June 10, 2024
- Add: Support for Taxonomy Archive
- Tested with WordPress 6.4

= 1.4.0  =
Release date: August 29, 2022
- Add: Structured Data Markup support ( SEO friendly breadcrumb ). Output format: JSON-LD.
- Tested with WordPress 6.1
- Refactor: Change name of main class

= 1.3.9  =
Release date: June 17, 2022

- Tested with WordPress 6.0
- Refactor: getTagUrl(), getSingleLabel(), getSingleUrl()

= 1.3.8  =
Release date: March 7, 2022

- Tested with WordPress 5.9
- Refactor: Remove wp_trim_words from Home Label

= 1.3.7  =
Release date: September 24, 2021

- Add: Support for search page template
- Tested with WordPress 5.8


= 1.3.6  =
Release date: April 14, 2021

- Tested with WordPress 5.7
- Refactor: Change way of adding separator mark
- Deprecated filter: "enqueueStyles" ( instead new filter "breadcrumbTmc/enqueueStyles" )
- Apply filter: "breadcrumbTmc/enqueueStyles" - allow users to disable plugin css styles
- Add: setSeparator to all crumbs
- Add: setPriority to crumbs ( not used yet )


= 1.3.5  =
Release date: February 06, 2021

- Tested with WordPress 5.6
- Add: Support for Author template
- Add: setPriority, getPriority method ( not used yet )


= 1.3.4  =
Release date: August 11, 2020

- Tested with WordPress 5.5


= 1.3.3  =
Release date: August 04, 2020

- Add: Support for Taxonomy / turn off by default
- Add: Apply filter "breadcrumbTmc/termsNode/taxonomyName"
- Add: setSeparator method for specific nodes ( not used yet )
- FIX: homeText support for deprecated filter
- FIX: Remove unnecessary global post statement

= 1.3.2 =
Release date: July 23, 2020

- FIX: Hide node with empty url.

= 1.3.1 =
Release date: July 12, 2020

- Add: Support for posts ( page, post, custom post type) hierarchy ( if set post type to be hierarchical )
- Refactor: update library SundaWP 1.0.8

= 1.3.0 =
Release date: July 03, 2020

- Major refactor: change engine of generating breadcrumb path ( more flexible )
- Deprecated filter: "breadcrumbTmc/homeText" ( instead new filter "breadcrumbTmc/homeLabel" )
- Deprecated filter: "separatorMark_breadcrumbTmc" ( instead  new filter "breadcrumbTmc/separatorMark" )
- Apply filter: "breadcrumbTmc/homeLabel" – change the name of home text in breadcrumb trail
- Apply filter: "breadcrumbTmc/separatorMark" – change the name of home text in breadcrumb trail
- Apply filter: "breadcrumbTmc/allNodes" - allow users to change default the separator mark
- Apply filter: "breadcrumbTmc/lastNode" - Last breadcrumb node object
- Apply filter: "breadcrumbTmc/archiveNode" - Archive breadcrumb node object
- Refactor: update library SundaWP 1.0.7

= 1.2.0 =
Release date: May 18, 2020

- Refactor ( important! ): Renaming filters by adding prefix 'breadcrumbTmc'
- Remove filter from SundaWP 'homeText'
- Apply filter:  "breadcrumbTmc/homeText" - change the name of home text in breadcrumb trail
- Add: Support for Parent post
- Refactor: update library SundaWP 1.0.6

= 1.1.1 =
Release date: May 11, 2020

- Apply filter: 'endingCharacter' - gives the option to set up a character at the end of the trimmed string.

= 1.1.0 =
Release date: May 2, 2020

- Apply filter: 'trimWords' - Set breadcrumb string / title limit in Words.
- Refactor: update library SundaWP 1.0.5

= 1.0.9 =
Release date: April 10, 2020

- Apply filter: 'enqueueStyles' - allow users to disable plugin css styles (optimize seo and speed)

= 1.0.8 =
Release date: April 3, 2020

- Apply filter: 'PageNotFoundText' - allow users to change default the separator mark
- Refactor: update library SundaWP 1.0.4, change the name of home text filter 'homeText'

= 1.0.7 =
Release date: April 2, 2020

- Problem withs plugin update

= 1.0.6 =
Release date: April 2, 2020

- Refactor: Tested up to: WP 5.4
- FIX: Display breadcrumb on post archive
- FIX: Remove WarningCreating default object from empty value

= 1.0.5 =
Release date: March 29, 2020

- Add: support for '404' template
- Update: SundaWP v.1.0.3
- Refactor: change core app

= 1.0.4 =
Release date: January 31, 2020

- FIX: change name of class in if statement 'class_exists' - "use"

= 1.0.3 =
Release date: January 22, 2020

- Apply filter: 'separatorMark' - allow users to change default the separator mark
- Refactor: update library SundaWP 1.0.2, change the name of home text filter 'homeText'

= 1.0.2 =
Release date: January 15, 2020

- Refactor: change breadcrumb separator '»'
- Add class 'breadcrumb-tmc-separator' to separator element wrapper

= 1.0.1 =
Release date: January 14, 2020

- Add Post archive link for Single Post Page type 'post'

= 1.0.0 =
Release date: January 10, 2020

- First release: Breadcrumb TMC for WordPress