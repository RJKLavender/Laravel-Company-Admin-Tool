## How to run this project 

In order to run this project you will of already needed to create a new laravel project and compuser installed into that project folder.
You will need to set the project name to "Company Admin Tool" and make sure your database is set to sql lite.
Lastly you will need to install bootstrap following the instructions in the readme here https://github.com/laravel/ui.

Once that is done you may copy these downloaded files to your project folder and overwrite all the files.

You will need a enviroment installed I used Herd for mine.

Then you will need to open up a terminal and run the following commands to the same project folder location (nagvigate using command cd).

php artisan migrate

php artisan db:seed --class=DatabaseSeeder

php artisan db:seed --class=CompanySeeder 

In order for the above command to work you need to make sure the images are in the directory storage/app/public/logos.

php artisan storage:link

---

## How to run your enviroment for this project

Then in order to run the tool in your browser you will need two terminals open and type the following command in the first terminal.

php artisan serve

And these commands in the second terminal.

npm install

npm run dev

If either of the commands above won't run replace npm with npm.cmd to bypass scripts protection.

---

## To allow for Image Upload Testing 

Now in order to  allow the form to upload images or the edit form to change images, you will need to update your php.ini file within the directory of C:/users/(your name)/.config/herd/.bin/(php version folder mine was php84)/php.ini.

Once you have found the file right click and edit it with notepad.

You will need to scroll through the file and find the following sections to update.

; Maximum size of POST data that PHP will accept.
; Its value may be 0 to disable the limit. It is ignored if POST data reading
; is disabled through enable_post_data_reading.
; https://php.net/post-max-size
post_max_size = 32M 

Make sure the post_max_size is set to 32M.

; Whether to allow HTTP file uploads.
; https://php.net/file-uploads
file_uploads = On

Make sure file_uploads is set to On.

; Temporary directory for HTTP uploaded files (will use system default if not
; specified).
; https://php.net/upload-tmp-dir
upload_tmp_dir = ""

Make sure upload_tmp_dir is set to the directory of your logos folder.

; Maximum allowed size for uploaded files.
; https://php.net/upload-max-filesize
upload_max_filesize = 32M

Make sure upload_max_filesize is set to 32M.

Then if you want to can increase the max number of file uploads.

; Maximum number of files that can be uploaded via a single request
max_file_uploads = 20

Once all the above is edited and updated save the file and re-run your php artisan serve and npm run dev terminals. 

Then you can test the project from here.

Hope you like the Admin tool I have created.

Note: Default Email and Password to login for testing are in the Database Seeder File, you can put your own into the user table as well.
