<?php
/**
 * Created by PhpStorm.
 * User: Vincent Shu
 * Date: 3/18/2019
 * Time: 1:19 PM
 */

class UsersTest extends \PHPUnit\Framework\TestCase
{
    private static $site;

    public static function setUpBeforeClass() {
        self::$site = new Felis\Site();
        $localize  = require 'localize.inc.php';
        if(is_callable($localize)) {
            $localize(self::$site);
        }
    }

    public function test_pdo() {
        $users = new Felis\Users(self::$site);
        $this->assertInstanceOf('\PDO', $users->pdo());
    }

    protected function setUp() {
        $users = new Felis\Users(self::$site);
        $tableName = $users->getTableName();

        $sql = <<<SQL
delete from $tableName;
insert into $tableName(id, email, name, phone, address, 
                      notes, password, joined, role)
values (7, "dudess@dude.com", "Dudess, The", "111-222-3333", 
        "Dudess Address", "Dudess Notes", "87654321", 
        "2015-01-22 23:50:26", "S"),
        (8, "cbowen@cse.msu.edu", "Owen, Charles", "999-999-9999", 
        "Owen Address", "Owen Notes", "super477", 
        "2015-01-01 23:50:26", "A"),
        (9, "bart@bartman.com", "Simpson, Bart", "999-999-9999", 
        "", "", "bart477", "2015-02-01 01:50:26", "C"),
        (10, "marge@bartman.com", "Simpson, Marge", "", "",
        "", "marge", "2015-02-01 01:50:26", "C")
SQL;

        self::$site->pdo()->query($sql);
    }

    public function test_login() {
        $users = new Felis\Users(self::$site);

        // Test a valid login based on email address
        $user = $users->login("dudess@dude.com", "87654321");
        $this->assertInstanceOf('Felis\User', $user);
        $this->assertEquals("dudess@dude.com", $user->getEmail());
        $this->assertEquals("Dudess, The", $user->getName());
        $this->assertEquals("111-222-3333", $user->getPhone());
        $this->assertEquals("Dudess Address", $user->getAddress());
        $this->assertEquals("Dudess Notes", $user->getNotes());
        $this->assertEquals("S", $user->getRole());
        $this->assertEquals(strtotime('2015-01-22 23:50:26'), $user->getJoined());


        // Test a valid login based on email address
        $user = $users->login("cbowen@cse.msu.edu", "super477");
        $this->assertInstanceOf('Felis\User', $user);
        $this->assertEquals("cbowen@cse.msu.edu", $user->getEmail());
        $this->assertEquals("Owen, Charles", $user->getName());
        $this->assertEquals("999-999-9999", $user->getPhone());
        $this->assertEquals("Owen Address", $user->getAddress());
        $this->assertEquals("Owen Notes", $user->getNotes());
        $this->assertEquals("A", $user->getRole());
        $this->assertEquals(strtotime('2015-01-01 23:50:26'), $user->getJoined());


        // Test a failed login
        $user = $users->login("dudess@dude.com", "wrongpw");
        $this->assertNull($user);




    }

    public function test_get(){
        $users = new Felis\Users(self::$site);
        $user = $users->get(7);
        $this->assertInstanceOf('Felis\User', $user);
        $this->assertEquals("dudess@dude.com", $user->getEmail());
        $this->assertEquals("Dudess, The", $user->getName());
        $this->assertEquals("111-222-3333", $user->getPhone());
        $this->assertEquals("Dudess Address", $user->getAddress());
        $this->assertEquals("Dudess Notes", $user->getNotes());
        $this->assertEquals("S", $user->getRole());
        $this->assertEquals(strtotime('2015-01-22 23:50:26'), $user->getJoined());

        $user = $users->get(8);
        $this->assertInstanceOf('Felis\User', $user);
        $this->assertEquals("cbowen@cse.msu.edu", $user->getEmail());
        $this->assertEquals("Owen, Charles", $user->getName());
        $this->assertEquals("999-999-9999", $user->getPhone());
        $this->assertEquals("Owen Address", $user->getAddress());
        $this->assertEquals("Owen Notes", $user->getNotes());
        $this->assertEquals("A", $user->getRole());
        $this->assertEquals(strtotime('2015-01-01 23:50:26'), $user->getJoined());


        $user = $users->get(11);
        $this->assertNull($user);
    }


    public function test_update(){
        $row = array('id' => 10,
            'email' => 'cbowen@cse.msu.edu',
            'name' => 'Dude, The',
            'phone' => '123-456-7890',
            'address' => 'Some Address',
            'notes' => 'Some Notes',
            'password' => '12345678',
            'joined' => '2015-01-15 23:50:26',
            'role' => 'S'
        );

        $row1 = array('id' => 100,
            'email' => 'cbowen@cse.msu.edu',
            'name' => 'Dude, The',
            'phone' => '123-456-7890',
            'address' => 'Some Address',
            'notes' => 'Some Notes',
            'password' => '12345678',
            'joined' => '2015-01-15 23:50:26',
            'role' => 'S'
        );
        $users = new Felis\Users(self::$site);
        $user = new Felis\User($row);
        $this->assertFalse($users->Update($user));

        $user = new Felis\User($row1);
        $this->assertFalse($users->Update($user));




    }
}