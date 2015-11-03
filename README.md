# Laravel 5.1 - Enterprise starter kit (L51ESK)

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)

## Description
L51ESK, is a template project based on the [Laravel](http://laravel.com/) framework v5.1, combining a set of features 
that can kick start any Web application for the Internet or on an Intranet. What makes this project unique, from what
I have seen, are two key features: the optional Lightweight Directory Access Protocol (LDAP) & Microsoft Active 
Directory (AD) authentication and the dynamic authorization module. But wait there is more, keep reading...

## Contents
- [Features](#features)
- [Roadmap](#roadmap)
- [Installing](#installing)
    - [Acquire a copy](#acquire-a-copy)
    - [Homestead](#homestead)
    - [Fetch dependencies](#fetch-dependencies)
    - [Basic configuration](#basic-configuration)
    - [Migration](#migration)
    - [First login and test](#first-login-and-test)
- [Configuration](#configuration)
    - [Authentication & Authorization](#authentication--authorization)
    - [Walled garden](#walled-garden)
    - [Themes](#themes)
- [Deploying to Production](#deploying-to-production)
    - [Combine and minimize](#combine-and-minimize)
- [Troubleshooting](#troubleshooting)
- [Change log](#change-log)
- [Security](#security)
- [Issues](#issues)
- [Contributing](#contributing)
- [Credits & inspirations](#credits--inspirations)
- [License](#license)

## Features
* Based on Laravel 5.1 [LTS](https://en.wikipedia.org/wiki/Long-term_support)
* Theme engine using [yaapis/Theme](https://github.com/yaapis/Theme).
* Includes 3 themes based on [almasaeed2010/AdminLTE](https://github.com/almasaeed2010/AdminLTE).
* Custom Error pages: 
    * 403: Forbidden access.
    * 404: Page not found.
    * 500: Internal server error.
* Authentication & Authorization.
    * User authentication using Laravel's default model and middleware.
    * Role based authorization using [zizaco/entrust](https://github.com/zizaco/entrust).
        * User login.
        * User registration.
        * Reset forgot password.
    * User based permissions.
    * Dynamic assignment of permissions to application routes with matching authorization module.
    * Full management of users, roles, permissions & routes.
    * Optional LDAP/AD authentication using [sroutier/eloquent-ldap](https://github.com/sroutier/eloquent-ldap), with options to:
        * Automatically creates local account for LDAP/AD users on first login.
        * Automatic assignment of users to local roles based on matching LDAP/AD group membership.
        * Automatically refresh role assignment on user login.
* Optional walled garden mode.
* Laravel [Repositories](https://github.com/Bosnadev/Repositories).
* Flash notifications using [laracasts/flash](https://github.com/laracasts/flash).
* Internationalization (i18n).
* Gulp and Elixir ready to compile and minimize Sass & CoffeeScript.
* Bootstrap v3.3.4.
* Font-awesome v4.4.0.
* Ionic Framework v2.0.1.
* jQuery 2.1.4.
* Select2 4.0.0
* Select2 Bootstrap Theme v0.1.0-beta.4
* Development tools
    * Laravel [DebugBar](https://github.com/barryvdh/laravel-debugbar).
    * Laravel [IDE Helper](https://github.com/barryvdh/laravel-ide-helper).
    * Laravel [Packager](https://github.com/jeroen-g/laravel-packager)


## Roadmap
List of future feature and items that are still have to be completed, in no particular order:

* Gravatar integration.
* Implement soft-delete for Users, Roles, Permissions and maybe even Routes.
* Persistent notifications.
* Audit log of actions.
* Single sign-on for IIS and Apache.
* Breadcrumb.
* Dynamic menu based on roles/permissions.
* Favicon (one per theme?).
* Settings with precedence, Application vs User settings and DB vs .env file.
* Sortable tables.
* Datepicker for date fields.
* Chart & graph engine.
* Add comments in .env file.
* Work on this documentation:
    * Add a few screen-shots.
    * Add tips for deploying to PROD.
* Tweak session timeout.
* User switching and impersonation for admins.
* etc...


## Dependencies
* [PHP](http://php.net/supported-versions.php) >= 5.5.9
* [Composer](https://getcomposer.org/)
* [Node.js](https://nodejs.org): An older version may come with your distribution, you may be better off to install a recent version directly from the Web site, if you can. If you must use the version shipped with your distribution or OS, check the tip reported by [thassan](https://github.com/sroutier/laravel-5.1-enterprise-starter-kit/issues/6) in the [Troubleshooting](#troubleshooting) section.
* [npm](https://www.npmjs.com/): Should come with *Node.js* but you may have to install a separate package, really depends on your distribution and
the method that you selected to install *Node.js*.
* [PHP5 LDAP](http://php.net/manual/en/book.ldap.php): Binary extension for PHP, can probably be installed using 'apt' or 'yum' to match your installation of PHP.

## Installing

### Acquire a copy
There are multiple ways to acquire a copy of L51ESK. You can download a ZIP archive, clone the project and finally fork 
your own repository then clone it.

#### Download
To download a ZIP archive, simply got to the main repository page at of 
[L51ESK](https://github.com/sroutier/laravel-5.1-enterprise-starter-kit) and click on the "Download ZIP" button. 

#### Clone
Simply clone this repository on your machine using the command:

```
git clone https://github.com/sroutier/laravel-5.1-enterprise-starter-kit.git l51esk
```

#### Fork & Clone
Finally the recommended method would be to first fork this repository then clone your own repository. Follow this guide
to learn how to [fork an existing repository](https://help.github.com/articles/fork-a-repo/). Then use a command 
similar to this to clone your own repository:

```
git clone https://github.com/YOUR-NAME/laravel-5.1-enterprise-starter-kit.git l51esk
```

### Homestead (optional)
For development nothing is better than [Homestead](http://laravel.com/docs/5.1/homestead), I would highly recommend 
using it. 

If you choose to use Homestead, you will have to edit the *Homestead.yaml* config file, edit set the folder mappings and
site mappings. Additionally I like to set the *APP_ENV* variable to *development*. 

You can edit the config file with
```
homestead edit
```

Here is an example of what a *Homestead.yaml* might look like for this project:
```
---
ip: "192.168.10.10"
memory: 2048
cpus: 1
provider: virtualbox

authorize: ~/.ssh/id_rsa.pub

keys:
    - ~/.ssh/id_rsa

folders:
    - map: ~/projects
      to: /home/vagrant/projects

sites:
    - map: l51esk.dev
      to: /home/vagrant/projects/shared/l51esk/public

databases:
    - homestead

variables:
    - key: APP_ENV
      value: development
```

Next you will have to add an entry in your host file.
```
echo "192.168.10.10   l51esk-demo.dev" | sudo tee -a /etc/hosts
```

Finally the last step is to provision the Homestead VM.
```
homestead provision
```

Once provisioned, you can ssh into the running homestead VM, and change directory to the root of the project.
```
homestead ssh
cd projects/shared/l51esk
```


### Fetch dependencies

#### Composer
This project includes the file 'composer.lock'. The purpose of the 'composer.lock' file is to lock the version of the various
packages needed by a project as this one. By using the included lock file you are sure to use the same version of those 
packages as were used during the design. 

Fetch all dependencies using *composer* by issuing one of the following commands depending on which environment your are 
trying to configure:

For a development environment use:
```
composer install
```

For a production environment use:
```
composer install --no-dev
```


**_NOTE:_** To bypass to lock on package versions run the command *composer update*.

**_NOTE:_** On a production server, prior to running the *composer install* command, you will want to deploy a copy of your file 
*composer.lock* from your development server, to guarantee that the exact version of the various 
packages that you have developed on and tested gets installed. Never run the *composer update* 
command on a production server.


#### Node.js
Fetch all dependencies for Node.js using *npm* by using the following command:

```
npm install
```

**_NOTE:_** If the *npm install* command fails check the tip on *Node.js* in the [Troubleshooting](#troubleshooting) section.
### Basic configuration

#### Create your *.env* file
Create a *.env* file from the *.env.example* supplied.
```
cp .env.example .env
```

#### Generate application key
Generate the unique application key:
````
./artisan key:generate
````

#### Review default settings
Review and edit the *.env* file and all the files under */config*. Paying particular attention to */config/app.php* and 
*/config/database.php*. More details can be found in the [Configuring](#Configuring) and 
[Documentation](#Documentation) section below.

**_Note:_** By default all settings are set for a development environment, You will want to review and tweak before deploying to
Prod. 


### Migration
After having configured your database settings, you will want to build the database.
 
If you kept the default database settings your will first have to initialize the SQLite file
```
touch storage/database.sqlite
```

To run the migration scripts run this command
 ```
 ./artisan migrate
 ```
 
 To seed the database run the command below, note that in the development environment a few extra user and permissions
 are created.
 ```
 ./artisan db:seed
 ```

### First login and test
You should now be able to launch a Web browser and see your new Web application. To log in using the *root* account
the default password is *Password1*. Please change it ASAP.


## Configuration

### Authentication & Authorization
During the installation the database seeder scripts created a few things to help get started:

* The super user *root*.
* The roles *admins* and *users*.
* The permissions *basic-authenticated*, *guest-only* & *open-to-all*.

Additionally, on a development environment a few more test users and permissions would have been created.

The relationship between users, roles & permissions is relatively simple: users are assigned roles (many-to-many)
and roles are assigned permissions (many-to-many). This enables a simple role based permission assignment system.
For more information please refer to the documentation of the [zizaco/entrust](https://github.com/zizaco/entrust) 
package. Also while not recommended by autorization best practices, user based permission assignment is 
supported. Permissions can be directly assigned to individual users if needed.

Where things get a little more interesting is the addition of the *Route* model. Not to be confused with the 
[Route](http://laravel.com/api/5.1/Illuminate/Routing/Route.html) from Laravel, the *Route* model is still 
closely related to Laravel routes. In fact all *Routes* can be automatically built by inspecting the Web 
site routing table. Initially if you navigate to the *Admin > Security > Routes* page, you will be 
greeted with an empty table. To automatically load all routes defined within the Web site simply 
click on the *load* button. After a short delay, the page will reload and you will be able to 
assign any of the defined permission to each route.
 
Once *Routes* are assigned a single *Permission* each and permissions are assigned to *Roles* and finally *Users* are 
granted *Roles*, then the matching *AuthorizeRoute* middleware can authorize or block access to all routes for both 
guest and authenticated users. This feature will probably not be used by any site user or even administrators,
but by the site developer(s). In fact one of the first things that I would recommend is to restrict all routes
to the *Route* management pages to a permission given to developers only. What this feature does is make 
the authorization process very flexible, powerful and easy to change on the fly.
  
Some important hard-set rules to note are:

* Except when specifically stated otherwise below, routes, permissions, roles and users can be disabled.
* Routes
    * If a route is either not defined or not assigned any permission, it will not be accessible, except to the root 
    user or any user granted the admins role.
    * Routes to the controllers *AuthController* and *PasswordController* are not restricted by the *AuthorizeRoute* 
    middleware. Otherwise users could not log in or reset their passwords.
    * A route assigned the permission *open-to-all* will be authorize for all users, authenticated or not.
    * A route assigned the permission *guest-only* will only be authorized for guest users, not for authenticated ones.
    * A route assigned the permission *basic-authenticated* will be authorized for any user that has logged into the
    system. No other permission will be required. But the same route will be denied for guest users.
    * Failure to be authorized to access a route will redirect to the error page 403 (access denied).
    * When loading *Routes* from the Web site routing table, all routes to the *AuthController* and *PasswordController*
    will be skipped over. Also any route to the *DebugBar* will be skipped. If required they can be added by creating 
    a route manually.
    * Disabling a route prevents the route from being accessible or authorized.

* Permissions
    * The permissions *guest-only* and *basic-authenticated* cannot be edited or deleted.
    * A permission that is assigned to a *Route* or a *Role* cannot be deleted.
    * The permission *guest-only* cannot be assigned to any role. It is reserved for guest or un-authenticated users.
    * The permission *basic-authenticated* is forced onto every role.
    * The permission assignment for the role *admins* cannot be changed.
    * Disabling a permission prevents it from granting access to any route assigned to that permissions.

* Roles
    * The roles *admins* and *users* cannot be edited or deleted
    * The role *users* is force onto every user.
    * Disabling a role prevent prevents the users assigned this role from getting the abilities of that role.

* Users
    * The user *root* and any user with the *admin* role are not restricted by the *AuthorizeRoute* middleware. They 
    can go anywhere they want, even to routes that are either disabled or not defined.
    * If a user is disabled while he is logged into and using the Web site, he will get automatically logged out the 
    next time he tries to access a route protected by the *AuthorizeRoute* middleware.
    * The user *root* cannot be edited or deleted.
    * A user cannot disable or delete his own currently logged in user.

### LDAP/AD authentication.
To enable the optional LDAP/AD authentication module, set the *LDAP_ENABLED* variable to *true* in the *.env* file as shown 
below:
````
LDAP_ENABLED=true
````
By default the LDAP/AD authentication module is set to off or false, as it requires some extra configuration on your part.
For more information on how to configure the module, refer to documentation of the underlying package at 
[sroutier/eloquent-ldap](https://github.com/sroutier/eloquent-ldap). Additionally, every option is explained in the config file 
*/config/eloquent-ldap.php*.

### Walled garden
To enable the optional walled garden mode simply set the *WALLED_GARDEN* variable to *true* in the *.env* file as shown 
below:
````
WALLED_GARDEN=true
````
By default the walled garden mode is set to off or false. When enabled all guest or un-authenticated users will be 
redirected to the login page.

### Themes
The change the default theme, set the *DEFAULT_THEME* variable in the *.env* file:
````
DEFAULT_THEME=red
````
L51ESK comes with 3 themes: default, green and red.
Both the red and green themes inherit much of there look from the default theme which is mostly blue and based on the 
look of the [almasaeed2010/AdminLTE](https://github.com/almasaeed2010/AdminLTE) Web template.
For more details on how to configure and develop your own themes refer to the documentation of the 
[yaapis/Theme](https://github.com/yaapis/Theme) package.

## Deploying to production
Before deploying to a production or live server, you should take care of a few tasks.

### Combine and minimize
Although not required, it may be helpful to combine and minimize both the CSS and JS files. Add any CSS and JS file
that you may have added to the *styles* and *scripts* command (respectively) in the *gulpfile.js* and run the 
*gulp* command with the *--production* command line parameter to trigger the minimization process, as shown 
below:

```
gulp --production
```

## Troubleshooting
Below are some troubleshooting tips that we have encoutered and resolved:

### Node.js
As pointed out by [thassan](https://github.com/thassan) in [Issue 6](https://github.com/sroutier/laravel-5.1-enterprise-starter-kit/issues/6), 
if you distribution or OS ships with an older version of Node.js the name of the executable may be 'nodejs'. In recent versions the name has 
been changed to 'node'. This will cause some Node.js packages to fail during the installation as they expect to find the 'node' executable. 
To resolve this issue you can either create a symbolic link from the 'nodejs' executable to 'node', or you may want to consider installing 
a more recent version of Node.js.
To create a symbolic link issue the command:
```
sudo ln -s /usr/bin/nodejs /usr/bin/node
```

Also if the installation of the Node.js packages fails with a 'ENOENT' error, you may need to create a empty file at the root of the project as 
explained on [Stack Overflow](http://stackoverflow.com/questions/17990647/npm-install-errors-with-error-enoent-chmod). 
To create the empty file run:
```
touch .npmignore
```


## Change log
Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Security
If you discover any security related issues, please email sroutier@gmail.com instead of using the issue tracker.

## Issues
For the list of all current and former/closed issues see the [github issue list](https://github.com/sroutier/laravel-5.1-enterprise-starter-kit/issues).
If you find a problem, please follow the same link and create an new issue, I will look at it and get back to you ASAP.

## Contributing
I would be glad to accept your contributions if you want to participate and share. Just follow GitHub's guide on how 
to [fork a repository](https://help.github.com/articles/fork-a-repo/). Clone your repository to your machine, make 
your change then create a pull request after submitting your change to your repository.

## Credits & inspirations
It goes without saying that none of this could have been done without the great [Laravel](http://laravel.com/) 
framework, a big thank you goes out to [Taylor Otwell](http://taylorotwell.com/) and the hundreds of volunteers 
of the Laravel & Open Source community.

I would like to thank [Jeffrey Way](https://twitter.com/jeffrey_way) for the excellent [Laracast](https://laracasts.com/)
 a never ending source of knowledge.

Additionally credit goes out to the authors of the various components and modules, noted in the sections above, used 
as part of this project. 
 
Finally I would like to point to a number of projects that served as inspiration and great source of learning material.
These projects are similar to the L51ESK, but did not fully cover the requirements that I had. You may want to
 have a look at them, here is the list:
 
* [yajra/laravel-admin-template](https://github.com/yajra/laravel-admin-template) Laravel 4.2 Bootstrap Admin Starter Template, with Oracle DB Support.
* [start-laravel/sb-admin-laravel-5](https://github.com/start-laravel/sb-admin-laravel-5) Starter template / theme for Laravel 5.
* [Zemke/starter-laravel-angular](https://github.com/Zemke/starter-laravel-angular) Laravel and AngularJS Starter Application Boilerplate featuring Laravel 5 and AngularJS 1.3.13.
* [mrakodol/Laravel-5-Bootstrap-3-Starter-Site](https://github.com/mrakodol/Laravel-5-Bootstrap-3-Starter-Site) Laravel Framework 5 Bootstrap 3 Starter Site is a basic application with news, photo and video galleries.                                                                                                                
* [todstoychev/Laravel5Starter](https://github.com/todstoychev/Laravel5Starter) A Laravel 5 starter project. It contains user management with roles and basic admin panel with application settings.

### License
The L51ESK is open-sourced software licensed under the GNU General Public License Version 3 (GPLv3). 
Please see [License File](LICENSE.md) for more information.


[ico-version]: https://img.shields.io/badge/packagist-v0.1.0-orange.svg
[ico-license]: https://img.shields.io/badge/licence-GPLv3-brightgreen.svg

[link-packagist]: https://packagist.org/packages/sroutier/laravel-5.1-enterprise-starter-kit

