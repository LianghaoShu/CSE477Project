<?php
namespace Felis;

/**
 * Manage users in our system.
 */
class Users extends Table {

    /**
     * Constructor
     * @param $site The Site object
     */
    public function __construct(Site $site) {
        parent::__construct($site, "user");
    }

    /**
     * Test for a valid login.
     * @param $email User email
     * @param $password Password credential
     * @return User object if successful, null otherwise.
     */
    public function login($email, $password) {
        $sql =<<<SQL
SELECT * from $this->tableName
where email=?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($email));
        if($statement->rowCount() === 0) {
            return null;
        }

        $row = $statement->fetch(\PDO::FETCH_ASSOC);

        // Get the encrypted password and salt from the record
        $hash = $row['password'];
        $salt = $row['salt'];

        // Ensure it is correct
        if($hash !== hash("sha256", $password . $salt)) {
            return null;
        }

        return new User($row);
    }


    /**
     * Get a user based on the id
     * @param $id ID of the user
     * @return User object if successful, null otherwise.
     */
    public function get($id) {
        $sql =<<<SQL
SELECT * from $this->tableName
where id = ?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($id));
        if($statement->rowCount() === 0) {
            return null;
        }

        return new User($statement->fetch(\PDO::FETCH_ASSOC));

    }

    /**
     * Modify a user record based on the contents of a User object
     * @param User $user User object for object with modified data
     * @return true if successful, false if failed or user does not exist
     */
    public function update(User $user){
        $id = $user->getId();
        $email = $user->getEmail();
        $address = $user->getAddress();
        $notes = $user->getNotes();
        $role = $user->getRole();
        $phone = $user->getPhone();
        $name = $user->getName();
$sql =<<<SQL
UPDATE  $this->tableName
SET name=?,email=?, address=?, notes =?, role=?, phone=?
WHERE id = ?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        try{
            $statement->execute(array($name,$email, $address, $notes, $role, $phone, $id));
        }catch(\PDOException $e){
            return false;
        }

        if ($statement->rowCount() === 0){
            return False;
        }
        return True;

    }

    public function getClients(){
        $sql =<<<SQL
SELECT id,name FROM $this->tableName
WHERE role = 'C'
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute();

        if($statement->rowCount() === 0) {
            return null;
        }
       return $statement->fetchAll(\PDO::FETCH_ASSOC);




    }

    public function getAgents(){
        $sql = <<<SQL
SELECT id,name FROM $this->tableName
WHERE role = 'A' or role = 'S'
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute();

        if($statement->rowCount() === 0) {
            return null;
        }
        return $statement->fetchAll(\PDO::FETCH_ASSOC);

    }

    /**
     * Determine if a user exists in the system.
     * @param $email An email address.
     * @return true if $email is an existing email address
     */
    public function exists($email) {
        $sql =<<<SQL
SELECT * from $this->tableName
where email=?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($email));
        if($statement->rowCount() === 0) {
            return False;
        }

        return True;
    }

    /**
     * Create a new user.
     * @param User $user The new user data
     * @param Email $mailer An Email object to use
     * @return null on success or error message if failure
     */
    public function add(User $user, Email $mailer) {
        // Ensure we have no duplicate email address
        if($this->exists($user->getEmail())) {
            return "Email address already exists.";
        }

        // Add a record to the user table
        $sql = <<<SQL
INSERT INTO $this->tableName(email, name, phone, address, notes, joined, role)
values(?, ?, ?, ?, ?, ?, ?)
SQL;

        $statement = $this->pdo()->prepare($sql);
        $statement->execute([
            $user->getEmail(), $user->getName(), $user->getPhone(), $user->getAddress(),
            $user->getNotes(), date("Y-m-d H:i:s"), $user->getRole()
        ]);
        $id = $this->pdo()->lastInsertId();
        // Create a validator and add to the validator table
        $validators = new Validators($this->site);
        $validator = $validators->newValidator($id);
        // Send email with the validator in it
        $link = "http://webdev.cse.msu.edu"  . $this->site->getRoot() .
            '/password-validate.php?v=' . $validator;

        $from = $this->site->getEmail();
        $name = $user->getName();

        $subject = "Confirm your email";
        $message = <<<MSG
<html>
<p>Greetings, $name,</p>

<p>Welcome to Felis. In order to complete your registration,
please verify your email address by visiting the following link:</p>

<p><a href="$link">$link</a></p>
</html>
MSG;
        $headers = "MIME-Version: 1.0\r\nContent-type: text/html; charset=iso=8859-1\r\nFrom: $from\r\n";
        $mailer->mail($user->getEmail(), $subject, $message, $headers);
    }

    /**
     * Set the password for a user
     * @param $userid The ID for the user
     * @param $password New password to set
     */
    public function setPassword($userid, $password) {
        $sql1=<<<SQL
SELECT $this->tableName.salt
FROM $this->tableName
WHERE id = ?
SQL;
        $statement = $this->pdo()->prepare($sql1);

        $statement->execute([
            $userid
        ]);

        $salt = ($statement->fetch(\PDO::FETCH_ASSOC))['salt'];
        $hash = hash("sha256", $password . $salt);

        $sql2 = <<<SQL
UPDATE $this->tableName
SET password = ?, salt=?
WHERE id = ?
SQL;
        $statement = $this->pdo()->prepare($sql2);
        $statement->execute([
            $hash ,$salt,$userid
        ]);

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