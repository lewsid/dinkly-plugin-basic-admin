Dinkly Basic Admin Plugin v2.00
===============================

A basic admin featuring user and group management, customizable profiles, and authentication for use with the Dinkly framework.

Features:

  - Basic user authentication
  - Built-in brute-force login protection
  - Unix-style Groups and Permissions structure
  - Password reset functionality
  - Customizable timezones and date formatting
  - Responsive styling
  - Includes Bootstrap 4


Installation: Method 1 - Install as plugin
------------------------------------------

  1. Move the `basic_admin` folder into your dinkly project's `plugins` folder.

  2. Copy (and merge) the contents of `basic_admin/web` into your project's `web` folder.

  3. Add the following lines under the `plugins` section of your `config/config.yml` file:

  ```yaml
  basic_admin:
            apps:
                admin:
                    base_href: /admin     #It's recommended that you make this the same as your primary admin app
                    default_module: home
                    enabled: true
                    app_name: Dinkly Admin
                    app_description: Basic Admin
                    copyright: Dinkly
                    current_app_url: http://localhost:8888  #Used for the password reset emails
  ```

  4. Add database credentials under the `databases` section of your `config/config.yml` file if none are present:

  ```yaml
  dinkly:
            host: localhost
            user: root
            pass: root
            name: dinkly_app
  ```

  5. Build the models and load tables into the database: `php tools/gen_models.php -s dinkly -p basic_admin -i`

  6. Load basic data fixtures: `php tools/load_fixtures.php -s dinkly -p basic_admin`


Installation: Method 2 - Use as your app's core admin functionality
-------------------------------------------------------------------

  1. Drop the `admin` folder into your project's `apps` folder.

  2. Copy/merge the contents of the `config` folder into your project's `config` folder.

  3. Copy/merge the contents of the `classes` folder into your project's `classes` folder.

  4. Copy/merge the contents of `basic_admin/web` into your project's `web` folder.

  5. Add the following lines under the `apps` section of your `config/config.yml` file:

  ```yaml
  admin:
      base_href: /admin
      default_module: home
      enabled: true
      app_name: Dinkly Admin
      app_description: Basic Admin
      copyright: Dinkly
      current_app_url: http://localhost:8888  #Used for the password reset emails
  ```

  6. Add database credentials under the `databases` section of your `config/config.yml` file if none are present:

  ```yaml
  dinkly:
            host: localhost
            user: root
            pass: root
            name: <your app's database name>
  ```

  7. Build the models and load tables into the database: `php tools/gen_models.php -s dinkly -i`

  8. Load basic data fixtures: `php tools/load_fixtures.php -s dinkly`

  9. Search for `<?php include($_SERVER['APPLICATION_ROOT'] . 'plugins/basic_admin/apps/admin/layout/messaging.php'); ?>` and replace with `<?php include($_SERVER['APPLICATION_ROOT'] . 'apps/admin/layout/messaging.php'); ?>`



License
-------

The Dinkly Basic Admin plugin is open-sourced software licensed under the MIT License.


Contact
-------

  - lewsid@lewsid.com (github.com/lewsid)