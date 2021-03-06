<?php

    spl_autoload_register(function ($class_name) {
        include './'. $class_name . '.php';
    });

    class User extends Model {

        //STATIC VALUEs ---------------------------------------------------

        public static $TABLE_NAME = 'user';

        //ATTRIBUTEs ---------------------------------------------------
        
        private $id;
        private $name;
        private $email;
        private $password;
        private $image;
        private $created_at;
        private $verified_at;
        
        
        //Constructor ---------------------------------------------------

        public function __construct() {
            
        }
        
        //SETTERs ---------------------------------------------------

        public function setId($id) { $this->id = $id; }
        public function setName($name) { $this->name = $name; }
        public function setEmail($email) { $this->email = $email; }
        public function setPassword($password) { $this->password = $password; }
        public function setImage($image) { $this->image = $image; }
        public function setCreatedAt($created_at) { $this->created_at = $created_at; }
        public function setVerifiedAt($verified_at) { $this->verified_at = $verified_at; }

        //GETTERs ---------------------------------------------------
        
        public function getId() : int { return $this->id; }
        public function getName() : string { return $this->name; }
        public function getEmail() : string { return $this->email; }
        public function getPassword() : string { return $this->password; }
        public function getImage() : string { return $this->image; }
        public function getCreatedAt() { return $this->created_at; }
        public function getVerifiedAt() { return $this->verified_at; }
        
        //METHODs ---------------------------------------------------

        //FIND ALL Users --------------

        public static function getAll($TABLE_NAME = "") : array {

            $data = Model::getAll(self::$TABLE_NAME);

            $users = array();

            foreach($data as $info) {

                $user = new User();
                $user->setId($info['id']);
                $user->setName($info['name']);
                $user->setEmail($info['email']);
                $user->setPassword($info['password']);
                $user->setImage($info['image']);
                $user->setCreatedAt($info['created_at']);
                $user->setVerifiedAt($info['verified_at']);

                array_push($users, $user);
            }

            return $users;

        }

        //FIND User By --------------

        public static function getBy($value, $column = "", $TABLE_NAME = "") {

            $column = $column == "" ? "id" : $column;

            $data = Model::getBy($value, $column, self::$TABLE_NAME);

            if(count($data)) {

                $info = $data[0];

                $user = new User();
                $user->setId($info['id']);
                $user->setName($info['name']);
                $user->setEmail($info['email']);
                $user->setPassword($info['password']);
                $user->setImage($info['image']);
                $user->setCreatedAt($info['created_at']);
                $user->setVerifiedAt($info['verified_at']);

                return $user;

            } else {

                return null;

            }

        }

        //ADD User --------------

        public static function addUser(User $user) : bool {

            $query = 'insert into '. self::$TABLE_NAME .' values ( null, ?, ?, ?, ?, null, null )';
            $params = [
                $user->name,
                $user->email,
                $user->password,
                $user->image
            ];

            return Model::submitData($query, $params);

        }

        //UPDATE User --------------

        public function updateUser(User $newData) : bool {

            $query = 'update from '. self::$TABLE_NAME .' where id = ? ( ?, ?, ?, ?, ?, ? )';
            $params = [
                $this->id,
                $newData->name,
                $newData->email,
                $newData->password,
                $newData->image,
                $newData->created_at,
                $newData->verified_at
            ];

            return Model::submitData($query, $params);

        }

        //SEND VERIFICATION EMAIL -------------
        
        public function sendVerificationEmail() : bool {

            $WEBSITE_ADRESS = 'http://localhost/tutorialswebsite';

            $id = $this->id;
            $email = $this->email;
            $token = sha1($this->created_at);
            
            $subject = 'TUTORIALS WEBSITE : Verify your registration';
            $message = "
                <h2>Email Validation :</h2>
                <p><b>We did have your request to join us tutorials website team<b></p>
                <hr>
                <p>to complete your process visit this link below</p>
                <p><a href='$WEBSITE_ADRESS/api/user/verify-email.php?id=$id&email=$email&token=$token'>Sign up after Clicking here</a></p>
                <br><hr><br>
                <p>This message was sended automatically please don't reply!</p>";

            //from w3schools
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // More headers
            $headers .= 'From: <tutorials@newsletter.com>' . "\r\n";

            if(mail($email, $subject, $message, $headers))
                //Email sent
                return true;
            else
                return false;

        }

        //VERIFY EMAIL -----------------

        public function verifyEmail() {

            $query = 'update '. self::$TABLE_NAME .' set verified_at = current_timestamp where id = ?';
            $params = [ $this->id ];

            return Model::submitData($query, $params);

        }

    }

?>