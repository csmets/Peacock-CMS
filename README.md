# Peacock CMS
Peacock CMS is created by [Clyde Smets](http://clydesmets.com). It’s a flexible PHP/MYSQL content management system that helps developers and designers create beautiful websites with a simple but powerful back-end. Which allows the not-so-tech-savy client to be able to edit their website themselves.

![Alt Peacock CMS](http://peacockcms.com/git/img/banner.png)

Download a Zip copy of the current source and completely change the code to how you want it or Fork it and make changes that can help all of us.

Peacock is constantly getting improved and changed around. Users who are using the first release of Peacock is it recommended you keep using that version until you are ready to start a new project. Check out the [releases](https://github.com/csmets/Peacock-CMS/releases) to download the previous version.

# Features
- Inline Editing!

- Easily create templates to quickly create pages.

- Blog Posting.

- Create Image Galleries.

- Easily Organise your images.

- Edit your page source, CSS, and footer all within Peacock.

- 3 Responsive Themes to play with.

- Create your own plugins!

# Install
To install, it’s quite straightforward.

Once you have the project on your computer make sure you put the  folder in your `www` localhost folder or in your server online. You can rename this folder to whatever you like, I suggest putting it as the name or your website project.

Open the folder and go to ‘config’ and open up `config.php`.

Enter in the mySQL details and database name. Depending on your server you may have to create a database prior to install. Save and close.

Fire up your browser and load up your URL and add `/setup.php` to run the setup. Fill in the details and go.

You’re done!

### Important Note
For users who want to run this locally you will need to define a local domain. I suggest using Ampps as you can create and edit domain names for locally hosted sites.

Unfortunately, the way the framework has been setup you can not use the site under a subfolder. For example you have a main site here mysite.com and you want to have a sub site using peacock like mysite.com/peacocksite/ it will not work ;(

You will instead have to create a sub domain pointing to that folder for this to work. I will try to work on fixing this issue.

**NOTE**
There is a known issue with the inline editor when the site is running locally. However it runs fine in FireFox. Chrome & Safari are having a hard time finding files during AJAX calls. I  will be working to resolve this issue. 

There are NO issues with the inline editor when it’s up on a server! :-)

# Links
[Peacock CMS Homepage](http://peacockcms.com)

[Peacock Documentation](http://docs.peacockcms.com) *Please beware it’s a little outdated for version 1.1.0

# License
GNU General Public License V3
