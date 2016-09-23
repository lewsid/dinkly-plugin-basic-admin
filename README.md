Dinkly Basic Admin Plugin v1.01
===============================

A basic admin featuring user and group management, customizable profiles, and authentication


Installation
------------

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


License
-------

The Dinkly Basic Admin plugin is open-sourced software licensed under the MIT License.


Contact
-------

  - lewsid@lewsid.com (github.com/lewsid)