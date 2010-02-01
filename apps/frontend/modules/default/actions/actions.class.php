<?php

/**
 * default actions.
 *
 * @package default
 * @author Wojciech Sznapka <wojciech@sznapka.pl> 
 * @license GPL
 */
class defaultActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $year = $request->getParameter('year', date('Y'));
    $this->day   = $this->getCurrentDay($year);
    $this->month = $this->getCurrentMonth($year);
  }
}
