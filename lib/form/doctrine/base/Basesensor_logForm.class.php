<?php

/**
 * sensor_log form base class.
 *
 * @method sensor_log getObject() Returns the current form's model object
 *
 * @package    h-emergenze
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class Basesensor_logForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'temp'       => new sfWidgetFormInputCheckbox(),
      'water'      => new sfWidgetFormInputCheckbox(),
      'gas'        => new sfWidgetFormInputCheckbox(),
      'earthquake' => new sfWidgetFormInputCheckbox(),
      'place_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('places'), 'add_empty' => true)),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
      'latitude'   => new sfWidgetFormInputText(),
      'longitude'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'temp'       => new sfValidatorBoolean(array('required' => false)),
      'water'      => new sfValidatorBoolean(array('required' => false)),
      'gas'        => new sfValidatorBoolean(array('required' => false)),
      'earthquake' => new sfValidatorBoolean(array('required' => false)),
      'place_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('places'), 'required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
      'latitude'   => new sfValidatorPass(array('required' => false)),
      'longitude'  => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sensor_log[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'sensor_log';
  }

}
