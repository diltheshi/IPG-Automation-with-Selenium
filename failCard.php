<?php

require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;

class FailCard extends TestCase{
    
    protected $webDriver;
    
    // setUp function   
    public function setUp(): void
    {
        $capabilities = DesiredCapabilities::chrome();
        $this->webDriver = RemoteWebDriver::create('http://localhost:4444/wd/hub',$capabilities);
        
    }
  
    //tearDown function
    public function tearDown(): void
    {
        $this->webDriver->quit();
    }
    
    //testNewIPG function
    public function testNewIPG()
    {
        $this->webDriver->get('http://localhost/selenium-helpers/ipgv3.php?status=FAILED');
        $this->webDriver->manage()->window()->maximize();
        sleep(3);
        
        //button
        $payBtn = $this->webDriver->findElement(WebDriverBy::xpath('//*[@id="87-content"]/div/div/button'));
        $payBtn->click();
        
        sleep(5);
        
        //card number
        $cardNo = $this->webDriver->findElement(WebDriverBy::xpath('//*[@id="app"]/div[2]/div/div/div[1]/div[2]/div[2]/div/div/div/input'));
        
        if($cardNo)
        {
            $cardNo->sendKeys("5204730000002514");
            sleep(1);
        }
        
        //month and year of card expiration
        $monthYear = $this->webDriver->findElement(WebDriverBy::xpath('//*[@id="app"]/div[2]/div/div/div[1]/div[2]/div[4]/div/div/div/input'));
        
        if($monthYear)
        {
            $monthYear->sendKeys("0423");
            sleep(1);
        }
        
        //CVV
        $cvv = $this->webDriver->findElement(WebDriverBy::xpath('//*[@id="app"]/div[2]/div/div/div[1]/div[2]/div[4]/div/div/span/div[2]/div/input'));
        
        if($cvv)
        {
            $cvv->sendKeys("397");
        }
        
        sleep(2);
        
        //pay button
        $payBtn2 = $this->webDriver->findElement(WebDriverBy::xpath('//*[@id="app"]/div[2]/div/div/div[1]/div[2]/div[5]/div/div/button'));
        $payBtn2->click();
        sleep(10);
        
    }

    
}