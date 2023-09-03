<?php
/**
 * Created by PhpStorm.
 * User: Vincent Shu
 * Date: 3/26/2019
 * Time: 4:42 PM
 */

namespace Felis;


class UserView extends View
{
    public function __construct($site,$get){
        $this->site = $site;
        if(isset($get['i'])){
            $this->id = strip_tags($get['i']);
        }
        $this->setTitle('Felis Investigations Users');
        $this->addLink('staff.php','Staff');
        $this->addLink('users.php','Users');
        $this->addLink('./','Log out');
    }

    public function present() {
        $email = "";
        $name = "";
        $phone = "";
        $address = "";
        $note = "";
        $role = "";
        $html = <<<HTML
<form method="post" action="post/user.php">
	<fieldset>
		<legend>User</legend>
		<p>
			<label for="email">Email</label><br>
			
HTML;
        if($this->id){
            $users = new Users($this->site);
            $user = $users->get($this->id);
            $email = $user->getEmail();
            $name = $user->getName();
            $phone = $user->getPhone();
            $address = $user->getAddress();
            $role = $user->getRole();


        }
        $html.=<<<HTML
			<input type="email" id="email" name="email" placeholder="Email" value="$email">
		</p>
		<p>
			<label for="name">Name</label><br>
			<input type="text" id="name" name="name" placeholder="Name" value="$name">
		</p>
		<p>
			<label for="phone">Phone</label><br>
			<input type="text" id="phone" name="phone" placeholder="Phone" value="$phone">
		</p>
		<p>
			<label for="address">Address</label><br>
			<textarea id="address" name="address" placeholder="$address" ></textarea>
		</p>
		<p>
			<label for="notes">Notes</label><br>
			<textarea id="notes" name="notes" placeholder="$note" ></textarea>
		</p>
		<p>
			<label for="role">Role: </label>
			<select id="role" name="role">
HTML;
        if($role == "A"){
            $html.=<<<HTML
            <option value="admin" selected>Admin</option>
HTML;
        }
        else{
            $html.=<<<HTML
            <option value="admin">Admin</option>
HTML;
        }

        if($role == "S"){
            $html.=<<<HTML
            <option value="staff" selected>Staff</option>
HTML;
        }
        else{
            $html.=<<<HTML
            <option value="staff">Staff</option>
HTML;
        }

        if($role == "C"){
            $html.=<<<HTML
            <option value="client" selected>Client</option>
HTML;
        }
        else{
            $html.=<<<HTML
            <option value="client">Client</option>
HTML;
        }

$html.=<<<HTML
			</select>
		</p>
		<p>
			<input type="submit" value="OK"> <input type="submit" name="cancel" value="Cancel">
		</p>
		<input type="hidden" name="id" value="$this->id">

	</fieldset>
</form>

	<p>
		Admin users have complete management of the system. Staff users are able to view and make
		reports for any client, but cannot edit the users. Clients can only view the cases
		they have contracted for.
	</p>
HTML;

        return $html;
    }


    private $site;
    private $id;
}