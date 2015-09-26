---
layout:     post
title:      "The Basics of Building Omeka Themes"
date:       2014-09-10
author:     Michael Tedeschi
category:   Tools and Tech
summary: |
    We regularly work with organizations and institutions to build custom Omeka themes and modules (including [Indiana University](http://interactivemechanics.com/case-studies/black-film-history/) and [Bryn Mawr College](http://interactivemechanics.com/case-studies/greenfield-digital-center/)). And through our work, we’ve found interesting tips, tricks, and processes to help us create Omeka sites that are both beautiful and engaging.

---

The Digital Humanities love [Omeka](https://omeka.org/). Omeka is an open source web platform made for libraries, museums, and archives to build collections and exhibitions. It’s easy to use, simple to install, and non-technical users can be up-and-running in a matter of minutes. It boasts some cool plugins: including the ability to [create exhibits](http://omeka.org/add-ons/plugins/exhibit-builder/), plot your items on a [map](http://omeka.org/add-ons/plugins/geolocation/), and even create fully interactive timelines with [Neatline](http://omeka.org/add-ons/plugins/neatline/). Through this series of posts, we’ll be sharing some of our experiences to get you into the code to start building your own themes.

### Getting started

The first step when building any site, regardless of platform or technology, is to focus on building something that is both useful and user-focused. As you get started with your project, ask yourself a few questions:

* Who is this site for?
* What is their motivation for using this site?
* How can the design of this site help them accomplish their goals easily?
* Before diving right into the code, doing some initial research and design of your site will help you build a better product.

### Understanding Omeka theme structure

For anyone not familiar with development, jumping into theme development can be daunting. There are a lot of files, confusing code, and not a lot of documentation to explain what everything does. To help make it easier to get started, we created a starter Omeka theme built on Twitter Bootstrap for you to use. The theme is unstyled, but responsive to work cross-device and platform—we’ve also added some useful comments in here to help you better understand the code on your own. [Download the theme from GitHub](https://github.com/InteractiveMechanics/Omeka-Starter-Theme), unzip it to your Omeka installation’s theme directory, and take a look at what’s included. First, let’s take a look at the structure:

{% highlight c %}

omeka-starter-theme
-- collections
-- common
-- config.ini
-- css
-- custom.php
-- functions.php
-- images
-- index.php
-- items
-- javascripts
-- search
-- theme.ini
-- theme.jpg

{% endhighlight %}


That might seem like a lot of files, so let’s go through and customize step-by-step.

Open up **theme.ini**. This file contains the information about your theme: who is it for, what is it called, and other information you typically see when you’re installing or selecting a theme in Omeka. Some of this should be obvious (title, author, description, etc), but some might not be as obvious, like omeka_minimum_version and omeka_target_version. To ensure the theme is supported and continuously updated, these version numbers give other developers and Omeka an idea of what version of Omeka to use this theme with. If you’re working with the latest version, you can use 2.2.2 (the current version as of the writing of this article). But if you’re building a theme for a legacy version of Omeka, you should note that here. Save your work, and let’s move on.

Let’s take a look at the theme out of the box. There is a header area for navigation, a content area to render our page templates, and a footer. If you haven’t already, now is a great time to think about how you want your custom theme to look. What customization options do you need for the theme? What content are you looking to showcase with your site? What do your visitors or users need to meet their goals?

Open **config.ini** next. This file contains all of the custom configuration options specific to your theme. These can control a range of features and functions. Out of the box, Omeka allows you to include free-form textareas, input fields, select lists, files, and checkbox toggle buttons (if this isn’t enough, we’ll also talk about how to extend these options in another post). We added some defaults and samples of each to start, but take a look at the “Sample Text Input” option:

{% highlight c %}

; Sample Text Area
sample_textarea.type = "textarea"
sample_textarea.options.label = "Sample Textarea"
sample_textarea.options.description = "This is a sample textarea..."
sample_textarea.options.rows = "5"
sample_textarea.options.attribs.class = "html-input"

{% endhighlight %}

We’re going to customize this config option for the homepage, so let’s modify it to work for us. We should adjust the name of the plugin to match where we’ll use it: on the homepage for “about this site” text. We’ll need to change the identifier before the period in each line, and then we can customize the different options. We’ll get into what all of the options mean in another article—for now, we’ll leave the options the same. Here is what it should look like:

{% highlight c %}

; Our custom homepage "about" text
homepage_about.type = "textarea"
homepage_about.options.label = "Homepage About Text"
homepage_about.options.description = "Our custom homepage about text"
homepage_about.options.rows = "5"
homepage_about.options.attribs.class = "html-input"

{% endhighlight %}

![Adding a custom textarea in your Omeka theme](/images/uploads/basic-omeka-themes.png)

Now that we have our custom field, we’ll update our homepage by editing index.php. Omeka homepages generally include a few common elements, including featured or random items, collections, and exhibits. Out of the box, Omeka supports these handful of features—but we’re not limited to just those options. For example, let’s add our “about” text block from **config.ini** to this page. Find where you want this block of text to go, and add: `echo get_theme_option('Homepage About');`

We’ll jump into the “common” directory next and explore **header.php** and **footer.php**. These file are included into the page templates when you call the `head()` and `foot()` functions. They accept a few parameters: adjusting the page title, adding IDs and classes to the body element or page, or even point a page to a specific header or footer file (see below).

{% highlight php startinline %}

echo head(array('title' => 'My Page Title','bodyclass' => 'collection page'), 'header-alternative.php');

{% endhighlight %}

In our **header.php** file, you’ll notice all of the typical HTML structure included at the top of your page. You’ll notice it’s easy to add your own CSS and JavaScript files using the queue file and queue url functions:

{% highlight php startinline %}

queue_js_url('http://code.jquery.com/jquery-1.11.0.min.js');
queue_js_file('lib/bootstrap.min');

{% endhighlight %}

We can adjust any number of items in the header and footer files. You can add or modify the title of your site, change the navigation layout, and add some custom features to your footer. We can add configuration options to control whether or not to display content areas or add our own custom copyright information.

### What’s next?

We’ve only scratched the surface of what you can do to customize your Omeka theme, and we have plenty more to share. If you have a particular question or request about a topic, we’d love to [hear your thoughts](/contact/) or start a discussion on [Twitter](https://twitter.com/interactivemech)!