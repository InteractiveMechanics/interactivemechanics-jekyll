---
layout:     post
title:      "The Five Pillars of a Balanced Quality Assurance Workflow for Small Teams"
date:       2017-12-19
author:     Christina Deemer
category:   Tools and Tech
thumb:      "/images/uploads/qa-workflow-1.jpg"
summary: |
    This content was originally presented as “Level Up Your QA Workflow: An Approach for Freelancers and Small Teams” at WordCamp Philly 2017.  This is a condensed version of the talk aimed at technical folks and project managers who work as freelancers or in small teams that don’t include dedicated QA pros.  
---

Many small teams and freelancers short change Quality Assurance (QA) because of time constraints, but there are ways to integrate QA throughout a process that help you make the most of limited time. The cost of fixing bugs in warranty is up to 100 times higher than the cost of fixing them in design, so the trick is to catch and fix as many bugs as possible as early as possible. This is where a balanced workflow comes in. 

![Fixing Bugs in Production is Expensive](/images/uploads/qa_blogpost_cost_revised.png)

### A Balanced Workflow

In a balanced workflow, QA is shared between management and the technical team, it connects the dots between big-picture strategy and day-to-day operations, and it occurs throughout the life of the project. The inspiration for this approach is the Balanced Scorecard approach to performance measurement that I learned at an Executive Education program at Harvard’s Kennedy School of Government.

This workflow has 5 pillars:

![Five Pillars of a Balanced QA Workflow](/images/uploads/qa_workflow_3.png)

## Test Multiple Dimentions 

Although [exhaustive testing is impossible](http://istqbexamcertification.com/what-are-the-principles-of-testing/), we can make thoughtful choices about what we do test and how we test it.

To determine what to test, examine the project with a particular focus for risks, any problems that endanger stakeholders’ goals.

To determine what kind of testing to do, take into consideration the landscape of testing options, so you can make thoughtful choices . Broadly speaking, there are four kinds of testing:

**Functional testing** checks to see whether a component works as desired, comparing actual results against expected results.

**Non-functional testing** examines characteristics of the software, such as usability, accessibility, and security.

**White-Box or Structural testing** focuses on the inner workings of software, looking at how software does a thing, not just what it does.

**Change-based** or Regression testing occurs after a fix has been made to the software to ensure that everything is still cool.

## Allocate Time

It is difficult to conduct appropriate quality assurance without budgeting enough time for it. Identify stages of a project where testing makes the most sense. If you are short on time, you may want to test before client reviews - at alpha, beta, and pre-launch. For projects with adequate timelines, lots of iteration, or unfamiliar technologies, you may want to test at every stage, such as wireframes, design comps, prototypes, database integration, etc. 

To ensure that there is time for QA, be sure to include it from the beginning, in client budgets and timelines, and in any project management tools, such as Asana or Trello.

![Allocate Time for Balanced QA Workflow](/images/uploads/qa-workflow-4.jpg)

## Define Quality via Documentation

In the context of QA, quality is defined as a component’s ability to satisfy needs. Without identifying those needs, time spent on QA is wasted.

The most common way to identify needs for functional testing is through a requirement specifications document, which formally details a project’s capabilities, appearance, and interactions with users. [A lot](http://www.informit.com/articles/article.aspx?p=1152528&seqNum=4) has [been written](https://www.jamasoftware.com/blog/characteristics-of-excellent-requirements/) about the [characteristics](https://qracorp.com/write-clear-requirements-document/) of [good](https://www.smartsheet.com/software-requirements-specification-101) [requirements](http://www.processimpact.com/articles/qualreqs.html). 

To set the standard for quality for other kinds of testing, you could use a [WCAG checklist](https://webaim.org/standards/wcag/checklist) to test accessibility, user-testing protocol to test usability, and design comps to test appearance.

Automation tools, like [Unit testing tools](https://qunitjs.com/) and [CMS-specific plugins](https://wordpress.org/plugins/theme-check/), while not a substitute for a larger QA system, can go a long way in supporting many kinds of testing.

## Prep Your Testers

Don’t assume testers know what they’re doing. Provide them with any standards documentation (i.e. requirements) and a detailed cheat sheet that includes:

* Standards to be met
* List of URLs and/or components
* Browsers
* Breakpoints
* Specific use cases
* Time budgeted
* Deadline
* How issues should be logged

Encourage testers to ask you if there is something unclear in the func spec or design, or if it’s not clear what to do when encountering a defect outside the testing parameters.

![Allocate Time for Balanced QA Workflow](/images/uploads/qa-workflow-5.jpg)

## Standardize Issues

I have noticed in my three years of doing QA at Interactive Mechanics that there is no need to micromanage the process of testing itself. Some people use spreadsheets, others use lists,but all approaches contain the information in the bullet list below. 

Standardizing issues ensures that the developer assigned to fix the bug has the information needed to reproduce the bug, so that they can fix it and be confident that it is fixed. Information to be included in an issue includes:

* Device, browser, and operating system
* Link to or URL of a page that exhibits the bug
* Screenshot of the bug, if applicable
* Any specific steps needed to reproduce the bug
* User story that describes the bug or a detailed description of the bug

User stories, which can be particularly useful for functionality defects, can be structured this way: “As a [w], when I [x], I cannot [y]. I should be able to [z].” An example is “As a user, when I enter the word spooky into the search field and click the submit button, I do not see any search results. I should be able to see all the search results that contain the word spooky. The search should pull results from the title and body fields.”

An example of a user story for an accessibility issue may be, “As a keyboard only user, when I hit the tab button to access the navigation, nothing happens. I should be able to access the navigation using only the tab button.”

## Outcomes

Some of the outcomes that I have seen include improved relationships with clients, improved productivity and focus, increased morale, and fewer post launch issues.

This approach is fluid and will evolve to keep up with the latest in technologies, testing tools, and user needs. As the workflow has evolved and grown over the last three years, it will continue to grow and change, but I hope that in its current form you can find some elements that can help make your QA workflow more efficient and effective.


