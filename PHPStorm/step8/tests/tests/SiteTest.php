<?php
/**
 * Created by PhpStorm.
 * User: Vincent Shu
 * Date: 3/17/2019
 * Time: 10:31 PM
 */

class SiteTest extends \PHPUnit\Framework\TestCase
{
    public function test_getsetEmail(){
        $site = new Felis\Site();
        $site->setEmail(123);
        $this->assertEquals(123, $site->getEmail());
    }

    public function test_getsetRoot(){
        $site = new Felis\Site();
        $site->setRoot(123);
        $this->assertEquals(123, $site->getRoot());
    }

    public function test_getTablePrefix(){
        $site = new Felis\Site();
        $site->dbConfigure(1,2,3,4);
        $this->assertEquals(4,$site->getTablePrefix());


    }

    public function test_localize() {
        $site = new Felis\Site();
        $localize = require 'localize.inc.php';
        if(is_callable($localize)) {
            $localize($site);
        }
        $this->assertEquals('test8_', $site->getTablePrefix());
    }




}