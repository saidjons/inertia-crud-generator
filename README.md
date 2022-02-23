# Inertia Crud generator 

fresh install laravel 8 
 
 #### install infyom api generator 
 `$ composer require infyomlabs/laravel-generator`
 `$ php artisan  infyom:install`

#### install jetstream
  `$ composer require laravel/jetstream`
  
  `$ php artisan jetstream:install inertia`
  
  #### then install 
  
  ` composer require saidjon/inertia-crud-generator`
  
  #### this will also overwrite app.js file. backit up if you've made changes to it. after this code copy your changes into app.js
  
    `php artisan vendor:publish --tag=inertia-crud --force`
    
    #### then in your resources/css/app.css inlude notify.css  which exists in that folder
    `@import 'notify.css'`
    
    #### copy these to package.json . remove duplicates
    
    `   
    "awesome-notifications": "^3.1.2",
        "filepond-plugin-file-validate-type": "^1.2.6",
        "@vue/babel-plugin-jsx": "^1.1.1",
        "@json-editor/json-editor": "^2.6.1",
        "filepond-plugin-image-preview": "^4.6.10",
        "vue-filepond": "^7.0.2",
        "vuedraggable": "^4.1.0",
        "vuex": "^4.0.2" 
        `
        ### run 
        `npm install --save @ckeditor/ckeditor5-vue @ckeditor/ckeditor5-build-classic
`
      #### include routes/inertia-crud.php into routes/web.php
      
      ` include_once('inertia-crud.php'); `
      
    run migrations . that's it . go to /admin 

 
