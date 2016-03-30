<?php

namespace infoweb\flexmail\behaviors;

use Yii;
use yii\base\Behavior;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;

class ContactBehavior extends Behavior
{
    /**
     * The id of the mailinglist that the contact needs to be saved to
     * @var int
     */
    public $mailingListId = null;

    /**
     * A map of the contact attributes and their corresponding attributes in the
     * owner model. The contact attributes have to be set as the key. The
     * available attributes are defined in infoweb\flexmail\components\services\Contact.
     * If the attribute is the attribute of a relation of the ower, it has to
     * be defined as "relationName::attributeName":
     *     eg. "profile::email" translates to $this->owner->profile->email
     * @var array
     */
    public $contactAttributes = [];

    /**
     * An array of callback functions that act as a filter for an attribute.
     * The keys are the names of the attribute in the owner (the value in the
     * contactAttributes array)
     *     eg: 'birthday' => function($value) {
     *             return date('d-m-Y', strtotime($value));
     *         }
     * @var array
     */
    public $attributeFilters = [];

    /**
     * With this parameter you can determine if contacts in Flexmail should be
     * overwritten or not
     */
    public $overWrite = true;

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'afterInsert',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterUpdate',
            ActiveRecord::EVENT_AFTER_DELETE => 'afterDelete'
        ];
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        // The Flexmail module has to be loaded so its component can be used
        if (!Yii::$app->hasModule('flexmail')) {
            throw new InvalidConfigException('The Flexmail module must be loaded.');
        }

        // A mailinglist ID has to be provided
        if ($this->mailingListId === null) {
            throw new InvalidConfigException('The "mailingListId" property must be set.');
        }

        parent::init();
    }

    public function afterInsert()
    {
        $this->createContact();
    }

    public function afterUpdate()
    {
        $this->createContact();
    }

    public function afterDelete()
    {
        $flexmailId = $this->createContact();
        if ($flexmailId) {
            $response = Yii::$app->flexmail->service('Contact')->delete([
                'mailingListId'    => $this->mailingListId,
                'emailAddressType' => [
                    'flexmailId' => $flexmailId
                ]
            ]);

            if ($response->errorCode != 0) {
                throw new \Exception('Flexmail contact not deleted');
            }
        }
    }

    /**
     * Creates / updates the contact in Flexmail
     *
     * @return int The flexmailId of the contact
     */
    protected function createContact()
    {
        // Create the contact in Flexmail
        $data = $this->buildContactData();
        $contact = Yii::$app->flexmail->service('Contact')->create($data);

        // Contact allready exists, update it
        if ($contact->errorCode == 225 && $this->overWrite) {
            // Add flexmailId from the response to the contact data
            $data['emailAddressType']['flexmailId'] = $contact->emailAddressId;

            $contact = Yii::$app->flexmail->service('Contact')->update($data);
        }

        // Creation failed
        if (!in_array($contact->errorCode, [0, 225])) {
            throw new \Exception('Flexmail contact not created');
        }

        return (isset($contact->emailAddressId)) ? $contact->emailAddressId : 0;
    }

    protected function buildContactData()
    {
        // Create data array
        $contactData = [
            'mailingListId' => $this->mailingListId,
            'emailAddressType' => []
        ];
        foreach ($this->contactAttributes as $k => $v) {
            if (!is_array($v)) {
                // The value has to be retrieved from a relation of the owner
                if (stripos('::', $v) !== false) {
                    $parts = explode('::', $v);
                    $attributeValue = $this->owner->{$parts[0]}->{$parts[1]};
                } else {
                    $attributeValue = $this->owner->attributes[$v];
                }
            }

            // Apply attribute filter if set
            if (isset($this->attributeFilters[$v])) {
                $attributeValue = call_user_func($this->attributeFilters[$v], $attributeValue);
            }

            $contactData['emailAddressType'][$k] = $attributeValue;
        }

        return $contactData;
    }
}