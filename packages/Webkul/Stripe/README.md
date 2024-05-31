### 1. Introduction:

Stripe payment – A easy way to split payment between the seller and admin.

* Provide split payment to sellers for your krayin CRM.
* Accept all the cards that the stripe supports.
* PCI(Payment Card Industry) Compliance.
* 3D Secure - Added security layer.

### 2. Requirements:

krayin-crm
Stripe

### 3. Installation:

* Unzip the respective extension zip and then merge "packages" folder into project root directory.

* Goto config/app.php file and add following line under 'providers'

~~~
Webkul\Stripe\Providers\StripeServiceProvider::class,
~~~

* Goto composer.json file and add following line under 'psr-4'

~~~
 "Webkul\\Stripe\\": "packages/Webkul/Stripe/src"
~~~

* Run these commands below to complete the setup

~~~
composer require stripe/stripe-php
~~~
~~~
php artisan route:cache
~~~
~~~
php artisan optimize:clear
~~~
~~~
php artisan vendor:publish --force

-> Press the number before "Webkul\Stripe\Providers\StripeServiceProvider" and then press enter to publish all assets and configurations.

~~~

> That's it, now just execute the project on your specified domain.

* For stripe connect need to add API key  [here](https://dashboard.stripe.com/test/apikeys) as provided below.

