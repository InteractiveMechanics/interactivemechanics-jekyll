---
layout:     post
title:      "Microsoft Kinect with Processing"
date:       2015-10-14
author:     Michael Tedeschi
category:   Tools and Tech
summary: |
    Since earlier this year, we’ve been working heavily with the Kinect—an inexpensive piece of hardware produced by Microsoft that includes a series of cameras (infrared and RGB) and sensors (audio). If you’re a gamer, then you probably know that the Kinect has had its ups and downs, and was never the huge success that Microsoft hoped it would be as an accessory for motion-based gaming. It is, however, a great solution for hands-free interactivity for museums, art installations, and other spaces.

---

Before making the decision to use Microsoft’s Kinect SDK, we researched alternative ways to make the most of the hardware. One that got us the most excited was SimpleOpenNI with Processing, a language that we already knew well.

Daniel Shiffman’s [Getting Started with Kinect and Processing](http://shiffman.net/p5/kinect/) post is a great primer on the basics (including getting everything installed). We’re going to use [SimpleOpenNI](https://code.google.com/p/simple-openni/) though instead of OpenKinect, which can easily be installed Processing’s Library Import. Through this article, we’ll take a look at a simple example using some of the Kinect’s coolest features that you can use in your own projects.

### The Basic Sketch
If you read Shiffman’s article, you’ll know the basic setup. Here is the foundation of our sketch (what Processing calls a document or project):

{% highlight java %}

import SimpleOpenNI.*;
SimpleOpenNI context;

void setup(){
  size(640, 480, P2D);
  
  context = new SimpleOpenNI(this);
  if(!context.isInit()){
     println("Can't initialize SimpleOpenNI, camera not connected properly."); 
     exit();
     return;  
  }
  context.enableRGB();
  background(0);
}

void draw() {
  context.update();
  image(context.rgbImage(), 0, 0);
}

{% endhighlight %}

Let’s walk through this. We start by importing SimpleOpenNI, the framework that will give us access to the Kinect sensor. We then create a SimpleOpenNI variable called “context.” We’ll add a few more variables later, but for now, this is all we need.

We have two functions: `setup()` and `draw()`. `draw()` is just going to get the latest frame and print it to the screen. `context.rgbImage()` will take the latest frame returned from the RGB camera. 

`setup()` is a bit more complicated: first, we define the size of our sketch (640 width by 480 height is the default size for the Kinect v1 sensor). We assign context to a new instance of SimpleOpenNI and then check to see if we’re able to initialize the device (can’t do anything if the Kinect isn’t connected or doesn’t turn on). Finally, we enable the RGB sensors that we need.

If you run the sketch now, you should see a simple webcam-style streaming video getting returned. Nothing fancy, but you can likely already see how powerful this could be.

### Drawing the skeleton
Now that we have some basic data getting returned and displayed, let’s take it a step further and use the depth camera and joint detection. The Kinect does a surprisingly good job of recognizing the human body to track joints and motion, which you can use to create interactivity in your sketches. Here’s the basic setup:

{% highlight java %}

import SimpleOpenNI.*;
SimpleOpenNI context;

color[] userColor = new color[]{ 
  color(255,0,0),
  color(0,255,0),
  color(0,0,255),
  color(255,255,0),
  color(255,0,255),
  color(0,255,255)
};

void setup(){
  size(1260, 960, P2D);
  
  context = new SimpleOpenNI(this);
  if(context.isInit() == false){
     println("Can't initialize SimpleOpenNI, camera not connected properly."); 
     exit();
     return;  
  }
  
  context.enableDepth();
  context.enableUser();
  context.setMirror(false);
 
  background(0);

  stroke(0,0,255);
  strokeWeight(3);
  smooth();  
}

{% endhighlight %}

Mostly the same as last time, but now we’re using the depth camera instead of the simple RGB camera. We’re also turning on `enableUser()` which will recognize bodies picked up by the depth sensor. `setMirror(false)` will tell the sensor not to flip the frame to make our motion a little more intuitive.

{% highlight java %}

void draw(){
  context.update();
  scale(2);
  
  image(context.userImage(),0,0);
  
  int[] userList = context.getUsers();
  for(int i=0;i<userList.length;i++){
    if(context.isTrackingSkeleton(userList[i])){
      stroke(userColor[ (userList[i] - 1) % userColor.length ]);
      background(0);
      drawSkeleton(userList[i]);
    }
  }    
}

{% endhighlight %}

Our `draw()` function this time uses the userImage returned from the depth camera. It’ll look like a heatmap when you run it, with objects closer appearing brighter than points further away. To draw our skeletons, we’ll need to loop through all of the users that the Kinect is able to detect. We start by getting an array of users that we’re able to loop through, and before drawing the skeleton, confirm that the sensor is able to track that user. If so, we pick a color from our userColor array and draw the series of joints that make up the skeleton for that user.

Next, let’s look at that `drawSkeleton()` function:

{% highlight java %}

void drawSkeleton(int userId){  
  context.drawLimb(userId, SimpleOpenNI.SKEL_HEAD, SimpleOpenNI.SKEL_NECK);

  context.drawLimb(userId, SimpleOpenNI.SKEL_NECK, SimpleOpenNI.SKEL_LEFT_SHOULDER);
  context.drawLimb(userId, SimpleOpenNI.SKEL_LEFT_SHOULDER, SimpleOpenNI.SKEL_LEFT_ELBOW);
  context.drawLimb(userId, SimpleOpenNI.SKEL_LEFT_ELBOW, SimpleOpenNI.SKEL_LEFT_HAND);

  context.drawLimb(userId, SimpleOpenNI.SKEL_NECK, SimpleOpenNI.SKEL_RIGHT_SHOULDER);
  context.drawLimb(userId, SimpleOpenNI.SKEL_RIGHT_SHOULDER, SimpleOpenNI.SKEL_RIGHT_ELBOW);
  context.drawLimb(userId, SimpleOpenNI.SKEL_RIGHT_ELBOW, SimpleOpenNI.SKEL_RIGHT_HAND);

  context.drawLimb(userId, SimpleOpenNI.SKEL_LEFT_SHOULDER, SimpleOpenNI.SKEL_TORSO);
  context.drawLimb(userId, SimpleOpenNI.SKEL_RIGHT_SHOULDER, SimpleOpenNI.SKEL_TORSO);

  context.drawLimb(userId, SimpleOpenNI.SKEL_TORSO, SimpleOpenNI.SKEL_LEFT_HIP);
  context.drawLimb(userId, SimpleOpenNI.SKEL_LEFT_HIP, SimpleOpenNI.SKEL_LEFT_KNEE);
  context.drawLimb(userId, SimpleOpenNI.SKEL_LEFT_KNEE, SimpleOpenNI.SKEL_LEFT_FOOT);

  context.drawLimb(userId, SimpleOpenNI.SKEL_TORSO, SimpleOpenNI.SKEL_RIGHT_HIP);
  context.drawLimb(userId, SimpleOpenNI.SKEL_RIGHT_HIP, SimpleOpenNI.SKEL_RIGHT_KNEE);
  context.drawLimb(userId, SimpleOpenNI.SKEL_RIGHT_KNEE, SimpleOpenNI.SKEL_RIGHT_FOOT);  
}

{% endhighlight %}

It looks like a lot is happening here, but we’re really just creating connections between the user’s joints. For example, we create a line between the foot and the knee, the knee and the hip. The Kinect v1 has access to 17 joints, whereas the newer sensor has access to 25. Finally, there are a few events that we need to add in:

{% highlight java %}

void onNewUser(SimpleOpenNI curContext, int userId){
  println("onNewUser - userId: " + userId);
  curContext.startTrackingSkeleton(userId);
}

void onLostUser(SimpleOpenNI curContext, int userId){
  println("onLostUser - userId: " + userId);
}

void onVisibleUser(SimpleOpenNI curContext, int userId){
  println("onVisibleUser - userId: " + userId);
}

{% endhighlight %}

The important one here is the `onNewUser()` function, which begins tracking the user’s skeleton once it is picked up by the sensor.

Run the sketch, and walk in front of your sensor. You’ll see a colored skeleton that does a pretty good job tracking your body’s major joints. You could take this further: perhaps tracking just the hand joints to create a painting game, or an interface that you can play with.

### Why Processing over Microsoft’s Kinect SDK?
Processing is known for being used by artists. If you’re looking for a way to combine streaming video into your work, Processing with the Kinect might be the right pairing for you. Unfortunately, the open source libraries available right now haven’t had much love over the past few years. With the release of the new Kinect sensor in 2014, several of these projects died out or have been struggling to stay alive.

The Microsoft Kinect SDK has the benefit of an improved API and much more flexibility with how you develop with it. For the Kinect v2 SDK, you’ll have access to powerful facial detection, hand state (like opened and closed), and additional joints.

If you want to learn more on Processing and Kinect, I’d highly recommend Greg Borenstein’s book, [Making Things See: 3D Vision with Kinect, Processing, Arduino, and MakerBot](http://www.amazon.com/Making-Things-See-Processing-MakerBot/dp/1449307078/ref=as_li_ss_tl?ie=UTF8&linkCode=sl1&tag=learniproces-20&linkId=742b2c243f8e415b108d559a422faf5c) to take things further. If you build something cool and found this post helpful, send us a link or video so we can take a look!