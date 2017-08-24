---
layout:     post
title:      "Afro-Alternativity and Tech: Redesigning the Metal and Coffee Website"
date:       2017-08-02
author:     Ebonie Butler
category:   Behind the Scenes
thumb:      "/images/uploads/afro-alternativity-thumb.jpg"
summary: |
    I’ve always been an outsider growing up. I never liked the same music nor shared the same hobbies as my peers. And for a long time, I thought I was just a weird black girl. 

---

But now that I am older, I realize that I am an afro-alternative woman. I love tattoos and piercings. I love playing RPG video games. And I love listening to metal music.

Afro-alternativity is the concept of a person of color having alternative traits that directly contradict stereotypes. If you’ve ever heard one of the following comments directed towards you, you are probably afro-alternative: “Are you sure you’re black? You don’t act like it.”, “You’re basically an oreo.”, “You sound really white.”

The fact that we need a term to express that not all black people are the same is problematic within itself, but I digress. If you’re a non-stereotypical black person who has often been made fun for your interests or hobbies, you are afro-alternative.

You’d think that in 2017, it wouldn’t be weird to see people of color creating and supporting arts and music traditionally see as “white”. But diversity and inclusion in all facets of life still has a long way to go. Therefore, as part of my fellowship with Interactive Mechanics, I wanted to work on a project that focused on putting myself and my afro-alternativity out there to educate and relate to others.

### Metal and Coffee version 1

![Metal and Coffee Version 1 Interactive Mechanics Fellowship](/images/uploads/afro-alternativity-02.png)

Back in 2015, I created a music blogging website called *[Metal & Coffee](http://metalandcoffee.com/)* where I talked about my love for metal music. Later down the road, I started creating video on my *Metal & Coffee* [Youtube](https://www.youtube.com/user/theebonieiscool) channel and I started a [radio show](https://www.mixcloud.com/metalandcoffee/) on WKDU 91.7FM also called - you guessed it - *Metal & Coffee*. After only a couple months, I started seeing great feedback. 

But as my interest in web development began to bud, I thought about whether my users were able to access all of my content in an optimal way. My current *Metal & Coffee* website is built on the WordPress framework, and my use of a pre-built theme had originally sufficed since my original intention was to only blog. This theme provided the simpler two column layout (sidebar & main content area) that is ever so popular in the personal blogging world.

But now that I had a Youtube channel and a radio show, I wanted to put that content on my website in a user-friendly way as well. So I embarked on a journey to build a completely custom theme tailored to my *Metal & Coffee* brand with the intention of tacking on nice-to-have functionality.

### Metal and Coffee version 2 - Working with WordPress

![Metal and Coffee Version 2 Interactive Mechanics Fellowship](/images/uploads/afro-alternativity-03.png)

I chose the WordPress CMS to be the backbone of my website because it is free, open-source and widely supported across the internet. It also allows for immense flexibility when diving into various aspects of customization. I was definitely looking forward to learning my first server-side language, PHP, while continuing to hone my front-end skills with HTML, CSS and Javascript through my first stab at WordPress theme customization.

The WordPress integration phase is where I was truly challenged. I had never experimented with any server-side languages nor even tried to understand what was going on behind the scenes. But by the end of it, I became very familiar with the WordPress template hierarchy, custom post types, built-in functions, action hooks, filter hooks, and the fact that there are multiple ways to implement a theme in WordPress.

### Designing as a Developer

During my prototyping phase, I had a difficult time creating a website design that I was confident in. Creativity has always been something that I was convinced I lacked. But I learned one important lesson during this phase: If you see a layout that you like while cruising the web, use Chrome Inspector to see how it’s implemented. I also solidified my understanding of how CSS styles are rendered (cascade, specificity and inheritance) and even dabbled into a little bit of parallax scrolling. This is what led me to my final [prototype](http://metalandcoffee.com/staging/) which not only utilizes the aforementioned front-end languages but also the Bootstrap framework, Font Awesome Toolkit and Flickity CSS Styling.

### Future Functionality & Site Launch

I still need to implement the blog archive template, single blog template, video archive template and web accessibility across all pages. Additionally, I will be creating my first plugin that will display a calendar of bands with upcoming performances in Philadelphia. The calendar will only display bands that have been played on my radio show so extensive back-end work will be involved (i.e. reading post meta table in DB, call to Songkick API to capture concert data, comparison algorithms, etc).

After I implement the remaining functionality, I will push the custom theme to my live server and activate it. I hope that my new theme and content arrangement will attract all curious minds, whether it be a metal fan looking to expand their music taste or a fellow afro-alternative black woman looking to find confidence in herself.

Before embarking on the Interactive Mechanics fellowship, I had merely speculated if I had what it took to become a developer. But through the experience of working on this project and involving myself in the Philly Tech community, I have acquired the confidence and have since started my new position as a WordPress Theme Developer for [Yikes, Inc](http://www.yikesinc.com).