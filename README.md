# Inertia Crud generator 

fresh install laravel 8 
 
 #### we depend on laravel-restify generator for api endpoints and when searching.   
 `$ composer require binaryk/laravel-restify`
 `$ php artisan restify:setup`
 


#### authentication is easy with jetstream . install jetstream
  `$ composer require laravel/jetstream`
  
  `$ php artisan jetstream:install inertia`
  
  #### then install  the package 
>Before running make a backup copy of app.js file
 

  ` composer require saidjon/inertia-crud-generator`
 ### then publish files
 
   `$ php artisan vendor:publish --tag=inertia-crud --force`
>This command makes following changes 
+  app.js will  overwritten . You can make changes to your needs from your backed copy of app.js if you desire 
+ publish inertia-crud.php into  /routes folder .  in web.php paste this
	`$  include_once('inertia-crud.php'); `
    + it will publish into js/
		*Components
		*plugins
		
  ###then paste this in resourses/css/app.css. you can there is notify,css file
   `$ @import 'notify.css'`
   + in your User model extend
	`$  Saidjon\InertiaCrudGenerator\Models\User` it is a typical laravel User.php file, just token attribute added so that we can use in inertia  .props.user.token
+ add csrf_token to use in inertia in app/Http/Middleware/HandleInertiaRequests 
	```php
	  public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            'csrf' =>csrf_token(),
        ]);
    }
	```
 
  
  

    
   #### then in your resources/css/app.css inlude notify.css  which exists in that folder

    
   #### copy these to package.json . remove duplicates
    
```JSON   
         "@ckeditor/ckeditor5-build-classic": "^34.0.0",
        "@ckeditor/ckeditor5-vue": "^4.0.0",
        "awesome-notifications": "^3.1.2",
        "@vue/babel-plugin-jsx": "^1.1.1",
        "@json-editor/json-editor": "^2.6.1",
        "vue-draggable-next": "^2.1.1",
        "vue-multiselect": "^3.0.0-alpha.2",
```
 
#### include routes/inertia-crud.php into routes/web.php
      

      
### run migrations . that's it . go to /admin 





