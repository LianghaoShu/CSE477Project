<?php
/**
 * Created by PhpStorm.
 * User: cqshu
 * Date: 3/25/2019
 * Time: 5:49 PM
 */

namespace Felis;


class CaseView extends View
{
    public function __construct(Site $site, $get){
        $this->site = $site;
        if(isset($get['id'])){
            $this->id = $get['id'];
        }
        $this->setTitle('Felis Investigations Case');
        $this->addLink('staff.php','Staff');
        $this->addLink('cases.php','Cases');
        $this->addLink('./','Log out');
    }

    public function  present(){
        $cases = new Cases($this->site);
        $case = $cases->get($this->id);
        $client = $case->getClientName();
        $number = $case->getNumber();
        $summary = $case->getSummary();
        $inChargeAgent = $case->getAgent();
        $status = $case->getStatus();

        $html = <<<HTML
<form method="post" action="post/case.php">
<input type="hidden" name="id" value="$this->id">
	<fieldset>
		<legend>Case</legend>
		<p >Client: $client</p>

		<p>
			<label for="number">Case Number: </label>
			<input type="text" id="number" name="number" placeholder="Case Number"
				   value="$number">
		</p>
		<p>
			<label for="summary">Summary</label><br>
			<input type="text" id="summary" name="summary" placeholder="Summary"
				   value="$summary">
		</p>

		<p>
			<label for="agent">Agent in Charge: </label>
			
			<select id="agent" name="agent">
HTML;

        $users = new Users($this->site);
        $agents = $users->getAgents();
        foreach($agents as $agent){
            $id = $agent['id'];
            $name = $agent['name'];
            $html.= '<option value="' . $id . '"';
            if ($inChargeAgent === $agent['id']){
                $html.= 'selected >';
            }
            else{
                $html.= '>';
            }
            $html.= <<<HTML
$name</option>
HTML;
        }
               $html.= <<<HTML
			</select>
		</p>
		<p>
			<label for="status">Status: </label>
			<select id="status" name="status">
			
HTML;
            $html.=<<<HTML
<option
HTML;
            if($status === "O"){
                $html.=<<<HTML
 selected> Open </option>
HTML;
            }
            else{
                $html.=<<<HTML
>Open </option>
HTML;
            }

            $html.=<<<HTML
<option
HTML;
            if($status === 'C'){
                $html.=<<<HTML
 selected> Close </option>
HTML;
            }
            else{
                $html.=<<<HTML
>Close </option>
HTML;
            }

        $html.= <<<HTML
			</select>
		</p>
		<p>
			<input type="submit" value="Update">
		</p>

		<div class="notes">
		<h2>Notes</h2>

		<div class="timelist">
			<div class="report">
				<div class="info">
					<p class="time">2/10/2016 11:35am</p>
					<p class="agent">Martin, Harvey</p>
				</div>
				<p>Initial meeting with client. He's very concerned
					Felix will just not shut up at night. It's not like him to caterwaul so much, so there
					must be something going on in the neighborhood.</p>

			</div>

			<div class="report">
				<div class="info">
					<p class="time">2/14/2016 2:15pm</p>
					<p class="agent">Martin, Harvey</p>
				</div>
				<p>Met with the client to discuss the case.</p>
			</div>
		</div>

		<p>
			<label for="note">Notes</label><br>
			<textarea id="note" name="note" placeholder="Note"></textarea>
		</p>
		<p>
			<input type="submit" value="Add Note">
		</p>
		</div>

		<div class="reports">
			<h2>Reports</h2>

			<div class="timelist">
				<div class="report">
					<div class="info">
						<p class="time"><a href="report.php">2/12/2016 1:35am</a></p>
						<p class="agent">Martin, Harvey</p>
					</div>
					<p>Surveillance of neighborhood for three hours. Nothing untoward spotted.</p>

				</div>
			</div>

			<div class="timelist">
				<div class="report">
					<div class="info">
						<p class="time"><a href="report.php">2/13/2016 2:15am</a></p>
						<p class="agent">Martin, Harvey</p>
					</div>
					<p>Surveillance of neighborhood for two hours. Spotted a very attractive
						Siamese cat wandering though. Caterwauling commenced.</p>

				</div>
			</div>

			<p>
				<input type="submit" value="Add Report">
			</p>
		</div>

	</fieldset>
</form>
HTML;



       return $html;
    }

    private $site;
    private $id;
}