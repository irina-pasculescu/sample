<?php
ini_set('display_errors', 1);
/*
 * Class Pot contains both methods start and stop cooking
 */
final class Pot{
    /*
     * Good password for start cooking
     *
     * var string
     */
    const START_PASSWORD = 'Cook, little pot, cook!';
    /*
     * Good password for stop cooking
     *
     * var string
     */
    const STOP_PASSWORD = 'Stop, little pot!';
    /*
     * Received password for start cooking
     *
     * var string
     */
    private $startPassword;
    /*
     * Received password for stop cooking
     *
     * var string
     */
    private $stopPassword;

    /**
     * Construct of this class
     *
     * @param string $startPassword
     * @param string $stopPassword
     */
    public function __construct($startPassword, $stopPassword){
        $this->startPassword = $startPassword;
        $this->stopPassword = $stopPassword;
    }
    /*
     * Method that cooks something if the password exist
     *
     */
    public function startCooking(){
        if($this->startPassword == self::START_PASSWORD){
            echo "Pot start cooking! ";
            return true;
        }
        else{
            echo "Pot can't start cooking! ";
            return false;
        }
    }
    /*
     * Method that stop cooking if the password exist
     */
    public function stopCooking(){
        if($this->stopPassword == self::STOP_PASSWORD){
            echo "Pot stop cooking! ";
            return true;
        }
        else{
            echo "Pot can't stop cooking! ";
            return false;
        }
    }
}
/*
 * class AgedWoman
 */
abstract class AgedWoman{
    /*
    * Home to feed
    *
    * var array
    */
    private $home = array();
    /*
     * Pot class object
     * 
     * var object
     */
    private $pot;
    /*
     * Construct of the class
     *
     * @param string
     */
    public function __construct($startPassword, $stopPassword){
        $this->pot = new Pot($startPassword, $stopPassword);
    }
    /*
     * Feed one Home
     */
    protected function feedHome(){
        if( $this->pot->startCooking()){
            $this->home[] = 'Feed home! ';
        }
        if( $this->pot->stopCooking()){
            $this->home[] = 'Home fed! ';
        }
        echo implode(' ', $this->home);
    }
    /*
     *  Start cooking or not, depends on the password
     */
    protected function potStartCooking(){
        $this->pot->startCooking();
    }
    /*
     *  Stop cooking or not, depends on the password
     */
    protected function potStopCooking(){
        $this->pot->stopCooking();
    }

    // Show actions: start and stop cooking
    abstract function show();
}
/*
 * class Daughter has both methods because has the password
 */
class Daughter extends AgedWoman{
    /*
     *  Show actions : start and stop
     */
    public function show(){
        $this->feedHome();
    }
}
/*
 * Class Mother should knows only the
 */
class Mother extends Daughter{
    /*
     *  Show actions : start and stop
     */
    public function show(){
        $this->feedHome();
    }
}

$startPassword = 'Cook, little pot, cook!';
$stopPassword = 'Stop, little pot!';
$stopPasswordInvalid = 'Just stop at once!';
$daughter = new Daughter(1,$stopPassword);
$mother = new Mother($startPassword, $stopPasswordInvalid);

$daughter->show();
$mother->show();