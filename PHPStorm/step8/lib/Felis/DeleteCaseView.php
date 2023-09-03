<?php
/**
 * Created by PhpStorm.
 * User: cqshu
 * Date: 3/25/2019
 * Time: 8:51 PM
 */

namespace Felis;


class DeleteCaseView extends View
{
    public function __construct(Site $site, $get){
        $this->site = $site;
        if(isset($get['id'])){
            $this->id = strip_tags($get['id']);
        }
        $this->setTitle('Felis Delete?');
        $this->addLink('staff.php','Staff');
        $this->addLink('cases.php','Cases');
        $this->addLink('./','Log out');
    }


    public function present(){
        $cases = new Cases($this->site);
        $case = $cases->get($this->id);
        $number = $case->getNumber();
        $html = <<<HTML
<form method="post" action="post/deleteCase.php">
        <fieldset>
            <legend>Delete?</legend>
            <input type="hidden" name="id" value="$this->id">
            <p>Are you sure absolutely certain beyond a shadow of
                a doubt that you want to delete case $number?</p>

            <p>Speak now or forever hold your peace.</p>

            <p><input type="submit" value="Yes" name="yes"> <input type="submit" value="No" name="no"></p>

        </fieldset>
</form>
HTML;
        return $html;

    }

    private $site;
    private $id;
}