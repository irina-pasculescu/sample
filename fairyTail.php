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
    /*
     * flag which keeps the first call for cooking
     */
    private $flag = false;

    /**
     * Construct of this class
     *
     * @param string $startPassword
     * @param string $stopPassword
     */
    public function __construct($startPassword, $stopPassword){
        $this->startPassword = $this->checkPassword($startPassword);
        $this->stopPassword = $this->checkPassword($stopPassword);
        $this->flag = true;
    }
    /*
     * Check password to be string and not empty
     * 
     * @param string $password
     * @return string for right type or empty string for wrong type
     */
    private function checkPassword($password){
        if(is_string($password) && strlen(trim($password)) > 0){
            $password = strip_tags($password);
        }
        else{
            $password = '';
        }

        return $password;
    }
    /*
     * Method that cooks something if the password exist
     * 
     * @return bool: true for cooking, false for not cooking
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
     * 
     * @return bool: true for stop cooking, false for not stoping
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
    * Identifier for sweet home
    */
    private $sweetHome;
    /*
    * Counting houses to feed
    */
    private $maxHouses;
    /*
    * Home to feed
    *
    * var array
    */
    private $home = '';
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
     * Sets the number of houses that will feed and shouldn't pass
     */
    public function setMaxHouses($maxHouses){
        $this->maxHouses = $maxHouses;
    }
    /*
    * Sets the number of home sweet home
    */
    public function setSweetHome($sweetHome){
        $this->sweetHome = $sweetHome;
    }
    /*
     * Feed some houses
     */
    protected function feedHome(){
        for($i = 1; $i <= $this->maxHouses; $i++){
            if($this->pot->startCooking()){
                $this->home .= 'Feed home! <br />';
            }
            if($this->pot->stopCooking()){
                $this->home .= 'Home ' . $i . ' fed! <br />';

                break;
            }
            if($i == $this->maxHouses/2)
            {
                echo "Please stop! You allready fed " . $i . " houses<br />";
            }
            if($i == $this->maxHouses)
            {
                echo "You fed " . $i . "  houses. Now you have to eat you way back..<br />";
                $this->eatTheWayBack();

                break;
            }
        }
        echo $this->home;
    }
    /*
     * Eat the way back to $maxHouses houses till you get home
     */
    private function eatTheWayBack(){
        $houses = $this->maxHouses;
        while($houses > 0){
            echo "Eat may way back to house " . $houses . "<br />";
            if($houses == $this->sweetHome){
                echo "Finally got home! No more eating!<br />";

                break;
            }
            $houses--;
        }
    }
    /*
     *  Start cooking or not, depends on the password
     */
    private function potStartCooking(){
        $this->pot->startCooking();
    }
    /*
     *  Stop cooking or not, depends on the password
     */
    private function potStopCooking(){
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

$daughter = new Daughter($startPassword, $stopPassword);
$daughter->setSweetHome(5);
$daughter->setMaxHouses(1);

$mother = new Mother($startPassword, $stopPasswordInvalid);
$mother->setMaxHouses(50);
$mother->setSweetHome(5);

$daughter->show();
$mother->show();