<?php
/*
 * class Pot contains both methods start and stop cooking
 */
final class Pot{
    /*
     * password for start cooking or stop cooking
     *
     * var string
     */
    private $password;
    /*
     * construct
     *
     * @param string $password
     */
    public function __construct($password){
        $this->password = $password;
    }
    /*
     * method that cooks something if the password exist
     *
     * @return bool
     */
    public function startCooking(){
        if($this->password == 'Cook, little pot, cook'){
            // cook something
            return true;
        }
        else{
            return false;
        }
    }
    /*
     * method that stop cooking if the password exist
     *
     * @return bool
     */
    public function stopCooking(){
        if($this->password == 'Stop, little pot'){
            // stop cooking
            return true;
        }
        else{
            return false;
        }
    }
}
/*
 * class AgedWoman
 */
abstract class AgedWoman{
    /*
     * Pot class object
     */
    private $pot;
    /*
     * construct
     *
     * @param string
     */
    public function __construct($password){
        $this->pot = new Pot($password);
    }
    /*
     *  start cooking or not, depends on the password
     */
    protected function potStartCooking(){
        $this->pot->startCooking();
    }
    /*
     *  stop cooking or not, depends on the password
     */
    protected function potStopCooking(){
        $this->pot->stopCooking();
    }
}

/*
 * class Daughter has both methods because has the password
 */
class Daughter extends AgedWoman{
}
/*
 * class Mother should knows only the
 */
class Mother extends Daughter{
}

