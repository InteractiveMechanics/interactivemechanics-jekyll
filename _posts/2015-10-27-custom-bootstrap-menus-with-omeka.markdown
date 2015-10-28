---
layout:     post
title:      "Custom Bootstrap Menus with Omeka"
date:       2015-10-27
author:     Michael Tedeschi
category:   Tools and Tech
summary: |
    A month ago, we received a question from University of North Carolina Libraries about our starter Omeka theme&mdash;How do you add a Bootstrap dropdown menu in a custom Omeka theme? We decided to tackle this issue via a blog post and update to the open source project.

---

Omeka uses the `public_nav_main` function [here it is in the documentation](https://omeka.readthedocs.org/en/latest/Reference/libraries/globals/public_nav_main.html) to control the output. Since Omeka is built using the Zend framework, you get access to all the helpers that you would get with Zend's [navigation menu](http://framework.zend.com/manual/1.12/en/zend.view.helpers.html#zend.view.helpers.initial.navigation.menu). Since you'll need to add classes on more than what they give you, you'll need to use the `setPartial` function to build your own HTML output.

{% highlight php startinline %}

$partial = array('menu.phtml', 'default');
$nav = public_nav_main();  // this looks like $this->navigation()->menu() from Zend
$nav->setUlClass('nav navbar-nav')->setPartial($partial);
echo $nav->render();

{% endhighlight %}

We added that to a function in the starter theme's `functions.php` file to make life easier (so now you can just call `public_nav_menu_bootstrap()` to get a jumpstart). As for the partial side, that's slightly more complicated. So, to help out, we added a sample version that allows for pretty Bootstrap dropdowns when you create child pages in your navigation. This file is located in the common directory, `menu-partial.phtml`:

{% highlight php startinline %}

<ul class="nav nav-pills navbar-left">
    <?php $count = 0 ?>
    <?php foreach ($this->container as $page): ?>
        <?php if( ! $page->isVisible() || !$this->navigation()->accept($page)) continue; ?>
        <?php $hasChildren = $page->hasPages() ?>
        <?php if( ! $hasChildren): ?>
            <li <?php if($page->isActive()) echo 'class="active"'?> role="presentation">
                <a class="nav-header" href="<?php echo $page->getHref() ?>">
                    <?php echo $this->translate($page->getLabel()) ?>
                </a>
            </li>
        <?php else: ?>
            <li class="dropdown <?php if($page->isActive()) echo 'active'; ?>" role="presentation">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <?php echo $this->translate($page->getLabel()) ?>
                    <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" id="page_<?php echo $count ?>">
                    <?php foreach($page->getPages() as $child): ?>
                        <?php if( ! $child->isVisible() || !$this->navigation()->accept($child)) continue; ?>
                        <li <?php if($child->isActive()) echo 'class="active"'?>>
                            <a href="<?php echo $child->getHref() ?>">
                                <?php echo $this->translate($child->getLabel()) ?>
                            </a>
                        </li>
                    <?php endforeach ?>
                </ul>
            </li>   
        <?php endif; ?>
        <?php $count++ ?>
    <?php endforeach; ?>
</ul>

{% endhighlight %}

This partial gets called by Zend and walks through building the navigation—first, each top level page, and if it has child pages each page below it. If you're doing something custom, it should be easy to manipulate or create your own walker for your project!

If you haven't checked out our Omeka starter theme, [fork it now](https://github.com/InteractiveMechanics/omeka-starter-theme) and start your own project!