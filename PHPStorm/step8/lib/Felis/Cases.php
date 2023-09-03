<?php
/**
 * Created by PhpStorm.
 * User: Vincent Shu
 * Date: 3/24/2019
 * Time: 4:04 PM
 */

namespace Felis;


class Cases extends Table
{
    /**
     * Constructor
     * @param $site The Site object
     */
    public function __construct(Site $site) {
        parent::__construct($site, "case");
    }

    /**
     * Get a case by id
     * @param $id The case by ID
     * @return Object that represents the case if successful,
     *  null otherwise.
     */
    public function get($id){
        $users = new Users($this->site);
        $usersTable = $users->getTableName();

        $sql = <<<SQL
SELECT c.id, c.client, client.name as clientName,
       c.agent, agent.name as agentName,
       number, summary, status
from $this->tableName c,
     $usersTable client,
     $usersTable agent
where c.client = client.id and
      c.agent=agent.id and
      c.id=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($id));
        if($statement->rowCount() === 0) {
            return null;
        }

        return new ClientCase($statement->fetch(\PDO::FETCH_ASSOC));
    }

    public function insert($client , $agent, $number) {
        $sql = <<<SQL
insert into $this->tableName(client, agent, number, summary, status)
values(?, ?, ?, "", ?)
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        try {
            if($statement->execute([$client,
                        $agent,
                        $number,
                        ClientCase::STATUS_OPEN]
                ) === false) {
                return null;
            }
        } catch(\PDOException $e) {
            return null;
        }

        return $pdo->lastInsertId();
    }

    public function getCases(){
        $users = new Users($this->site);
        $usersTable = $users->getTableName();
        $sql=<<<SQL
SELECT  $this->tableName.id as id, $this->tableName.client as client,
		a.name as clientName, b.name as agentName, $this->tableName.agent as agent,
        $this->tableName.number as number,$this->tableName.summary as summary,
        $this->tableName.status as status
FROM $this->tableName
INNER JOIN $usersTable a
ON a.id = $this->tableName.client
JOIN $usersTable b
Where b.id = $this->tableName.agent
ORDER BY status desc, number asc
SQL;
       // echo $this->sub_sql($sql, []);
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute();
        if($statement->rowCount() === 0) {
            return array();
        }
        $cases = array();
        foreach( $statement->fetchAll(\PDO::FETCH_ASSOC) as $row){
            $case = new ClientCase($row);
            $cases[] = $case;
        }

        return $cases;

    }

    public function update($row){
        $id = $row['id'];
        $agentId = $row['agent'];
        $number = $row['number'];
        $summary = $row['summary'];
        $status = $row['status'];
        $sql =<<<SQL
UPDATE  $this->tableName
SET agent=?, number=?, summary =?, status=?
WHERE id = ?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        try{
            $statement->execute(array($agentId, $number, $summary, $status, $id));
        }catch(\PDOException $e){
            return false;
        }

        if ($statement->rowCount() === 0){
            return False;
        }
        return True;

    }

    public function delete($id){
        $sql =<<<SQL
DELETE FROM $this->tableName
WHERE id = ?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        try{
            $statement->execute(array($id));
        }catch(\PDOException $e){
            return false;
        }

        if ($statement->rowCount() === 0){
            return False;
        }
        return True;


    }




}