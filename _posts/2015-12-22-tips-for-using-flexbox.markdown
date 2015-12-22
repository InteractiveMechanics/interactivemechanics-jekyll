---
layout:     post
title:      "Tips for Using Flexbox Safely and Effectively"
date:       2015-12-22
author:     Christina Deemer
category:   Tools and Tech
thumb:      "/images/uploads/flexbox-safely-thumb.jpg"
summary: |
    I've been excited about the flexbox layout module since I first heard about it over the summer.  Flexbox's simple yet powerful properties make some onerous styling tasks, such as vertical centering, a cinch. No more workarounds or hacks involving line-height, negative margins, or display: table-cell.  And since flexbox is designed to tackle today's modern, responsive layouts, perhaps your days of using floats for layout purposes are numbered.

---

Although flexbox is a game changer for developers, it has not yet shipped ([you can see the December 3 Editor's Draft here](https://drafts.csswg.org/css-flexbox/)) and there are some issues you may want to take into consideration as you explore the wonderful world of flexbox.

### Browser Support: Autoprefixer is Your Friend

Flexbox has pretty decent browser support.  The exception to that is, no surprise, IE.  IE10 supports the 2012 syntax and, although IE11 supports the current spec, it is buggy. (Sorry, there is no polyfill.)  Older versions of Safari and the Android browser require prefixes.  All of this leaves developers with a jumbled soup of prefixed properties.

This is where [Autoprefixer](https://github.com/postcss/autoprefixer) comes in.  Autoprefixer is a CSS postprocessor that automatically adds vendor prefixes to your code so you don't have to. You can use Autoprefixer with popular text editors, such as Sublime Text, Atom, and Brackets. It is a particularly helpful tool for using flexbox.  For example, Autoprefixer compiles this


{% highlight css startinline %}

.flex-container {
    display: flex;
    justify-content: space-between;
}

{% endhighlight %}

into this:

{% highlight css startinline %}

.flex-container {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: justify;
    -webkit-justify-content: space-between;
    -ms-flex-pack: justify;
    justify-content: space-between;
}

{% endhighlight %}

Developers should beware that there are subtle differences between properties of the 2012 and current specifications.  I’ve read that there is not a 100% translations between `justify` and `space-between`, but I tried some simple exercises and didn’t encounter a problems.  Just a heads up.  

But even with Autoprefixer a [whopping 22.35% of American users](http://caniuse.com/#search=flex) will be left out. If you must accommodate users with older browsers, employ fallbacks or consider ways to gracefully degrade the experience so no one is left out.

![It's not safe to go alone. Take this construction cat to help you with flexbox!](/images/uploads/flexbox-safely.jpg)

### Managing and Minimizing Bugs

Since the flexbox spec is not finalized, developers should expect some bugs.  IE flexbox issues abound, but there are also some bugs in other browsers.  For example, some HTML elements, such as `<fieldset>` and `<button>` cannot be flex containers because the browser’s default rendering of those elements conflicts with display: flex.  There is a simple workaround for this - insert a wrapper element, such as a `<div>`, directly inside the affected element.  But if you encounter a flexbox bug that stumps you, check out [Philip Walton’s excellent Flexbug GitHub repo](https://github.com/philipwalton/flexbugs), which documents major flexbox issues and workarounds for all major browsers.

### Accessibility and Flexbox

Part of the joy of flexbox is that visual content can be reordered with JavaScript or CSS hacks, which feels wonderful and saves a lot of time.  Let’s say you have a sidebar to the right of a main content area.  In smaller viewports you’d like to position the sidebar on top of the main content.  Check out the [this fiddle](https://jsfiddle.net/cahdeemer/kc9rh38u/) to see how the flexbox property `flex-direction` can make easy work of this.   

Changing the visual layout order without changing the source code order can cause accessibility issues, particularly for users who rely on tabbing and/or speech output.  In the first fiddle the change in visual order doesn’t cause a problem, because sidebars often contain important content, such as special links.  The [second fiddle](https://jsfiddle.net/cahdeemer/0tgaw9fs/) shows how changing the visual order can cause confusion for screen readers.  The heading says that we’re counting down from 5 and visual content matches the heading (5-4-3-2-1), but the source code is in the opposite order (1-2-3-4-5). 

In the future the ARIA attribute [aria-flowto](http://www.w3.org/TR/wai-aria/states_and_properties#aria-flowto) may help ameliorate this issue by making it possible for developers to specify an alternate reading order for content. That attribute was developed in 2012, but it is not supported by all of the major assistive technologies and it may be an evolutionary dead end.

Do not forsake universal accessibility goals just because flexbox is cool.  Use flexbox responsibly.

### Flexbox Practice Exercises 

It takes time and practice to adjust to the flexbox approach to layouts, so give yourself some small, low-risk exercises to get used to the flexbox way before you decide to implement flexbox in code for production.  Head over to your favorite coding playground, like JSFiddle or CodePen, and try using flexbox to build a [nav](http://codepen.io/oknoblich/pen/klnjw), [pagination](http://codepen.io/iamjustaman/pen/YPLPNR), [calendar](http://codepen.io/LandonSchropp/pen/GJWGrO), or [sticky footer](https://philipwalton.github.io/solved-by-flexbox/demos/sticky-footer/) using flexbox.  Have some fun with [vertical centering](https://jsfiddle.net/cahdeemer/ontbcwh4/embedded/result/) or use flexbox to append or [prepend an input](http://codepen.io/benoitg/pen/EuGmv).  

### Conclusion: Yes, You Can Use Flexbox!

If your project does not need to support older browsers, feel free to jump aboard the flexbox train! Use Autoprefixer to smooth the way and build in some workaround if you encounter any bugs. If you can’t use flexbox in production code (or even if you can), practice using Flexbox on a feature or just play around with non-productive exercises.  It may take a while for you to feel completely comfortable with this powerful tool - I’m still getting used to it myself - but before long, we will be effortlessly creating powerful and dynamic layouts  that all users will love while keeping our stylesheets tidy and hack-free.