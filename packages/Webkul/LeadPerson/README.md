
### 1. Installation:

* Unzip the respective extension zip and then merge "packages" folder into project root directory.

* Goto config/app.php file and add following line under 'providers'

~~~
Webkul\LeadPerson\Providers\LeadPersonServiceProvider::class,
~~~

* Goto composer.json file and add following line under 'psr-4'

~~~
"Webkul\\LeadPerson\\": "packages/Webkul/LeadPerson/src"
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

-> Press the number before "Webkul\LeadContact\Providers\LeadContactServiceProvider" and then press enter to publish all assets and configurations.

~~~

### Need to add code

* Goto packages/Webkul/Admin/src/Resources/views/leads/view.blade.php file and add following line after '<contact-component :data='@json(old('person') ?: $lead->person)'></contact-component>'

~~~
     @include('LeadPerson::leads.contact.person.edit')

     <contact-lead-form-edit :data='@json(old('person') ?: $lead->person)'></contact-lead-form-edit>
~~~

* Goto packages/Webkul/Admin/src/Resources/views/leads/create.blade.php file and add following line after '<contact-component :data='@json(old('person'))'></contact-component>'

~~~
     @include('LeadPerson::leads.contact.person.create')
~~~