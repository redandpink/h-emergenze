<?php

/**
 * sensor_event form base class.
 *
 * @method sensor_event getObject() Returns the current form's model object
 *
 * @package    h-emergenze
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class Basesensor_eventForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'temp'        => new sfWidgetFormInputCheckbox(),
      'water'       => new sfWidgetFormInputCheckbox(),
      'gas'         => new sfWidgetFormInputCheckbox(),
      'earthquake'  => new sfWidgetFormInputCheckbox(),
      'description' => new sfWidgetFormInputText(),
      'place_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('places'), 'add_empty' => true)),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'temp'        => new sfValidatorBoolean(array('required' => false)),
      'water'       => new sfValidatorBoolean(array('required' => false)),
      'gas'         => new sfValidatorBoolean(array('required' => false)),
      'earthquake'  => new sfValidatorBoolean(array('required' => false)),
      'description' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'place_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('places'), 'required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('sensor_event[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'sensor_event';
  }

}
