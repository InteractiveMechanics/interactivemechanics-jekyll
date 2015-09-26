---
layout:     post
title:      "Page Templates with Omeka Simple Pages"
date:       2014-12-10
author:     Michael Tedeschi
category:   Tools and Tech
summary: |
    Building on our latest post about basic Omeka theme development, we wanted to share some code to help you extend the [Simple Pages plugin](https://omeka.org/add-ons/plugins/simple-pages/). There have been a number of requests for “page templates” to help you style or configure how different pages should look—something we’ve built into all of our projects. Here is our technique to let you override the default template.

---

Out of the box, Simple Pages gives you a single template: **show.php**. What if you’d like to customize the way certain pages look? For example, your “About our collection” page might need to look unique from the rest of your pages. In your theme folder, you’ll need to to have a `simple-pages/page` directory to override the default **show.php** page template. Let’s add some code to the top of this page:

{% highlight php startinline %}

$bodyclass = 'page simple-page';
$top = simple_pages_earliest_ancestor_page(null);

// Build appropriate page titles
if (!$top) {
    $top = get_current_record('simple_pages_page');
    $topSlug = metadata($top, 'slug');
} else {
	$title = metadata('simple_pages_page', 'title');
	$subtitle = metadata('simple_pages_page', 'title');
}
echo head(array( 'title' => $title, 
	'bodyclass' => $bodyclass, 
	'bodyid' => metadata('simple_pages_page', 'slug'),
	'subtitle' => $subtitle,
	'currentUriOverride' => url($topSlug)
));

// If there is a file that matches the slug of this page, display that as the template
// Otherwise, use the template below on show.php
$fname = dirname(__FILE__) . '/' . metadata('simple_pages_page', 'slug') . '.php';
if (is_file( $fname )):
    include( $fname );
else :

// Close your PHP tags and add your show.php content here.

endif;
echo foot();

{% endhighlight %}

This block of code creates some smarter titles based on page hierarchy, calls our standard `head()` function to build the page header, and then does a check for new page templates based on the slug. Again, the slug is the machine-readable name of the page. From our earlier example, the slug of “About our organization” might be “about” or “about-our-organization”. If there is a new template in our directory that shares that name (e.g. **about-our-organization.php**), then include that content instead of the default in **show.php**.

![How to properly set up your Omeka Simple Page files. Image contributed by Hafiz Hanif, University of Warwick](/images/uploads/page-templates-omeka.png)
 
We hope this helps you take your Omeka site to the next level! This feature could be extended in a number of different ways (for Items, Collections, or Exhibits), and is just the start of how to add some more advanced customization options into your custom Omeka theme. Questions? Tweet us at @interactivemech!