
### 1. Installation:

* Unzip the respective extension zip and then merge "packages" folder into project root directory.

* Goto config/app.php file and add following line under 'providers'

~~~
Webkul\Driver\Providers\DriverServiceProvider::class,
~~~

* Goto config/concord.php file and add following line under 'modules'

~~~
\Webkul\Driver\Providers\ModuleServiceProvider::class,
~~~

* Goto composer.json file and add following line under 'psr-4'

~~~
 "Webkul\\Driver\\": "packages/Webkul/Driver/src"
~~~

* Run these commands below to complete the setup
~~~
php artisan route:cache
~~~
~~~
php artisan optimize:clear
~~~
~~~
php artisan vendor:publish --force

-> Press the number before "Webkul\Driver\Providers\DriverServiceProvider" and then press enter to publish all assets and configurations.

~~~


### 2. Add code into file.

Goto packages/Webkul/Admin/src/DataGrids/Setting/AttributeDataGrid.php file and add following line under 'tabFilters.values'
~~~
[
    'name'      => trans('driver::app.datagrid.title'),
    'isActive'  => false,
    'key'       => 'drivers',
],
~~~
