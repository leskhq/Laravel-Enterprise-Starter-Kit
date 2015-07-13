# Laravel 5.1 - Enterprise starter kit (L51ESK)


## Description
L51ESK, is a template project based on the [Laravel](http://laravel.com/) framework v5.1, combining a set of features 
that can kit start any Web application for the Internet or on an Intranet. What makes this project unique, from what
I have seen, are two key features, the optional LDAP & Active Directory authentication (not completed yet, but soon)
and the dynamic authorization module. But wait there is more, keep reading...


**_Note:_** 

The project is not completed just yet. As you will see in the notes below there is still a lot left to do, but I wanted 
to release and open it up to the world as one of it's differentiating feature seemed to answer someone request 
on [StackOverflow](http://stackoverflow.com/questions/31350993/way-to-set-a-route-in-a-php-laravel-app-as-being-restricted-for-users-with-permi). 
I am still actively working on this, so please come back soon and often for updates with new releases and features.


## Contents
- [Features](#Features)
- [Future](#Future)
- [Installing](#Installing)
- [Configuring](#Configuring)
- [Documentation](#Documentation)
- [Troubleshooting](#Troubleshooting)
- [Issues](#Issues)
- [Contributing](#Contributing)
- [Credits & inspirations](#Credits%20%26%20inspirations)
- [License](#License)

## Features
* Based on Laravel 5.1
* Theme engine using [yaapis/Theme](https://github.com/yaapis/Theme).
* Includes 3 themes based on [almasaeed2010/AdminLTE](https://github.com/almasaeed2010/AdminLTE).
* User authentication.
* Role based authorization using [zizaco/entrust](https://github.com/zizaco/entrust).
    * User login.
    * User registration.
    * Reset forgot password.
* Full management of users, roles & permissions.
* Dynamic assignment of permissions to application routes with matching authorization module.
* Laravel [Repositories](https://github.com/Bosnadev/Repositories).
* Flash notifications using [laracasts/flash](https://github.com/laracasts/flash).
* Internationalization (i18n).
* Bootstrap v3.3.4.
* Font-awesome v4.3.0.
* Ionic Framework v2.0.1.
* jQuery 2.1.4.
* Laravel [DebugBar](https://github.com/barryvdh/laravel-debugbar).
* Laravel [IDE Helper](https://github.com/barryvdh/laravel-ide-helper).
* Custom Error pages: 
    * 403: Forbidden access.
    * 404: Page not found.
    * 500: Internal server error.


## Future
List of future feature and items that are still have to be completed, in no particular order, more like a brain dump:

* Gravatar integration.
* Implement soft-delete for Users, Roles, Permissions and maybe even Routes.
* Persistant notifications.
* Audit log of actions.
* LDAP/AD integration.
* Single sign-on for IIS and Apache.
* Breadcrumb.
* Dynamic menu based on roles/permissions.
* Favicon (one per theme?).
* Settings with precedence, Application vs User settings and DB vs .env file.
* Sortable tables.
* Select2 for select boxes.
* Datepicker for date fields.
* Chart & graph engine.
* Add comments in .env file.
* Work on this documentation:
    * Add a few screen-shots.
    * Add tips for deploying to PROD.
* Tweak session timeout.
* User switching and impersonation for admins.
* etc...


## Installing

### Acquire a copy
There are multiple ways to acquire a copy of L51ESK. You can download a ZIP archive, clone the project and finally fork 
then clone.

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
site mappings. Additionally I like to set the *APP_ENV* variable to *developmnet*. 

You can edit the config file with
```
homestead edit
```

Here is an example of a *Homestead.yaml*
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
Fetch all dependencies using *composer* by issuing the following command:

```
composer install
```

**_Note:_** 

On a production server, prior to running the composer command, you will want to deploy a copy of the file 
*composer.lock* from your development server, to guarantee that the exact version of the various 
packages that you have developed on and tested gets installed. Never run the *composer update* 
command on a production server.


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

**_Note:_** 

By default all settings are set for a development environment, You will want to review and tweak before deploying to
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

### Done
You should now be able to launch a Web browser and see your new Web application. To log in using the *root* account
the default password is *Password1*. Please change it ASAP.


## Configuring


## Documentation


## Troubleshooting
More later...

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
The L51ESK is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
