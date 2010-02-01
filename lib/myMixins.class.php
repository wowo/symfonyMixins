<?php

/**
 * simple mixin class
 * this class is built with listener method and two mixin methods
 *
 * @package default
 * @author Wojciech Sznapka <wojciech@sznapka.pl> 
 * @license GPL
 */
class myMixins
{
  /**
   * invoker action instance 
   * 
   * @var sfActions
   * @access private
   */
  private $actionInstance = NULL;

  /**
   * simple listener, it checks whether method from method_not_found event exists in this class
   * 
   * @param sfEvent $event 
   * @access public
   * @return boolean
   */
  public function listener(sfEvent $event)
  {
    // check if not found method exists in this mixin
    if (method_exists($this, $event['method'])) {
      // store action instance, it's passed in the event subject
      $this->actionInstance = $event->getSubject();
      // call mixin method with given arguments
      $result = call_user_func_array(array($this, $event['method']), $event['arguments']);
      // set result to the event, so it's accessible in the action
      $event->setReturnValue($result);
      // stop notify chain
      return true;
    } 
  }

  /**
   * gets current day with year; it also sets title of the page
   * 
   * @param int $year 
   * @access private
   * @return string
   */
  private function getCurrentDay($year)
  {
    $date = strftime('%A %Y', strtotime($year . date('-m-d')));
    $this->actionInstance->getResponse()->setTitle(sprintf("It's %s!", $date));
    return $date;
  }

  /**
   * gets current month
   * 
   * @param int $year 
   * @access private
   * @return string
   */
  private function getCurrentMonth($year)
  {
    return strftime('%B', strtotime($year . date('-m-d')));
  }
}
