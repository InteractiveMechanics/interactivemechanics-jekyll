---
layout:     post
title:      "Jekyll versus the CMS: Building the new Grand Round Table website"
date:       2014-10-16
author:     Michael Tedeschi
category:   Tools and Tech
thumb:      "/images/uploads/new-grand-round-table-website.jpg"
summary: |
    I was resistant to Jekyll at first—I love WordPress and Drupal, and we’re pretty good at building these types of CMS-driven sites quickly. Jekyll felt like an intruder. Posts, pages, categories? Sounds a lot like WordPress to me, without the pretty interface and easy-to-understand workflow for administration and editing. Is Jekyll actually a viable option as a marketing site for companies?

---

### What is Jekyll?

Jekyll is a static site generator. It takes templates, raw content, and data files, then compiles them into a stand-alone, static site that you can deploy anywhere. Built on Ruby and Liquid, Jekyll uses Markdown and Yaml for data and content, so you can keep your code and content separate for easy editing using a simple file structure. It also features a number of plugins that can extend how Jekyll works and compiles without reinventing the wheel.

Jekyll’s quick start guide will help you install the ruby gem and get your new project started. Shopify also has a considerable amount of documentation on Liquid available via their docs.shopify.com (more to come on this later).

### Why choose Jekyll?

Choosing Jekyll over a content management system like WordPress or Drupal can be a tough decision. When deciding what to use, consider a few questions:

##### Who will be updating this website?
Understanding the users that will be moderating the website is a big consideration for whether or not to use Jekyll. If you’re not familiar or comfortable with code, it could be daunting to modify a Jekyll site without training. There are integrations out there, like Prose.io, that try to bridge this gap, but they still rely on some understanding of Git/GitHub and Markdown. If your intended editors are more technical and would feel comfortable with a bit of practice, Jekyll could be a great fit.

##### How dynamic does your site need to be?
At the end of the day, Jekyll generates static HTML pages to create a site that doesn’t require a web server for anything more than serving up files. That means there is no database and no back-end processing that happens behind the scenes when a page loads. Consider if that works for your site. Can you rely exclusively on static pages and front-end manipulation with JavaScript on your site?

##### How easy is it to keep my site updated over time?
Jekyll and most major open-source content management systems have very active developer communities. That said, Jekyll is still new. It’s possible you might run into problems that you won’t find a reliable answer for online—I crawled through outdated StackOverflow answers before finding a solution on my own. WordPress and Drupal documentation and training is easily accessible online, plus there are tons of community events dedicated to both. It’s possible Jekyll will one day reach that critical mass, but until then, there is still uncertainty about the long-term support and sustainability of the project—I don’t think WordPress or Drupal are going away anytime soon.

### Using Jekyll for Grand Round Table

Jekyll was the perfect fit for an organization like Grand Round Table (read the case study). Their staff is highly technical, their marketing site is purely for content, and their team had an interest in testing it out. Their editing needs were minimal, only having to update basic content and add new blog entries. They didn’t need the overhead of a content management system, and already had an established workflow in place with Git.

Through the course of the project, we found some interesting solutions to some basic technical questions with Jekyll:

##### Customizing page navigation
There was limited documentation on building custom navigation in Jekyll. Out of the box, Jekyll will loop over all “pages” in the site to build the navigation—but we wanted to limit it to just a select few options. We also wanted to give additional styling to a specific link in the navigation:

{% highlight c %}
{% raw %}

// Loop over all pages, by weight (defined in our page front-matter)
{% assign sorted_pages = site.pages | sort:"weight" %}
{% for node in sorted_pages %}
    // Should our page be in the navigation? If so, show it.
    {% if node.in_nav == true %}
        // Is our permalink something special? If so, give the link a class
        {% if node.permalink == "contact-us/" %}
            Request a demo
        {% else %}
            {{ node.title }}
        {% endif %}
    {% endif %}
{% endfor %}

{% endraw %}
{% endhighlight %}

##### Using data files for staff profiles
The staff section of the site featured a potentially long list of team members that would need to be updated regularly. We wanted to make this a simple process: just add a new member with their title and an image. Using Jekyll’s data feature, we created a staff.yml in the _data directory in the root of our project:

{% highlight c %}
{% raw %}

- name: Eric King
  role: President/CEO
  image: staff-eric.jpg

{% endraw %}
{% endhighlight %}

Jekyll then makes this data file accessible to use anywhere in your site using site.data.[filename]. We can loop over the staff on our about page to populate this section.

{% highlight c %}
{% raw %}

{% if site.data.staff %}
    {% for staff in site.data.staff %}
        {{ staff.name }}
        {{ staff.role }}
    {% endfor %}
{% endif %}

{% endraw %}
{% endhighlight %}

### Liquid can be incredibly powerful
You only need to know a few basics of Liquid to jump into building Jekyll sites. But there is a huge amount of documentation on what you can do with Liquid for more advanced functionality. Mark Dunkley created a cheat sheet for Shopify, documenting most Liquid functions and filters in one place. If you’re stuck on something, referring to this documentation will likely get you out of a jam. For example, if you need to count the number of items in a for loop, forloop.length will help you out.

We’d love to see how you’re using Jekyll. Tweet @interactivemech and tell us about your static site building experiences.