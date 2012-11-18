<?php

/**
 * request actions.
 *
 * @package    h-emergenze
 * @subpackage request
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class requestActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeGet_places(sfWebRequest $request)
  {
      $places = placesTable::getInstance()->findAll();
      $i = 0;
      $resp = array();
      foreach ($places as $place):
          $event = sensor_eventTable::getInstance()->createQuery('e')->
                select()->
                where('e.place_id = '. $place['id'])->
                limit(1)->
                orderBy('created_at desc')->
                execute();
                
          $resp[$i]['id']= $place['id'];
          $resp[$i]['name']= $place['name'];
          $resp[$i]['type']= $place['place_type'];
          $resp[$i]['latitude']= $place['latitude'];
          $resp[$i]['longitude']= $place['longitude'];
          $resp[$i]['description']= (strlen($event[0]['description'])==0?'':$event[0]['description']);
          $resp[$i]['emergency']= (strlen($event[0]['description'])==0?false:true);
          $i++;
      endforeach;
      return $this->renderText(json_encode($resp));
  }
  
  
  
  public function executeGet_place_by_id(sfWebRequest $request)
  {
      $id = $request->getParameter('id');
      $place = placesTable::getInstance()->find($id);
      $event = sensor_eventTable::getInstance()->createQuery('e')->
                select()->
                where('e.place_id = '. $place['id'])->
                limit(1)->
                orderBy('created_at desc')->
                execute();
      $resp['id']= $place['id'];
      $resp['name']= $place['name'];
      $resp['type']= $place['place_type'];
      $resp['latitude']= $place['latitude'];
      $resp['longitude']= $place['longitude'];
      $resp['description']= (strlen($event[0]['description'])==0?'':$event[0]['description']);
      $resp['emergency']= (strlen($event[0]['description'])==0?false:true);
      return $this->renderText(json_encode($resp));
  }
  
  
  public function executeGet_description_warning_place_by_id(sfWebRequest $request)
  {
      $id = $request->getParameter('id');
      $place = placesTable::getInstance()->find($id);
      $event = sensor_eventTable::getInstance()->createQuery('e')->
                select()->
                where('e.place_id = '. $place['id'])->
                limit(1)->
                orderBy('created_at desc')->
                execute();
      $resp['id']= $place['id'];
      $resp['description']= (strlen($event[0]['description'])==0?'':$event[0]['description']);
      $resp['emergency']= (strlen($event[0]['description'])==0?false:true);
      return $this->renderText(json_encode($resp));
  }
  
  //cerco utenti nei safe places
  public function executeSearch_people_in_safe_place(sfWebRequest $request)
  {
      $this->getContext()->getConfiguration()->loadHelpers('Asset');
      $search_string = $request->getParameter('search_string');
      $search_string = str_replace('_', ' ', $search_string);
      $conditions = "(concat(u.name, ' ', u.surname) LIKE '%" . $search_string . "%' or   concat(u.surname, ' ', u.name) LIKE '%" . $search_string . "%')";
      $users = usersTable::getInstance()->createQuery('u')->
                select()->
                where($conditions)->
                execute();
      $i = 0;
      $resp = array();
      foreach ($users as $user):
          $resp[$i]['id']= $user['id'];
          $resp[$i]['name']= $user['name'];
          $resp[$i]['surname']= $user['surname'];
          $resp[$i]['status']= $user['state'];
          if(!empty($user['avatar'])){
            $resp[$i]['avatar']= image_path('avatar/'.$user['avatar'],true);
          }else{
              $resp[$i]['avatar'] = '';
          }
          $resp[$i]['place_id']= $user['place_id'];
          $resp[$i]['created_at']= $user['created_at'];
          $i++;
      endforeach;
      return $this->renderText(json_encode($resp));
  }
  
  
  /*lista utenti in safe place 
   * params: 
   * id :id del place
   */
  
  public function executeGet_people_in_safe_place(sfWebRequest $request)
  {
      $this->getContext()->getConfiguration()->loadHelpers('Asset');
      $place_id = $request->getParameter('id');
      $users = usersTable::getInstance()->findBy('place_id',$place_id);
      $i = 0;
      $resp = array();
      foreach ($users as $user):
          $resp[$i]['id']= $user['id'];
          $resp[$i]['name']= $user['name'];
          $resp[$i]['surname']= $user['surname'];
          if(!empty($user['avatar'])){
              $resp[$i]['avatar']= image_path('avatar/'.$user['avatar'],true);
          }else{
              $resp[$i]['avatar'] = '';
          }
          $resp[$i]['status']= $user['state'];
          $resp[$i]['created_at']= $user['created_at'];
          $i++;
      endforeach;
      
      return $this->renderText(json_encode($resp));
  }
  
  
  
  //funzioni per salvare dati
  public function executeStore_data(sfWebRequest $request)
  {
      $temp = $request->getParameter('temp');
      $water = $request->getParameter('water');
      $gas = $request->getParameter('gas');
      $earthquake = $request->getParameter('earthquake');
      
      $markers['venezia']['lat']= '45.43364';
      $markers['venezia']['lng']= '12.32391';
      $markers['venezia']['id']= '2';
      $markers['milano']['lat']= '45.46545';
      $markers['milano']['lng']= '9.18652';
      $markers['milano']['id']= '3';
      $markers['aquila']['lat']= '42.34840';
      $markers['aquila']['lng']= '13.37311';
      $markers['aquila']['id']= '4';
      $markers['roma']['lat']= '41.90151';
      $markers['roma']['lng']= '12.46077';
      $markers['roma']['id']= '5';
      
      foreach ($markers as $key => $value):
        $log = new sensor_log();
        $log['latitude'] = $value['lat'];
        $log['longitude'] = $value['lng'];
        $log['temp'] = ($key == 'roma'? $temp: 0);
        $log['water'] = ($key == 'venezia'? $water:0);
        $log['gas'] = ($key == 'milano'? $gas:0);
        $log['earthquake'] = ($key == 'aquila'? $earthquake:0);
        $log['place_id'] = $value['id'];
        $log->save();
        
        $event = sensor_eventTable::getInstance()->createQuery('e')->
                select()->
                where('e.place_id = '. $log['place_id'])->
                limit(1)->
                orderBy('created_at desc')->
                execute();
        
        if($log['place_id'] == 2 && (empty($event[0]) || $event[0]['water'] != $log['water'])){
            $event = new sensor_event();
            $event['temp'] = $log['temp'];
            $event['water'] = $log['water'];
            $event['gas'] = $log['gas'];
            $event['earthquake'] = $log['earthquake'];
            $event['description'] = ($log['water']?'Acqua alta':'');
            $event['place_id'] = $value['id'];
            $event->save();
        }
        
        if($log['place_id'] == 3 && (empty($event[0]) || $event[0]['gas'] != $log['gas'])){
            $event = new sensor_event();
            $event['temp'] = $log['temp'];
            $event['water'] = $log['water'];
            $event['gas'] = $log['gas'];
            $event['earthquake'] = $log['earthquake'];
            $event['description'] = ($log['gas']?'Fuga di gas':'');
            $event['place_id'] = $value['id'];
            $event->save();
        }
        
        if($log['place_id'] == 4 && (empty($event[0]) || $event[0]['earthquake'] != $log['earthquake'])){
            $event = new sensor_event();
            $event['temp'] = $log['temp'];
            $event['water'] = $log['water'];
            $event['gas'] = $log['gas'];
            $event['earthquake'] = $log['earthquake'];
            $event['description'] = ($log['earthquake']?'Terremoto':'');
            $event['place_id'] = $value['id'];
            $event->save();
        }
        
        if($log['place_id'] == 5 && (empty($event[0]) || $event[0]['temp'] != $log['temp'])){
            $event = new sensor_event();
            $event['temp'] = $log['temp'];
            $event['water'] = $log['water'];
            $event['gas'] = $log['gas'];
            $event['earthquake'] = $log['earthquake'];
            $event['description'] = ($log['temp']?'Incendio':'');
            $event['place_id'] = $value['id'];
            $event->save();
        }
        
      endforeach;
      
      return $this->renderText(json_encode(array('puppa'=>'melo')));
      
  }
  
  public function executeAdd_person_to_place(sfWebRequest $request)
  {
      $nome = $request->getParameter('name');
      $cognome = $request->getParameter('surname');
      $state = $request->getParameter('status');
      $avatar = $request->getParameter('avatar');
      $place_id = $request->getParameter('place_id');
      
      foreach ($request->getFiles() as $uploadedFile) {
        $pi = pathinfo($uploadedFile["name"]);
        $tmpFile = uniqid($pi["filename"] . '-', true) . '.' . $pi['extension'];
        $tmpFullFile = realpath('images/avatar') . '/' . $tmpFile;
        $chkUplodedFile = move_uploaded_file($uploadedFile["tmp_name"], $tmpFullFile);
      }
        
      $pi = pathinfo($tmpFile);
      $user = new users();
      $user['name'] = $nome;
      $user['surname'] = $cognome;
      $user['state'] = $state;
      $user['avatar'] = $tmpFile;
      $user['place_id'] = $place_id;
      $user->save();
      
      return $this->renderText(json_encode(array('save'=>'ok')));
  }
  
  public function executeTestAdd(sfWebRequest $request)
  {
      
  }
  
}
