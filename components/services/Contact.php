<?php
namespace infoweb\flexmail\components\services;

use Yii;

class Contact extends Service
{
    /**
     * Create a new Contact
     *
     * Parmeters example:
     * ------------------
     * $parameters = array (
     *      "mailingListId"         =>  116911,               // int mandatory
     *      "emailAddressType"      =>  array(                // array mandatory
     *          "emailAddress"      =>  "foobar@flexmail.eu", // string mandatory
     *          "title"             =>  "Mister"              // string optional
     *          "name"              =>  "John",               // string opt
     *          "surname"           =>  "Doe",                // string opt
     *          "address"           => "",                    // string opt
     *          "zipcode"           => "",                    // string opt
     *          "city"              => "",                    // string opt
     *          "country"           => "",                    // string opt
     *          "phone"             => "",                    // string opt
     *          "fax"               => "",                    // string opt
     *          "mobile"            => "",                    // string opt
     *          "website"           => "",                    // string opt
     *          "language"          => "",                    // string opt
     *          "gender"            => "",                    // string opt
     *          "birthday"          => "1968-08-05",          // string (YYYY-MM-DD) opt
     *          "company"           => "",                    // string opt
     *          "function"          => "",                    // string opt
     *          "market"            => "",                    // string opt
     *          "employees"         => 0,                     // int opt
     *          "nace"              => "",                    // string opt
     *          "turnover"          => "",                    // string opt
     *          "vat"               => "",                    // string opt
     *          "keywords"          => "",                    // string opt
     *          "free_field_1"      => "",                    // string opt
     *          "free_field_2"      => "",                    // string opt
     *          "free_field_3"      => "",                    // string opt
     *          "free_field_4"      => "",                    // string opt
     *          "free_field_5"      => "",                    // string opt
     *          "free_field_6"      => "",                    // string opt
     *          "barcode"           => "",                    // string opt
     *          "custom"            => array()                // array opt
     *     )
     * );
     *
     * @param Array $parameters Associative array with properties of an
     *                          emailAddressType object and a mailingListId
     *
     * @return emailAddressId
     */
    public function create($parameters)
    {
        $request = self::parseArray($parameters);

        $response = $test = Yii::$app->flexmail->execute("CreateEmailAddress", $request);
        return self::stripHeader($response);
    }

    /**
     * Update a Contact
     *
     * Parmeters example:
     * ------------------
     * $parameters = array (
     *      "mailingListId"         => 116911,               // int mandatory
     *      "emailAddressType"      => array(                // array mandatory
     *          "flexmailId"        => "1245887"             // int mandory (unless referenceId set)
     *          "referenceId"       => "my-ref-001"          // string mandatory (unless flexmailId set)
     *          "emailAddress"      => "foobar@flexmail.eu", // string mandatory
     *          "title"             => "Mister"              // string optional
     *          "name"              => "John",               // string opt
     *          "surname"           => "Doe",                // string opt
     *          "address"           => "",                   // string opt
     *          "zipcode"           => "",                   // string opt
     *          "city"              => "",                   // string opt
     *          "country"           => "",                   // string opt
     *          "phone"             => "",                   // string opt
     *          "fax"               => "",                   // string opt
     *          "mobile"            => "",                   // string opt
     *          "website"           => "",                   // string opt
     *          "language"          => "",                   // string opt
     *          "gender"            => "",                   // string opt
     *          "birthday"          => "1968-08-05",         // string (YYYY-MM-DD) opt
     *          "company"           => "",                   // string opt
     *          "function"          => "",                   // string opt
     *          "market"            => "",                   // string opt
     *          "employees"         => 0,                    // int opt
     *          "nace"              => "",                   // string opt
     *          "turnover"          => "",                   // string opt
     *          "vat"               => "",                   // string opt
     *          "keywords"          => "",                   // string opt
     *          "free_field_1"      => "",                   // string opt
     *          "free_field_2"      => "",                   // string opt
     *          "free_field_3"      => "",                   // string opt
     *          "free_field_4"      => "",                   // string opt
     *          "free_field_5"      => "",                   // string opt
     *          "free_field_6"      => "",                   // string opt
     *          "barcode"           => "",                   // string opt
     *          "custom"            => array()               // array opt
     *     )
     * );
     *
     * @param Array $parameters Associative array with properties of an
     *                          emailAddressType object and a mailingListId
     *
     * @return void
     */
    public function update($parameters)
    {
        $request = self::parseArray($parameters);

        $response = Yii::$app->flexmail->execute("UpdateEmailAddress", $request);
        return self::stripHeader($response);
    }

    /**
     * Delete a Contact
     *
     * Parmeters example:
     * ------------------
     * $parameters =   array (
     *      "mailingListId"         => 116911,      // int mandatory
     *      "emailAddressType"      => array(       // array mandatory
     *          "flexmailId"        => "1245887"    // int mandory (unless referenceId set)
     *          "referenceId"       => "my-ref-001" // string mandatory (unless flexmailId set)
     *     )
     * );
     *
     * @param  Array  $parameters     Associative array with properties of an emailAddressType object
     *                                                                  and mailingListId
     * @return void
     */
    public function delete($parameters)
    {
        $request = self::parseArray($parameters);

        $response = Yii::$app->flexmail->execute("DeleteEmailAddress", $request);
        return self::stripHeader($response);
    }

    /**
     * Get all Contacts
     *
     * Parmeters example:
     * ------------------
     * $parameters = array (
     *      "mailingListIds" => array (             // array (of Int (mailingListIds)) optional
     *          102545,
     *          102246
     *      ),
     *      "groupIds" => array (                   // array (of Int (groupIds)) optional
     *          4566,
     *          4456
     *      )
     *      "emailAddressTypeItems" => array (      // array (of EmailAddressType) optional
     *          array (
     *              "referenceId" => "my-ref-001"
     *          ),
     *          array (
     *              "referenceId" => "my-ref-002"
     *          )
     *      )
     * );
     *
     * @param array $parameters Associative array with optional
     *                          emailAddressTypeItems array, mailingListIds
     *                          array or groupIds array
     *
     * @return emailAddressTypeItems array
     */
    public function getAll($parameters = null)
    {
        if (isset($parameters)) {
            $request                = [];
            $emailAddressTypeItems  = [];
            $mailingListIds         = [];
            $groupIds               = [];
            foreach ($parameters as $key => $value) {
               if ($key == "emailAddressTypeItems") {
                   foreach ($value as $value2) {
                       array_push($emailAddressTypeItems, (object)$value2);
                   }
                   $request[$key] = $emailAddressTypeItems;

               } elseif ($key == "mailingListIds") {
                   foreach ($value as $value2) {
                       array_push($mailingListIds, $value2);
                   }
                   $request[$key] = $mailingListIds;

               } elseif ($key == "groupIds") {
                   foreach ($value as $value2) {
                       array_push($groupIds, $value2);
                   }
                   $request[$key] = $groupIds;
               }
            }
        }

        $response = Yii::$app->flexmail->execute("GetEmailAddresses", $request);
        return self::stripHeader($response);
    }

    /**
     * Import multiple Contacts
     *
     * Parmeters example:
     * ------------------
     * $parameters = array (
     *      "mailingListId"         => 117372,                     //int mandatory
     *      "emailAddressTypeItems" => array (                      //array opt
     *          array (
     *              "referenceId"  => "my-ref-523c17e372dd", // string mandatory
     *              "emailAddress" => "foobar@flexmail.eu",  // string mandatory
     *              "title"        => "Mister"               // string optional
     *              "name"         => "John",                // string opt
     *              "surname"      => "Doe",                 // string opt
     *              "address"      => "",                    // string opt
     *              "zipcode"      => "",                    // string opt
     *              "city"         => "",                    // string opt
     *              "country"      => "",                    // string opt
     *              "phone"        => "",                    // string opt
     *              "fax"          => "",                    // string opt
     *              "mobile"       => "",                    // string opt
     *              "website"      => "",                    // string opt
     *              "language"     => "",                    // string opt
     *              "gender"       => "",                    // string opt
     *              "birthday"     => "1968-08-05",          // string (YYYY-MM-DD) opt
     *              "company"      => "",                    // string opt
     *              "function"     => "",                    // string opt
     *              "market"       => "",                    // string opt
     *              "employees"    => 0,                     // int opt
     *              "nace"         => "",                    // string opt
     *              "turnover"     => "",                    // string opt
     *              "vat"          => "",                    // string opt
     *              "keywords"     => "",                    // string opt
     *              "free_field_1" => "",                    // string opt
     *              "free_field_2" => "",                    // string opt
     *              "free_field_3" => "",                    // string opt
     *              "free_field_4" => "",                    // string opt
     *              "free_field_5" => "",                    // string opt
     *              "free_field_6" => "",                    // string opt
     *              "barcode"      => "",                    // string opt
     *              "custom"       => array()                // array opt
     *          ),
     *          array (
     *              "referenceId"  => "my-ref-523c17e37318", // string mandatory
     *              "emailAddress" => "foobiz@flexmail.eu",  // string mandatory
     *          ),
     *      )
     * );
     *
     * @param  Array  $parameters        Array with Associative arrays with emailAddressTypeItems to import
     *                                                  and mailingListId to import them to
     * @return importEmailAddressRespTypeItems array
     */
    public function import($parameters)
    {
        $request               = [];
        $emailAddressTypeItems = [];

        foreach ($parameters as $key => $value) {
            if ($key == "emailAddressTypeItems") {
                foreach ($value as $emailAddressType) {
                    array_push($emailAddressTypeItems, (object) $emailAddressType);
                }
                $request[$key] = $emailAddressTypeItems;
            } elseif($key == "mailingListId") {
                $request[$key] = $value;
            }
        }

        $response = Yii::$app->flexmail->execute("ImportEmailAddresses", $request);
        return self::stripHeader($response);

    }

    /**
     * Request complete or partial history of a Contact
     *
     * Parmeters example:
     * ------------------
     * $parameters = array (
     *      "emailAddress"                   => "foobar@flexmail.eu",  // string mandatory
     *      "timestampFrom"                  => "2008-09-02T14:42:30", // string (YYYY-MM-DDTHH:ii:ss) optional
     *      "timestampTill"                  => "2014-09-02T14:42:30", // string (YYYY-MM-DDTHH:ii:ss) optional
     *      "emailAddressHistoryOptionsType" => array (                // array optional
     *          "created"                     => true,                 // boolean optional
     *          "deleted"                     => true,                 // boolean optional
     *          "profileUpdateVisited"        => true,                 // boolean optional
     *          "profileUpdateSubmitted"      => true,                 // boolean optional
     *          "subscribed"                  => true,                 // boolean optional
     *          "unsubscribed"                => true,                 // boolean optional
     *          "addedToGroup"                => true,                 // boolean optional
     *          "removedFromGroup"            => true,                 // boolean optional
     *          "addedToAccountBlackList"     => true,                 // boolean optional
     *          "removedFromAccountBlackList" => true,                 // boolean optional
     *          "bounced"                     => true,                 // boolean optional
     *          "bouncedOut"                  => true,                 // boolean optional
     *          "campaignSend"                => true,                 // boolean optional
     *          "campaignRead"                => true,                 // boolean optional
     *          "campaignReadOnline"          => true,                 // boolean optional
     *          "campaignLinkClicked"         => true,                 // boolean optional
     *          "campaignLinkGroupClicked"    => true,                 // boolean optional
     *          "campaignReadInfopage"        => true,                 // boolean optional
     *          "campaignFormVisited"         => true,                 // boolean optional
     *          "campaignFormSubmitted"       => true,                 // boolean optional
     *          "campaignSurveyVisi ted"       => true,                 // boolean optional
     *          "campaignSurveySubmitted"     => true,                 // boolean optional
     *          "campaignForwardVisited"      => true,                 // boolean optional
     *          "campaignForwardSubmitted"    => true,                 // boolean optional
     *      )
     *      "sort"                           =>  1 // int optional (0 = asc, 1 = desc)
     * );
     *
     * @param Array $parameters Associative arrays with emailAddress and optional
     *                          timestampTill- and from, sort and
     *                          emailAddressHistoryOptionsType parameters
     *
     * @return emailAddressHistoryType object
     */
    public function history($parameters)
    {
        $request = self::parseArray($parameters);

        $response = Yii::$app->flexmail->execute("GetEmailAddressHistory", $request);
        return self::stripHeader($response);
    }
}