<?php
/**
 * Created by PhpStorm.
 * User: Lianghao Shu
 * Date: 2/10/2019
 * Time: 10:13 PM
 */
use Guessing\GuessingView as GuessingView;
use Guessing\Guessing as Guessing;

class GuessingViewTest extends \PHPUnit\Framework\TestCase{
    const seed = 1234;
    public function test_construct() {
        $guess = new Guessing(self::seed);
        $view = new GuessingView($guess);

        $this->assertInstanceOf('Guessing\GuessingView', $view);
    }

    public function test_present(){
        $guess = new Guessing(self::seed);
        $view = new GuessingView($guess);

        $status = $view->present();
        $this->assertContains("Guessing Game", $status);
        $this->assertContains("Try to guess the number.", $status);
        $this->assertContains("Guess:", $status);

        $guess->guess("garbage");
        $status = $view->present();
        $this->assertContains("Guessing Game", $status);
        $this->assertContains("Your guess of garbage is invalid!", $status);
        $this->assertContains("Guess:", $status);

        $guess->guess(12);
        $status = $view->present();
        $this->assertContains("Guessing Game", $status);
        $this->assertContains("After 1 guesses you are too low!", $status);
        $this->assertContains("Guess:", $status);

        $guess->guess(30);
        $status = $view->present();
        $this->assertContains("Guessing Game", $status);
        $this->assertContains("After 2 guesses you are too high!", $status);
        $this->assertContains("Guess:", $status);

        $guess->guess(23);
        $status = $view->present();
        $this->assertContains("Guessing Game", $status);
        $this->assertContains("After 3 guesses you are correct!", $status);




    }


}