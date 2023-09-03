<?php
/**
 * Created by PhpStorm.
 * User: Vincent Shu
 * Date: 4/23/2019
 * Time: 8:44 AM
 */

namespace Noir;


class Cookies extends Table
{
    public function __construct(Site $site) {
        parent::__construct($site, "cookie");
    }


    /**
     * Create a new cookie token
     * @param $user User to create token for
     * @return New 32 character random string
     */
    public function create($user) {
        $salt = $this->createValidator();
        $hash = hash("sha256", $salt);
        // Write to the table
        $sql = <<<SQL
INSERT INTO $this->tableName(user,salt, hash,date)
values(?, ?,?,?)
SQL;

        $statement = $this->pdo()->prepare($sql);
        $statement->execute([
            $user,$salt,$hash,date("Y-m-d H:i:s")
        ]);
        return $salt;

    }

    public function createValidator($len = 32) {
        $bytes = openssl_random_pseudo_bytes($len / 2);
        return bin2hex($bytes);
    }

    /**
     * Validate a cookie token
     * @param $user User ID
     * @param $token Token
     * @return null|string If successful, return the actual
     *   hash as stored in the database.
     */
    public function validate($user, $token) {
        $hash = hash("sha256", $token);
        $sql= <<<SQL
SELECT * FROM $this->tableName
where user=? and hash=?
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute([
            $user,$hash
        ]);

        if($statement->rowCount() === 0) {
            return null;
        }
        $row = $statement->fetch(\PDO::FETCH_ASSOC);

        return $hash;



    }

    /**
     * Delete a hash from the database
     * @param $hash Hash to delete
     * @return bool True if successful
     */
    public function delete($hash) {
        $sql = <<<SQL
DELETE FROM $this->tableName
WHERE hash = ?
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute([
            $hash
        ]);

        if($statement->rowCount()===0){
            return false;
        }
        return true;

    }
}