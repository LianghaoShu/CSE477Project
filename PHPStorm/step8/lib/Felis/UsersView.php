<?php
/**
 * Created by PhpStorm.
 * User: Vincent Shu
 * Date: 3/26/2019
 * Time: 4:42 PM
 */

namespace Felis;


class UsersView extends View
{

    public function __construct($site){
        $this->site = $site;
        $this->setTitle('Felis Investigations Users');
        $this->addLink('staff.php','Staff');
        $this->addLink('./','Log out');
    }

    public function present() {
        $users = new Users($this->site);
        $clients = $users->getClients();
        $agents = $users->getAgents();
        $html = <<<HTML
<form class="table" method="post" action="post/users.php">
	<p>
	<input type="submit" name="add" id="add" value="Add">
	<input type="submit" name="edit" id="edit" value="Edit">
	<input type="submit" name="delete" id="delete" value="Delete">
	</p>

	<table>
		<tr>
			<th>&nbsp;</th>
			<th>Name</th>
			<th>Email</th>
			<th>Role</th>
		</tr>
HTML;
        if(count($agents)!==0) {
            foreach ($agents as $agent) {
                $id = $agent['id'];
                $name = $agent['name'];
                $user = $users->get($id);
                $email = $user->getEmail();
                $status = $user->getRole();
                switch ($status) {
                    case $user::ADMIN:
                        $status = 'Admin';
                        break;

                    case $user::STAFF:
                        $status = 'Staff';
                        break;

                }
                $html .= <<<HTML
<tr>
			<td><input type="radio" name="id" value="$id" ></td>
			<td>$name</td>
			<td>$email</td>
			<td>$status</td>
		</tr>
HTML;
            }
        }

if(count($clients) !==0  ) {
    foreach ($clients as $client) {
        $id = $client['id'];
        $name = $client['name'];
        $user = $users->get($id);
        $email = $user->getEmail();
        $html .= <<<HTML
<tr>
			<td><input type="radio" name="id" value="$id" ></td>
			<td>$name</td>
			<td>$email</td>
			<td>Client</td>
		</tr>
HTML;
    }
}
/*		<tr>
			<td><input type="radio" name="user"></td>
			<td>Bogart, Humphrey</td>
			<td>bogart@felis.com</td>
			<td>Admin</td>
		</tr>
		<tr>
			<td><input type="radio" name="user"></td>
			<td>Spade, Sam</td>
			<td>spade@felis.com</td>
			<td>Staff</td>
		</tr>
		<tr>
			<td><input type="radio" name="user"></td>
			<td>Bacall, Lauren</td>
			<td>bacall@gmail.com</td>
			<td>Client</td>
		</tr>*/
        $html.= <<<HTML
	</table>
</form>
HTML;

        return $html;
    }


    private $site;
}