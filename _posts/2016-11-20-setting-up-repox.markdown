---
layout:     post
title:      "Setting up REPOX using Amazon Web Services"
date:       2016-11-20
author:     Michael Tedeschi
category:   Tools and Tech
thumb:      "/images/uploads/setting-repox-thumb.jpg"
summary: |
    Last year, we worked with Bryn Mawr College and the other Seven Sister schools to build [College Women](http://www.collegewomen.org), an online collection of shared images and primary source materials from these historic women’s institutions.

---

This online repository collects images and metadata from seven different systems, each with their own way of presenting the data. For the second phase of the project, we decided to use REPOX to make the data more consistent.

[REPOX](http://repox.sysresearch.org/) is an open source data aggregation framework built by Europeana. It’s a great tool for importing, transforming, and exposing data from a variety of sources. For a project like College Women, REPOX allows us to make our data consistent before importing it into the site, saving time harvesting in Drupal and making sure data is correct before it enters the content management system. We’ve documented our experience to help you get your REPOX project up and running online. These instructions are for anyone who has some comfort with the command line, and this process shouldn’t take more than thirty minutes (down from the five hours it took to do before creating this tutorial!).

### Setting up a server
We used [Amazon Web Services (AWS)](https://aws.amazon.com/) to deploy REPOX, because the pricing is flexible and we could spin up a server quickly. If you haven’t used AWS before, it can feel a little daunting, so let’s start at the beginning.

1.  Go to aws.amazon.com and create an account with all appropriate billing information. Once you have an account, tap on “Services” and select Elastic Computing (EC2). EC2 is a service that allows you to bring up and down virtual servers, so you pay for what you need when you need it.

2.  From the EC2 dashboard, select “Instances” and then click “Launch Instance”. This will take you through a step-by-step process of setting up the virtual server that we need to run REPOX.

    ![Log into your Amazon Web Services account - Setting Up REPOX](/images/uploads/setting-repox-screen-01.png)

3.  The first step in this process is to select an Amazon Machine Image (or AMI). This image is the foundation for your system, including operating system, pre-install software, and other utilities. After experimenting with a few, we chose the “Tomcat Powered by Bitnami (PV)” AMI available in the AMI Marketplace. This instance had most of the things we need (Apache Tomcat, Java, and MySQL) already configured. Once you’ve selected this AMI, choose your instance type—we suggest an m3.medium or equivalent to ensure you have enough memory to install and run REPOX.

    ![Launch a new EC2 instance - Setting Up REPOX](/images/uploads/setting-repox-screen-02.png)

    *NOTE: We had originally hoped to run REPOX on a t2.micro instance to take advantage of the free tier pricing, but we found out during installation that the server didn’t have enough memory to complete the installation, and generally ran too slow after we got everything up and running.*

4.  From here, you can typically skip the additional configuration options and go right into launching your instance. Set up a new key pair so you can securely log into the server—enter a name, click download, and then “Launch Instances”. Be sure to keep the private key that it downloads safe, you’ll need it later!

    ![Create a private key - Setting Up REPOX](/images/uploads/setting-repox-screen-03.png)

5.  Now that your AWS instance is up and running, you’ll see the new instance running in your EC2 Management Console. Take note of a few things here: the Public DNS address (you’ll need this to login later) and the Public IP address (you’ll need this to test things out on your server). If you go to the public IP address in your browser, you should see the Tomcat “congratulations!” screen with a number of resources and links.

    ![Starting your EC2 instance - Setting Up REPOX](/images/uploads/setting-repox-screen-04.png)

6.  We’ll also need to get the default password for our instance, which we’ll use later on to log into our MySQL database. From our Instances dashboard, click “Actions”, then “Instance Settings” and “Get System Log”. This will bring up a terminal window with the log of our server spinning up for the first time. Scroll down to the bottom and write down the highlighted application password.

    ![Get system log - Setting Up REPOX](/images/uploads/setting-repox-screen-041.png)

    ![Find your Bitnami password - Setting Up REPOX](/images/uploads/setting-repox-screen-042.png)

### Installing REPOX’s Dependencies
1.  You’re going to run all of your commands from the terminal, and the first thing you need to do is securely connect to your server:

        ssh -i /path/to/privatekey.pem bitnami@your-public-ec2-url-here.compute.amazonaws.com

    The command above connects you to the newly created server with your selected private key. The default user for any Bitnami AMI is typically “bitnami”, and you’ll use the public server address that you made note of earlier. Once connected, you’re ready to start installing REPOX.

    ![Logging into your server - Setting Up REPOX](/images/uploads/setting-repox-screen-051.png)

    REPOX requires a few things to run: Java 7 or later, Apache Tomcat and Maven, and a MySQL or PostGRES database. The Amazon Machine Image has several of these already installed—all you need to do is install Git, Maven, and a mail server (we’re using Gmail), and you can start the REPOX install process.

2.  First, install Git, which you’ll need to pull down the project’s codebase. You can do this by running:

	    sudo apt-get update
        sudo apt-get install git

    ![Installing Git - Setting Up REPOX](/images/uploads/setting-repox-screen-05.png)

3.  This will download, run, and install Git and all of the required dependencies. If you’re not able to find the package to install Git, you can also run `sudo apt-get update` to make sure you have the latest library to pull from. With Git installed, we can now close the repository from GitHub. In your current directory, clone the repo with:

	    git clone https://github.com/europeana/REPOX.git

    ![Downloading REPOX from GitHub - Setting Up REPOX](/images/uploads/setting-repox-screen-06.png)

4.  This will download all the code you need to install REPOX on the server into a new folder. Before you get started on setting up and installing REPOX, you’ll need to install Apache Maven, a tool for managing and building Java-based projects.

	    sudo apt-get install maven

    ![Installing Maven - Setting Up REPOX](/images/uploads/setting-repox-screen-07.png)

5.  Maven can take a while to install and will prompt you for confirmations along the way. When done, double check that everything installed successfully:

	    mvn -version

    ![Confirming Maven is installed - Setting Up REPOX](/images/uploads/setting-repox-screen-08.png)


### Installing REPOX
1.  Now you can start the install process for REPOX. First, you need a database for your tool to use. To use phpMyAdmin, you’ll need to connect securely to the server. In a new terminal window or command prompt, type:

	    ssh -N -L 8888:127.0.0.1:80 -i /path/to/privatekey.pem bitnami@your-public-ec2-url-here.compute.amazonaws.com

2.  This will let you access phpMyAdmin locally by typing "http://127.0.0.1:8888/phpmyadmin" in your web browser. From here, you can log into phpMyAdmin using the username `root` and the password you saved earlier from the AWS console. You’ll need to create a new database— call yours “repoxdb” so it’s easy to remember.

3.  Now, you can configure REPOX for installation. From your current directory, you need to navigate to the `configuration.properties` file and edit your settings:

	    cd REPOX/resources/src/main/resources
        sudo nano configuration.properties

    ![Changing your REPOX installation settings - Setting Up REPOX](/images/uploads/setting-repox-screen-09.png)

4.  This will open up your editor so you can change your configuration settings. You’ll want to edit the “Advanced Properties” at the bottom of this file, particularly adding in your own gmail account information for email and updating your database settings. Be sure to comment out lines 49–52 and uncomment lines 61–64 since you’re using MySQL, and add in your own username and password for MySQL here! 

    Once set, it’s finally time to get REPOX installed. Navigate back up to the root directory:

	    cd ../../../..
	
5.  And then run the installation command with Maven to start the install process:

	    mvn clean install - Pproduction

    ![Installing REPOX with Maven - Setting Up REPOX](/images/uploads/setting-repox-screen-10.png)

    The Maven installation can take some time—expect to let it do its thing for about 10 minutes. Fortunately, running this on a more powerful EC2 instance will make it go a bit faster and avoid running out of memory. Once finished, you’ll need to copy the .war file that Maven creates into our Tomcat webapps directory:

	    sudo cp gui/target/repox.war /opt/bitnami/apache-tomcat/webapps/
	
6.  And, last but not least, restart your Tomcat server:

	    cd /opt/bitnami/apache-tomcat/bin
        sudo ./catalina.sh stop
        sudo ./catalina.sh start


### Running REPOX
Now that REPOX has installed successfully, you can use the public IP address to log in. If you go to ‘/repox’ you’ll get directed to your REPOX instance, where you can log in using the default administrative account (with the clever “admin” username and “admin” password combination). 

Once logged in, I would suggest changing your default admin password and creating some user accounts for people on your team. Before you can do that, you’ll need to set up your mail server information, which can simply use a gmail account you already have running. In the top bar, click “Administration” and “User Management” to add a new user. Now you’re good to go!

Now that you’re up and running with REPOX, you can start importing, transforming, and publishing your data in powerful ways. Let us know if you found this tutorial helpful or have any suggestions on improvements. Hopefully this makes the process of spinning up an instance of REPOX a little easier for you and your organization!