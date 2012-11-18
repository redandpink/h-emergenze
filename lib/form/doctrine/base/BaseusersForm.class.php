<?php

/**
 * users form base class.
 *
 * @method users getObject() Returns the current form's model object
 *
 * @package    h-emergenze
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseusersForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'name'       => new sfWidgetFormTextarea(),
      'surname'    => new sfWidgetFormTextarea(),
      'state'      => new sfWidgetFormInputText(),
      'avatar'     => new sfWidgetFormTextarea(),
      'place_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('places'), 'add_empty' => true)),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'       => new sfValidatorString(array('required' => false)),
      'surname'    => new sfValidatorString(array('required' => false)),
      'state'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'avatar'     => new sfValidatorString(array('required' => false)),
      'place_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('places'), 'required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('users[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'users';
  }

}
