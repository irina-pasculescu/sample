<?php
/* Pot interface knows only cook method
*/
interface Pot{
    /* will start cooking
    */
    public function startCooking();
}
/*
 * class agedWoman knows the stop method for Pot
 */
abstract class AgedWoman{
    /*
     * var bool
     */
    protected $stopCooking;

    public function __construct($stopCooking){
        $this->stoptCooking = $stopCooking;
    }
    /*
     * will stop cooking
     */
    abstract function stopCooking();
}
/*
 * class Daughter knows both methods cook and 'stop cooking'
 */
class Daughter extends AgedWoman implements Pot{
    /*
     * var bool
     */
    private $cook;

    public function __construct($startCooking, $stopCooking){
        $this->cook = $startCooking;
        parent::__construct($stopCooking);
    }
    /*
     * Will stop cooking
     *
     * return bool - for the moment
     */
    public function stopCooking(){
        // will unset pot
        return $this->stopCooking();
    }

    /*
     * Will start cooking
     *
     * return bool - for the moment
     */
    public function startCooking(){
        return $this->cook();
    }
}
/*
 * class Mother knows only cook method
 */
class Mother implements Pot{
    /*
     * var bool
     */
    private $cook;

    public function __construct(Daughter $obj){
        $this->cook = $obj->startCooking();
    }

    /*
     * Will start cooking
     *
     * return bool - for the moment
     */
    public function startCooking(){
        return $this->cook();
    }
}

