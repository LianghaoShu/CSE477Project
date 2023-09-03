<?php
/**
 * Created by PhpStorm.
 * User: Vincent Shu
 * Date: 3/24/2019
 * Time: 5:00 PM
 */

namespace Felis;


class CasesView extends View{
    public function __construct(Site $site){
        $this->site = $site;
        $this->setTitle('Felis Investigations Cases');
        $this->addLink('staff.php', 'Staff');
    }


    public function present(){
        $html = <<<HTML
<form class="table" method="post" action="post\cases.php" >
	<p>
	<input type="submit" name="add" id="add" value="Add">
	<input type="submit" name="delete" id="delete" value="Delete">
	</p>

	<table>

		<tr>
			<th>&nbsp;</th>
			<th>Case Number</th>
			<th>Client</th>
			<th>Agent In Charge</th>
			<th class="desc">Description</th>
			<th>Most Recent Report</th>
			<th>Status</th>
		</tr>
HTML;

		/*<tr>
			<td><input type="radio" name="id"></td>
			<td><a href="case.php">16-0088</a></td>
			<td>Swift, Taylor</td>
			<td>Bogart, Humphrey</td>
			<td class="desc"><div>Tabby sneaking around her place.</div></td>
			<td>2-16-2016 11:32pm</td>
			<td>Open</td>
		</tr>
		<tr>
			<td><input type="radio" name="id"></td>
			<td><a href="case.php">16-0172</a></td>
			<td>Trump, Donald</td>
			<td>Martin, Harvey</td>
			<td class="desc"><div>Garbage cans regularly knocked over.</div></td>
			<td>2-12-2016 1:19am</td>
			<td>Open</td>
		</tr>

		<tr>
			<td><input type="radio" name="id"></td>
			<td><a href="case.php">16-0218</a></td>
			<td>Diamond, Olivia</td>
			<td>Martin, Harvey</td>
			<td class="desc"><div>Macavity stole her tuna caserole.</div></td>
			<td>1-12-2015 3:33am</td>
			<td>Closed</td>
		</tr>
	</table>
</form>

HTML;*/
        $cases = new Cases($this->site);
        $all = $cases->getCases();
        foreach($all as $case) {
            $id = $case->getId();
            $num = $case->getNumber();
            $client = $case->getClientName();
            $agent = $case->getAgentName();
            $summary = $case->getSummary();
            $open = $case->getStatus() === ClientCase::STATUS_OPEN ?
                "Open" : "Closed";

            $html .= <<<HTML
		<tr>
			<td><input type="radio" name="user" value="$id"></td>
			<td><a href="case.php?id=$id">$num</a></td>
			<td>$client</td>
			<td>$agent</td>
			<td class="desc"><div>$summary</div></td>
			<td></td>
			<td>$open</td>
		</tr>
HTML;
        }

        $html.= <<<HTML
	</table>
</form>
HTML;


        return $html;

    }

    private $site;
}