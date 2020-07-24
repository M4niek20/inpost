# inpost

## Install
0. Use xampp with php ^7.4
1. Import file 'sm_inpost.sql' to db named 'sm_inpost'.
2. Upload files to c://xampp/htdocs/
3. In console go to project directory and type 'composer install'
4. Go to C:\xampp\apache\conf\extra\httpd-vhosts.conf, edit in notepad and paste: 

<VirtualHost *:80> 
DocumentRoot "C:/xampp/htdocs/inpost/public" 
ServerName inpost.test 
</VirtualHost>

5. Go to C:\Windows\System32\drivers\etc, edit file 'hosts' and add line 
  127.0.0.1       inpost.test
6. Run xampp, Apache and MySql
7. App should be available at "inpost.test" url.

Virtualhosting is important for links placed in the application to work properly.

## Tasks realization
I used Symfony 5.1.2, php 7.4.8 and doctrine v2.7.1.
Entities are in 'src/Entity' folder. Barcode has unique feature and the expiration_date can be null.
There is many-to-many relationship between Owner and Product, realized by product_owners table. 
product can have multiple items using the 'stock' table.
I tried to make methods in entities for finding product by barcode and searching expired products for owner, but I had a problem with that. I have to learn this. I realized these functions in the owners and products controller.

## About project
This application was created for recruitment purposes in InPost company. 
This is my first project where i used doctrine ORM and symfony so i treated it as an educational project as well. For this reason the first commits were called "tutorial".
In my opinion, there are many similarities between symfony and the phalcon I have used so far. Phalcon also has its own ORM system, so there was a similarity here too.
The code can be a bit messy - I realize it - unfortunately the time to complete the task was limited, so instead of reading all the documentation I just had to write.
i highly reccomend using sql file as database - Functions for adding elements are not complete.
