<?php
/*
 * class Pot contains both methods start and stop cooking
 */
final class Pot{
    /**
     * Instance of this class
     *
     * var $_instance
     */
    private static $_instance;
    /*
     * good password for start cooking
     *
     * var string
     */
    const START_PASSWORD = 'Cook, little pot, cook!';
    /*
     * good password for stop cooking
     *
     * var string
     */
    const STOP_PASSWORD = 'Stop, little pot!';
    /*
     * received password for start cooking
     *
     * var string
     */
    private $startPassword;
    /*
     * received password for stop cooking
     *
     * var string
     */
    private $stopPassword;

    private function __construct(){
    }
    /**
     * Get an instance of this class
     *
     * @return Pot
     */
    public static function getInstance($startPassword, $stopPassword){
        if(!isset(self::$_instance) || is_null(self::$_instance)){
            self::$_instance = new Pot();
            self::$_instance->startPassword = $startPassword;
            self::$_instance->stopPassword = $stopPassword;
        }

        return self::$_instance;
    }
    /*
     * method that cooks something if the password exist
     *
     * @return bool
     */
    public function startCooking(){
        if($this->password == self::START_PASSWORD){
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
        if($this->password == self::STOP_PASSWORD){
            // stop cooking
            return true;
        }
        else{
            return false;
        }
    }
    public final function __clone() {
        throw new Exception ( "Cloning a Singleton is not allowed!" );
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
    public function __construct($startPassword, $stopPassword){
        $this->pot = Pot::getInstance($startPassword, $stopPassword);
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
    // show actions: start and stop cooking
    abstract function show();
}

/*
 * class Daughter has both methods because has the password
 */
class Daughter extends AgedWoman{
    /*
     *  show actions : start and stop
     */
    public function show(){
        $this->potStartCooking();
        $this->potStopCooking();
    }
}
/*
 * class Mother should knows only the
 */
class Mother extends Daughter{
    /*
     *  show actions : start and stop
     */
    public function show(){
        $this->potStartCooking();
        $this->potStopCooking();
    }
}

$startPassword = 'Cook, little pot, cook!';
$stopPassword = 'Stop, little pot!';
$stopPasswordInvalid = 'Just stop at once!';
$daughter = new Daughter($startPassword,$stopPassword);
$mother = new Mother($startPassword, $stopPasswordInvalid);

