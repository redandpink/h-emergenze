<?php

/**
 * Baseusers
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property clob $name
 * @property clob $surname
 * @property string $state
 * @property clob $avatar
 * @property integer $place_id
 * @property places $places
 * 
 * @method integer getId()       Returns the current record's "id" value
 * @method clob    getName()     Returns the current record's "name" value
 * @method clob    getSurname()  Returns the current record's "surname" value
 * @method string  getState()    Returns the current record's "state" value
 * @method clob    getAvatar()   Returns the current record's "avatar" value
 * @method integer getPlaceId()  Returns the current record's "place_id" value
 * @method places  getPlaces()   Returns the current record's "places" value
 * @method users   setId()       Sets the current record's "id" value
 * @method users   setName()     Sets the current record's "name" value
 * @method users   setSurname()  Sets the current record's "surname" value
 * @method users   setState()    Sets the current record's "state" value
 * @method users   setAvatar()   Sets the current record's "avatar" value
 * @method users   setPlaceId()  Sets the current record's "place_id" value
 * @method users   setPlaces()   Sets the current record's "places" value
 * 
 * @package    h-emergenze
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Baseusers extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('users');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('name', 'clob', null, array(
             'type' => 'clob',
             ));
        $this->hasColumn('surname', 'clob', null, array(
             'type' => 'clob',
             ));
        $this->hasColumn('state', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('avatar', 'clob', null, array(
             'type' => 'clob',
             ));
        $this->hasColumn('place_id', 'integer', null, array(
             'type' => 'integer',
             ));

        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('places', array(
             'local' => 'place_id',
             'foreign' => 'id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}