# urlino.com - a slightly more complex example of a Zend Framework based application 

(http://www.urlino.com) is a very basic short url service which mainly serves as an example
for a slighly more complex example for a Zend Framework based application that deals with some very 
common tasks like i18n, integration of Javascript Frameworks(Dojo in this case) and a structure for adding
own functionality to the framework.

Please absolutely feel free to use this in any way and don't forget to push fixes/improvement back, I 
will be more than happy to integrate them :-)!

## Installation

To get started create a fresh MySql database named zf und a user zf with password zf on localhost and 
copy ./application/configs/application_localhost.ini to ./application/configs/application.ini

Go to [http://framework.zend.com/download/latest] and download the laterst version of Zend Framework and 
copy the folder library/Zend from the downloaded package to ./library   

The directory ./resources/sql contains the file setup.sql providing al needed sql to initialize the 
database. I also added the Eclipse project files  

## License

This project is released under MIT license.