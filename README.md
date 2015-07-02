# Peacock CMS
A simple PHP/MYSQL content management system that helps developers and designers create beautiful websites for the not so tech-smart clients.

Download a Zip copy of the current source and completely change the code to how you want it or Fork it and make changes that can help all of us.

# Dashboard

This is what the Peacock Dashboard looks like: Everything quick and easy to access. No digging of hidden menus.
![Peacock Dashboard](http://www.clydesmets.com/view/image/peacockdashboard.png)

# Features
- Inline Editing (custom built; feel free to add you own tools and changes to the inline editor).
![inlineEditor](http://peacockcms.com/inlineEditor.jpg =250x)

- Create Pages and Blog Posts

- Create Image Galleries

- Easily Organise your images

- Edit your page source in the editor
![sourceediting](http://peacockcms.com/EditSource.png =250x)

- Easily build your own templates with small amounts of php code.

- 3 Responsive Themes to play with.

# Install
To instal, it’s very simple.

Once you have the project on your computer make sure you put `PeacockCMS_v1.0` in your `www` localhost folder or in your server online. You can rename this folder to whatever you like, I suggest putting it as the name or your website project.

Open the folder and go to ‘view’ > ‘config’ and open up `config.php`.

Enter in the mySQL details and database name. Depending on your server you may have to create a database prior to install. Save and close.

Fire up your browser and load up your URL and add `/setup.php` to run the setup. Fill in the details and go.

You’re done!

### Important Note
For users who want to run this locally you will need to define a local domain. I suggest using Ampps as you can create and edit domain names for locally hosted sites.

Unfortunately, the way the framework has been setup you can not use the site under a subfolder. For example you have a main site here mysite.com and you want to have a sub site using peacock like mysite.com/peacocksite/ it will not work ;(

You will instead have to create a sub domain pointing to that folder for this to work. I will try to work on fixing this issue.

# Links
[Peacock CMS Homepage](http://peacockcms.com)
[Peacock Documentation](http://docs.peacockcms.com)

# License
GNU General Public License V3
