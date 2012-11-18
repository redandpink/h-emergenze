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
  
  public function executeCheckState(sfWebRequest $request)
  {   $this->getContext()->getConfiguration()->loadHelpers('Asset');
      $c_image = image_path('control.png',true);
      $w_image = image_path('warning.png',true);
      $warning = array();
      $event = sensor_eventTable::getInstance()->createQuery('e')->
                select()->
                where('e.place_id = 2')->
                limit(1)->
                orderBy('e.created_at desc')->
                execute();
    
        
      if(!empty($event[0])){
          if(strlen($event[0]['description']) > 0){
              $warning[]=array('id'=>$event[0]['place_id'],'description'=>$event[0]['description'],'image'=>$w_image);
          }else{
              $warning[]=array('id'=>$event[0]['place_id'],'description'=>$event[0]['description'],'image'=>$c_image);
          }
      }
      
      $event = sensor_eventTable::getInstance()->createQuery('e')->
                select()->
                where('e.place_id = 3')->
                limit(1)->
                orderBy('created_at desc')->
                execute();
      if(!empty($event[0])){
          if(strlen($event[0]['description']) > 0){
              $warning[]=array('id'=>$event[0]['place_id'],'description'=>$event[0]['description'],'image'=>$w_image);
          }else{
              $warning[]=array('id'=>$event[0]['place_id'],'description'=>$event[0]['description'],'image'=>$c_image);
          }
      }
      
      $event = sensor_eventTable::getInstance()->createQuery('e')->
                select()->
                where('e.place_id = 4')->
                limit(1)->
                orderBy('created_at desc')->
                execute();
        
      if(!empty($event[0])){
          if(strlen($event[0]['description']) > 0){
              $warning[]=array('id'=>$event[0]['place_id'],'description'=>$event[0]['description'],'image'=>$w_image);
          }else{
              $warning[]=array('id'=>$event[0]['place_id'],'description'=>$event[0]['description'],'image'=>$c_image);
          }
      }
      
      $event = sensor_eventTable::getInstance()->createQuery('e')->
                select()->
                where('e.place_id = 5')->
                limit(1)->
                orderBy('created_at desc')->
                execute();
       if(!empty($event[0])){
          if(strlen($event[0]['description']) > 0){
              $warning[]=array('id'=>$event[0]['place_id'],'description'=>$event[0]['description'],'image'=>$w_image);
          }else{
              $warning[]=array('id'=>$event[0]['place_id'],'description'=>$event[0]['description'],'image'=>$c_image);
          }
      }
      
     return $this->renderText(json_encode($warning));
  }
  
  function executeShowInfo(sfWebRequest $request){
      $this->id = $request->getParameter('id');
  }
  
  function executeLayout(sfWebRequest $request){
  }
}
