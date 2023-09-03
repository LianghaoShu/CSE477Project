<?php
/**
 * Created by PhpStorm.
 * User: Vincent Shu
 * Date: 3/17/2019
 * Time: 8:29 PM
 */

namespace Felis;


class HomeView extends View
{
    /**
     * Constructor
     * Sets the page title and any other settings.
     */
    public function __construct() {
        $this->setTitle("Felis Investigations");
        $this->addLink("login.php", "Log in");
    }

    /**
     * Add content to the header
     * @return string Any additional comment to put in the header
     */
    protected function headerAdditional() {
        return <<<HTML
<p>Welcome to Felis Investigations!</p>
<p>Domestic, divorce, and carousing investigations conducted without publicity. People and cats shadowed
	and investigated by expert inspectors. Katnapped kittons located. Missing cats and witnesses located.
	Accidents, furniture damage, losses by theft, blackmail, and murder investigations.</p>
<p><a href="">Learn more</a></p>
HTML;
    }

    /**
     * Add testimonial and name
     * @param $words
     * @param $name
     */
    public function addTestimonial($words, $name){
        $this->testimonials[] = ["testimonial" => $words, "writter" => $name];
    }

    /**
     *  Testimonials
     * @return string Testimonials and their writter
     */
    public function testimonials(){
        $indice = intdiv(count($this->testimonials), 2);
        $html = <<<HTML
        <section class="testimonials">
        <h2>TESTIMONIALS</h2>
        <div class="left">
HTML;
        for($i = 0;$i < $indice; $i++){
            $testimonial = $this->testimonials[$i]["testimonial"];
            $writter = $this->testimonials[$i]["writter"];
            $html.="<blockquote><p>$testimonial</p><cite>$writter</cite></blockquote>";
        }

        $html.= '</div>
    <div class="right">';
        for($j = $indice;$j < count($this->testimonials); $j++){
            $testimonial = $this->testimonials[$j]["testimonial"];
            $writter = $this->testimonials[$j]["writter"];
            $html.="<blockquote><p>$testimonial</p><cite>$writter</cite></blockquote>";
        }

        $html.= '    </div>
</section>';

        return $html;


    }

    private $testimonials = []; // the testimonial and their writter;
}