---
layout:     post
title:      "I'm on Drupal 6—what happens now?!"
date:       2016-01-27
author:     Michael Tedeschi
category:   Tools and Tech
summary: |
    Drupal generally only supports the latest two versions of their platform. When Drupal 8 was released in November 2015, the Drupal community made the decision to no longer provide major updates for Drupal 6 to focus on the most recent versions of the system. The official stop date for Drupal 6 development is February 27th, 2016. This has left a lot of organizations with older Drupal sites worried about the sustainability and security of their websites.

---

### Why that’s a problem
Off the bat, it isn't a big deal. It isn't like Drupal 6 sites are going to magically disappear. The issue is that the Drupal developer community actively releases patches to their system to account for vulnerabilities that lead to security problems. Since the release of Drupal 6 in 2008, there have been 37 updates to Drupal core (nearly one every two months), and every single update included security improvements. Now that the community is not updating core, it’s likely that more security problems will come up over time. However, the recommendation from the Drupal community is not that you immediately update your website—rather, if you’re building a new site, it’s a good decision to use the latest version.

### Why this isn't a HUGE problem
The Drupal CMS has a huge open source community. While the community’s focus will be on later versions, people will still be out there in the world identifying new issues and accounting for them. If a major vulnerability appears, it's likely that someone will address it or provide information on the problem.

And realistically, if you’ve missed security updates in the past, and your website has continued to run, it will likely continue to operate far past the February 27th end date.

### What you can do about it
First thing you should do if you're running Drupal 6 is to do an audit of the security of your site. You can take some standard precautions to ensure your site is secure, such as [reducing the permissions that the Drupal CMS has on your webserver](https://www.drupal.org/node/244924), ensuring you have regular backups (we regularly use [Backup & Migrate](https://www.drupal.org/project/backup_migrate)), adding in some [existing security modules](https://www.drupal.org/node/382752), using secure passwords (consider using a secure password generator, like [1Password](https://agilebits.com/onepassword)) or [two-factor authentication](https://www.drupal.org/node/1099690/release?api_version%5B%5D=87), and avoiding easy-to-hack login credentials (like “admin” or “administrator”).

Consider the value of upgrading to Drupal 7 or 8. Consult a web developer to see if you are able to easily port your site to more recent version, or if migrating your custom theme will require extensive work. Compare the modules that you’re using in your Drupal site to ensure they exist or there is a reliable alternative.

You can also use this as an opportunity to reevaluate what works and does not work with your site. Review your analytics or conduct some user testing to see how people behave and if the site is allowing them to be successful. Gather a group of sample visitors to your site and watch them perform common tasks—are they able to complete them as you would expect?

*For more tips on low cost user testing, check out [my presentation](http://mw2016.museumsandtheweb.com/proposal/user-experience-for-museum-professionals/) at Museums and the Web on April 6th in Los Angeles, or come to our [lunchtime workshop](http://interactivemechanics.com/workshops/) on February 17 in Philadelphia.*