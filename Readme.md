## Faq Endpoint
==========================
This repo is base on [PHP Endpoint Bootstrap](https://github.com/MyanmarAPI/php-endpoint-bootstrap)

### Installation

- Clone this repo
- run composer install

##### Applicaiont Environment

Create a file with name '.env' in your project root directory.

##### For Local Test 

your app folder
 
	php artisan db:seed

### Avaliable Api 
	
For all Faq

	

- Optional Parameters

	type and section

Example -
	
	faq/v1?type=:type&section=:section

For Faq By id

	faq/v1/question/{id}

For Faq By Question

	faq/v1/search?q=:keyword

All Faq result have paginate.Default is 15. If u want to change limit u can set 

	api/v1/faq?per_page=3

and page too.

	api/v1/faq?page=4

### Technology

- [Lumne](http://lumen.laravel.com/) <Micro Framework from Larave>
- [Fractal](http://fractal.thephpleague.com/) <Composer package for REST API>
- [Monog lite](https://github.com/hexcores/mongo-lite) <Composer package for mongodb>
- [Api Support](https://github.com/hexcores/api-support)

### LICENSE

##### GNU Lesser General Public License v3 (LGPL-3)