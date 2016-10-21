---
layout:     post
title:      "Drupal 8: The Good, The Not-so-good, and The Still Coming"
date:       2016-10-03
author:     Michael Tedeschi
category:   Tools and Tech
thumb:      "/images/uploads/drupal-good-bad-thumb.png"
summary: |
    We've had the opportunity to use Drupal 8  on a handful of projects since its release last November. While our general impression of the latest version is favorable, we've had our ups and downs. As you consider using D8 on your upcoming projects, here are the features that we love, some problem areas, and our experience on recent work.

---

### The Good
Overall, Drupal 8 has a large number of obvious and behind-the-scenes improvements. D8 features a lot of modules we love now available out-of-the-box: [Views](https://www.drupal.org/node/2287909), [WYSIWYG editors](https://amsterdam2014.drupal.org/session/ckeditor-drupal-8-new-possibilities.html), a variety of field types, and [multi-language support](http://www.drupal8multilingual.org/) to name a few. Having these modules built into the core system means that they're stable, reliable, and immediately available. The Breakpoint and [Responsive Images](https://www.drupal.org/docs/8/mobile-guide/responsive-images-in-drupal-8) modules make your responsive sites more powerful by serving up appropriately sized images on different screen sizes&mdash;particularly useful when you have lots of rich media that could bog down smartphones or tablets. Faster loading on mobile devices was especially important for our work with Scribe Video Center&mdash;[Great Migration](http://interactivemechanics.com/work/great-migration/) audiences were often accessing information on the go, at a project installation or event. 

![...](/images/uploads/drupal-good-bad-01.png) 

[Web services](https://www.drupal.org/developing/api/8/rest), another useful core feature, allows you to easily use site content in a custom web app, an interactive exhibit, or a mobile app. We used this module for Scribe Video Center's Great Migration website to generate the data for the oral history map, and later to build the endpoints for filterable timeline entries for [History of Vaccines](http://www.historyofvaccines.org/timeline). This gives the content editors for these projects more control over what displays in these dynamic interactive elements without touching any code.

We're also able to use Drupal exclusively for content management, completely decoupled from the front-end experience of the site. We're currently working with the People's Emergency Center on an interactive map of West Philadelphia's Lancaster Avenue. We're building the mapping application&mdash;using HTML, CSS, and JavaScript with Mapbox.js&mdash;completely separate from Drupal, and used the Web Services module so their staff can use Drupal to maintain the project's data. This gives PEC the ability to add new points to the map over time, or update the existing information as they further their research.

![...](/images/uploads/drupal-good-bad-02.png)

### The Not-so-good
Our experience with Drupal 8 has had some issues along the way. Drupal still doesn't have a good built-in multimedia management system like WordPress. The [third-party modules](https://www.drupal.org/project/file_browser) that add this feature have been in development for the last few months, which means that upgrades and their dependencies are temperamental. When migrating the History of Vaccines website from Drupal 6 to Drupal 8, these modules led to a number of errors, incompatibilities between the various modules, and unexpected behavior. We've kept a close eye on the updates being released for these modules to ensure that they continue to function as expected.

Drupal 8's Migrate module, while useful, is far from perfect. The Migrate module has a known issue attempting to move files and relationships from older versions of Drupal. If you're looking to “automagically” migrate your website from an older version, be wary that there are likely going to be holes in your migrated content that need to be checked and filled in manually (or through separate database queries).

And, updating your version of Drupal between minor versions to ensure the system is secure still requires some technical know-how. If you're looking to get around this, it's worth considering installing your applications using cPanel or Plesk, or a dedicated Drupal hosting provider, like [Pantheon](https://pantheon.io/) for one-click updates.

### The Still Coming
While a number of modules agreed to upgrade to D8 with the full release in 2015, there are still plenty of plugins that haven't been ported over. Drupal's built-in Migrate module is useful for importing data, but the Feeds module that we've used on plenty of past projects are still in unstable beta. The Panels module is actively being developed and aims to launch a stable version in the coming months. So, it's likely that some of those specific modules you may have used in your older Drupal sites may not be available.

While we're looking to see more of these modules make their way to Drupal 8, we're hopeful that the next few months will see a number of improvements to the core system and third-party modules. As more plugins are finalized and released, D8 will become a more viable option for projects that require complex integrations. How have you used Drupal 8 on your projects? [Share your story with us on Twitter](http://twitter.com/interactivemech)!
