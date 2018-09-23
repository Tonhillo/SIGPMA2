## <p align="center">SIGPMA</p>
Sistema De Gestión Del Parque Marino Del Pacífico.
Our System Was Created using Laravel 5.4, Blade, InfyOm, Spatie, Boostrap, JQuery, [ChartJS](http://www.chartjs.org), [BootstrapFormHelpers](http://bootstrapformhelpers.com) and few a More things..
More Info Below:::


<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>


## Learning Laravel

Laravel has the most extensive and thorough documentation and video tutorial library of any modern web application framework. The [Laravel documentation](https://laravel.com/docs) is thorough, complete, and makes it a breeze to get started learning the framework.

If you're not in the mood to read, [Laracasts](https://laracasts.com) contains over 900 video tutorials on a range of topics including Laravel, modern PHP, unit testing, JavaScript, and more. Boost the skill level of yourself and your entire team by digging into our comprehensive video library.

<p align="center"><img src="https://www.develodesign.co.uk/wp-content/uploads/2017/05/11235459_1117140114971426_5321744340345881526_o-1024x379.png"></p>

## Learning InfyOm

Infyom is a Laravel CRUD generator, APIs, Test Cases and Swagger Documentation.
you can find The [Infyom documentation](http://labs.infyom.com/laravelgenerator/) here 

<p align="center"><img src="https://avatars2.githubusercontent.com/u/7535935?s=400&v=4"></p>

## Learning Spatie

Spatie allows you to manage user permissions and roles in a database.
You can find The [Spatie documentation](https://github.com/spatie/laravel-permission) here 
# SIGMA-Sistema De Gestión del Parque Marino Del Pacífico.

### How to run this repo
1. Step 1: clone or download the repo(highly recommended clone with github in command console or [Github Desktop](https://desktop.github.com/)).
2. step 2: create a mySql Database on your localserver with the name `sigpma`. 
3. step 3: duplicate the file `.env.example` and rename it `.env` from your code editor.
4. step 4: update the next fields on your `.env` file :
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sigpma
DB_USERNAME=(your_localhost_user)
DB_PASSWORD=(your_localhost_password)

```
5. Optional: say a little prayer :pray:
6. step 5: in your command console go to your project (`cd project_path`) and run the command `composer install`.
7. step 6: run the command  `php artisan key:generate`.
8. step 7: run the command `php artisan migrate:refresh --seed`.
9. step 8: run the command  `php artisan serve`.
10. You're ready to go... :metal:
```
if (true){
  return 'may the force be with you'
}
```

# Commands
## Create Model, view(CRUD) and controller with DB connection.
1. In your command console go to your project (`cd project_path`) and run the command `php artisan infyom:scaffold $MODEL_NAME`, singular, lower case and snake_case, e.g `recinto` or `estanque` or `estanque_pecera` 
2. Here, you have to insert fields for you models, except id & timestamps (created_at & updated_at) fields. That will be automatically added by generator.
- # BE REALLY CAREFUL AND TEST EVERY MODEL BEFORE CREATE A NEW ONE..
### Fields you have to insert
- #### name - name of the field (snake_case recommended) e.g `nombre_recinto`
- #### db_type - database type. e.g.
- `string` - $table->string('field_name')
- `string,25` - $table->string('field_name', 25)
- `text`- $table->text('field_name')
- `integer`,false,true - $table->integer('field_name',false,true)
- `string`:unique - $table->string('field_name')->unique()
- `decimal`
- For foreign keys: `integer:unsigned:foreign,table_name,id` 

-  #### html field type for forms. e.g.
- `text` (in cases like names or short string data)
- `textarea`(in cases like descriptions, comments, observations..)
- `password`
- `number` (in cases like integer or decimals)
- ## Example of a full field insert: `nombre_recinto string text` or `cantidad integer number` or `volumen decimal number`
.3 Type key `Enter`
- #### Validations
- the console will ask you for validations, if you need more than one just put and space.
- `required`
- `min:5`
- `email`
- `numeric`
- you can use all the [laravel validations](https://laravel.com/docs/5.5/validation#validating-arrays)
- ## Example: `required` or `required min:5` or `required min:5 email`
4. Do the same for rest of the model fields, When you are done with inserting fields. Type "exit".
5. The console will ask you if you want yo do the migrations type `y` and key `Enter`
6. If you get the error `In Migrator.php line 417: Class not found on migration` 
- (in your code editor) go to the folder database->migrations and find the file `create_your_model_name_table.php`
- open it and change the class name to the name your console say can´t find.
- Run the command `php artisan migrate` or `php artisan migrate --seed` to seed the DB
7. Run the command `php artisan serve`and test the model
