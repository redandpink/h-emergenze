<?php

/**
 * home actions.
 *
 * @package    h-emergenze
 * @subpackage home
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class homeActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
     
  }
  
  public function executeMarkers(sfWebRequest $request){
       $this->places = placesTable::getInstance()->findAll();
       $this->setLayout(false);  
       $this->getResponse()->setContentType('text/xml');  
  }
}
