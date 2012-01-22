<?php
ini_set('display_errors',1);
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
    /*
     * flag which keeps the first call
     */
    private $flag = false;

    /**
     * Construct of this class
     *
     * @param string $startPassword
     * @param string $stopPassword
     */
    public function __construct($startPassword, $stopPassword){
        $this->startPassword = $startPassword;
        $this->stopPassword = $stopPassword;
        $this->flag = true;
    }
    /*
     * Method that cooks something if the password exist
     *
     */
    public function startCooking(){
        if($this->startPassword == self::START_PASSWORD && $this->flag){
            echo "Pot start cooking!<br />";
            $this->flag = false;
            return true;
        }
        elseif($this->startPassword != self::START_PASSWORD){
            echo "Pot won't start cooking!<br />";
            return false;
        }
    }
    /*
     * Method that stop cooking if the password exist
     */
    public function stopCooking(){
        if($this->stopPassword == self::STOP_PASSWORD && !$this->flag){
            echo "Pot stop cooking!<br />";
            $this->flag = false;
            return true;
        }
        elseif($this->stopPassword != self::STOP_PASSWORD){
            echo "Pot won't stop cooking!<br />";
            return false;
        }
    }
}
/*
 * class AgedWoman
 */
abstract class AgedWoman{
    /*
    * Counting houses to feed
    */
    const COUNT_HOUSES = 100;
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
     * feed some houses
     */
    protected function feedHome(){
        for($i = 1; $i <= self::COUNT_HOUSES; $i++){
            if( $this->pot->startCooking()){
                $this->home[$i] = 'Feed home! <br />';
            }
            if( $this->pot->stopCooking()){
                $this->home[$i] = 'Home ' . $i . ' fed! <br />';
                break;
            }
            if($i == self::COUNT_HOUSES/2)
            {
                echo "Please stop! You allready fed " . $i . " houses<br />";
            }
            if($i == self::COUNT_HOUSES)
            {
                echo "You fed " . $i . "  houses. Now you have to eat you way back..<br />";
                break;
            }
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
$daughter = new Daughter($startPassword,$stopPassword);
$mother = new Mother($startPassword, $stopPasswordInvalid);

$daughter->show();
$mother->show();