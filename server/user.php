<?php
// reperesents the user when they log in. start session.
// the user of the website

class User {
    $this->loggedIn;
    $this->type;        // admin, normal etc... save this in db as well
    $this->error;
    $this->username;
    $this->password;

    function __construct($type) {
         $this->is_logged_in = false;
         $this->type = $type;
    }

    // getters and setters - setters probably not needed. only if have
    // other php classes that nees to call
    public function getType() {
        return $this->type;
    }

    public function getLoginStatus() {
        return $this->is_is_logged_in;
    }



    public function addUserToDB() {
        // call statically?
        if(DBU::insertIntoDB($this->username, $this->password)) {
            echo 'User successfully added';
        }
        else {
            echo 'User could not be entered into DB';
        }
    }

    public function removeUserFromDB() {
        DBU::deleteFromDB($user);
    }

    public function exists() {
        // query db with variables set upon construction
        $this->is_logged_in = true;
        return $this->is_logged_in; // in case someone needs to know
    }

    public function logIn() {


        // check db for user
        if($this->exists()) {
            // start session
        }
        else {
            echo 'Could not log in';
        }

    }

    public function logOut() {
        // terminate session
    }



}
