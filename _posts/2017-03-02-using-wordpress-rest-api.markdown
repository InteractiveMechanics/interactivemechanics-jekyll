---
layout:     post
title:      "Using the WordPress REST API"
date:       2017-03-02
author:     Michael Tedeschi
category:   Tools and Tech
thumb:      "/images/uploads/wordpress-restapi-thumb.jpg"
summary: |
    Over the last decade, WordPress has evolved from a simple blogging platform to a robust content management system, providing flexible ways to design and build websites. In [WordPress 4.4](https://wordpress.org/news/2015/12/clifford/), the developers added a REST API into WordPress’ core code, making it easy to use the system for single page apps and highly interactive projects.

---

We had the opportunity to use the WordPress REST API for the [West Philadelphia History Map](http://westphillyhistory.com/) with [The People's Emergency Center](http://www.pec-cares.org/), so we could build an easy-to-update content management system with a completely custom front-end.

### How it works
An application program interface, or API, is a communication protocol that allows a web browser or other client-side application to interact with a server. In the case of the [REST API](https://en.wikipedia.org/wiki/Representational_state_transfer#Applied_to_Web_services), WordPress provides a service to allow you to interface with the content that it stores, like posts, pages, users, taxonomies, media, or custom fields. You can interact with this API through HTTP requests to API endpoints, or routes. For example, you can make a request to GET all WordPress posts, and receive a JSON response that provides this information for you to use in your own project. Or, you could POST a new page to add it to your site from a custom form.

![The WordPress REST API v2 Plugin for West Philly History Map](/images/uploads/wordpress-restapi-01.png)

WordPress provides [extensive documentation](https://developer.wordpress.org/rest-api/) on the REST API online, and also explains helpful information on how to [extend it further](https://developer.wordpress.org/rest-api/extending-the-rest-api/) for your custom project. There is also a [WordPress REST API (v2)](https://wordpress.org/plugins/rest-api/) plugin that aims to make building custom endpoints easy for users without programming experience, and several other plugins that extend the core features to integrate with other plugins or expand the API’s capabilities.

### Building the West Philadelphia History Map
The [West Philadelphia History Map](http://westphillyhistory.com/) is a project to document the rich history of West Philadelphia surrounding Lancaster Avenue from the early 17th Century through modern day. The project required an easy-to-use content management system that paired with an interactive digital map, which the WordPress REST API made possible.

![The WordPress REST API v2 Plugin for West Philly History Map](/images/uploads/wordpress-restapi-02.png)

We used the REST API to read information from the WordPress database for landmark information and the New Freedom Tour, a walking tour of African-American Islamic cultural heritage sites in West Philadelphia. We created a custom route that provides, or GETs, all of the landmarks with their required information, including title, description, latitude, longitude, time period, and category. We also created an endpoint to receive, in order, all tour stops and related content. This allows the managers of the map to maintain site content using WordPress’ user-focused administrative portal without being restricted to the WordPress templating engine.

![West Philly History Map](/images/uploads/wordpress-restapi-03.png)

To ensure the administrative site was still usable without the standard WordPress front-end, we also redirected links from the back-end directly to the map to avoid confusion (e.g., when you click “Preview” when publishing a new landmark).

### Why this is such a useful feature
This capability is an exciting selling point for WordPress. In past years, building complex web applications on WordPress was challenging, or required complex, custom themes just to get your data out of the system. The REST API streamlines this process significantly, making it easy to use WordPress purely as a content management system—for kiosks, mobile apps, or websites.

For example, we built the [Widener Rice Room interactives](http://interactivemechanics.com/work/pma-rice-room/) for the [Philadelphia Museum of Art](http://philamuseum.org/) to accept a flexible JSON endpoint for all data stored in the interactive. Now, the interactive could pull all of its content from WordPress, allowing educators and administrators the ability to update kiosk content on the fly without any technical support.

It also continues to prove that WordPress is a serious competitor to Drupal and can accomplish many of the same things. While Drupal 8 provides many more options and is generally a more flexible solution for creating API endpoints, this allows projects that require WordPress the option to build sites this way, opening this door up to many organizations and projects.