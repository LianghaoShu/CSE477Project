<?php
namespace Felis;

/**
 * Manage users in our system.
 */
class Validators extends Table {

    /**
     * Constructor
     * @param $site The Site object
     */
    public function __construct(Site $site) {
        parent::__construct($site, "validator");
    }

    /**
     * Create a new validator and add it to the table.
     * @param $userid User this validator is for.
     * @return The new validator.
     */
    public function newValidator($userid) {
        $validator = $this->createValidator();

        // Write to the table
        $sql = <<<SQL
INSERT INTO $this->tableName(userid, validator, date)
values(?, ?, ?)
SQL;

        $statement = $this->pdo()->prepare($sql);
        $statement->execute([
            $userid,$validator, date("Y-m-d H:i:s")
        ]);
        $id = $this->pdo()->lastInsertId();
        return $validator;
    }

    /**
     * Generate a random validator string of characters
     * @param $len Length to generate, default is 32
     * @return Validator string
     */
    public function createValidator($len = 32) {
        $bytes = openssl_random_pseudo_bytes($len / 2);
        return bin2hex($bytes);
    }

    /**
     * Determine if a validator is valid. If it is,
     * return the user ID for that validator.
     * @param $validator Validator to look up
     * @return User ID or null if not found.
     */
    public function get($validator) {

        // Write to the table
        $sql = <<<SQL
SELECT userid
FROM $this->tableName
WHERE validator = ?
SQL;

        $statement = $this->pdo()->prepare($sql);
        $statement->execute([
            $validator
        ]);
        if($statement->rowcount()===0){
            return Null;
        }
        $row = $statement->fetch(\PDO::FETCH_ASSOC);
        return $row['userid'];
    }

    /**
     * Remove any validators for this user ID.
     * @param $userid The USER ID we are clearing validators for.
     */
    public function remove($userid) {
        $sql = <<<SQL
DELETE FROM $this->tableName
WHERE userid = ? 
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute([
            $userid
        ]);

    }


}