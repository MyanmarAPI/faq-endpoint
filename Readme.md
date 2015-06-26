## Faq Endpoint
==========================
This repo is base on [PHP Endpoint Bootstrap](https://github.com/MyanmarAPI/php-endpoint-bootstrap)

### Installation

- Clone this repo
- run composer install

##### Applicaiont Environment

Create a file with name '.env' in your project root directory. And past the 
following code in it.

	API_APP_KEY=YourApiAppKey
	API_APP_SECRET=YourApiAppSecret

The value for **API_APP_KEY** and **API_APP_SECRET** should have 32 words which is combined with character 
and numeric.

##### For Local Test 

your app folder 
- php artisan db:seed

### Avaliable Api 
	
For all Faq

 - api/v1/faq

For Faq By id

 - api/v1/faq/question/{id}

For Faq By Question Type ( Yes/No or Open-Ended)

 - api/v1/faq/type?type=yes_no
 - api/v1/faq/type?type=open_ended

For Faq By Question Section

 - api/v1/faq/section?section=something

 For Faq By Question
 
 - api/v1/faq/find-question?question=something

All Faq result have paginate.Default is limit = 10. If u want to change limit u can set 

	- api/v1/faq?limit=3

and page too.

	- api/v1/faq?page=4
	

##### Route



### Technology

- [Lumne](http://lumen.laravel.com/) <Micro Framework from Larave>
- [Fractal](http://fractal.thephpleague.com/) <Composer package for REST API>
- [Monog lite](https://github.com/hexcores/mongo-lite) <Composer package for mongodb>
- [Api Support documentation](https://github.com/hexcores/api-support)
