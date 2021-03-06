<?php

/**
 * sensor_log filter form base class.
 *
 * @package    h-emergenze
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class Basesensor_logFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'temp'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'water'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'gas'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'earthquake' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'place_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('places'), 'add_empty' => true)),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'latitude'   => new sfWidgetFormFilterInput(),
      'longitude'  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'temp'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'water'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'gas'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'earthquake' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'place_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('places'), 'column' => 'id')),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'latitude'   => new sfValidatorPass(array('required' => false)),
      'longitude'  => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sensor_log_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'sensor_log';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'temp'       => 'Boolean',
      'water'      => 'Boolean',
      'gas'        => 'Boolean',
      'earthquake' => 'Boolean',
      'place_id'   => 'ForeignKey',
      'created_at' => 'Date',
      'updated_at' => 'Date',
      'latitude'   => 'Text',
      'longitude'  => 'Text',
    );
  }
}
