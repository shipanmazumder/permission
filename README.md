
## About Permission

This is a Module and Role Permission System. Admin can manage multiple user and user permission. It also manage dynamic menu system.

##Some ScreenShot
    ![Module Or Menu Add](https://i.imgur.com/Bklz24F.png)
    ![Role Add](https://i.imgur.com/4RJKlZu.png)
    ![Permisson Assign](https://i.imgur.com/Ej0Tzvx.png)

## Technology
[Laravel](https://laravel.com)
Version 6.0
## Installation Instruction
   First Download or Clone this project<br/>
    create an env file <br/>
    Run: composer update<br/>
    Then create a database</br>
    Run: php artisan migrate
    ==========================================
 ## Uses Instruction
  ```php
    public function index()
    {
        checkPermission("users",VIEW);
        //=============
    }
    public function add()
    {
        checkPermission("users",ADD);
       // =============
    }
    
    public function edit()
    {
        checkPermission("users",EDIT);
        =============
    }
    
    public function delete()
    {
        checkPermission("users",DELETE);
       // =============
    }
    //for check module active or not active
         if(hasActive("user")){
          //  ===================
         }
        
    //for check permission but not redirect
      if(hasPermission("users",DELETE)){
        //===============
      }
   ```
    for customize you can change 
    app/Helpers/Utli.php
 ## Directory
 <ul>
    <li>app/Helpers/Util.php</li>
    <li>app/Http/Controllers/Permission/*</li>
    <li>resource/views/admin/*</li>
    <li>public/admin/*</li>
 </ul>
  
 ## Requirements
- [PHP >= 7.2](http://php.net/)
- [Laravel 5.x|6.x](https://github.com/laravel/framework)

## About Author
Shipan Mazumder<br>
Full Stack Web Developer<br>
(www.shipansm.com)

