# IPG Automation with Selenium
In this projet the Chrome browser is used for demonstration.
> NOTE: You must have selenium-server-standalone to run this application.

>NOTE: JAVA should be available in your machine.
## Getting Started
1. Clone this repository to your local directory.

2. Include ``selenium-helpers`` folder inside the htdocs folder of the XAMPP server.

3. Create a Composer.json file and add the following dependencies using it. 
The Composer.json file has to contain the following.

```
require":
{
    "php":">=7.1",
    "phpunit/phpunit":"^9",
    "phpunit/phpunit-selenium": "*",
    "php-webdriver/webdriver":"1.8.0",
    "symfony/symfony":"4.4"
}
```
4. Run XAMPP server. 

    Navigate to your local directory from the command prompt,

5. Run the selenium-server-standalone with the following command. 
```
java -jar <Your-selenium-server-file-name>.jar
```

6. Run newIPG.php or failCard.php file with the appropriate command. 
Eg. 
```
.\vendor\bin\phpunit newIPG.php
```
or   

```
.\vendor\bin\phpunit failCard.php
```