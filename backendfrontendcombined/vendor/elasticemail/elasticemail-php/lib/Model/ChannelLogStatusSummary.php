<?php
/**
 * ChannelLogStatusSummary
 *
 * PHP version 7.4
 *
 * @category Class
 * @package  ElasticEmail
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Elastic Email REST API
 *
 * This API is based on the REST API architecture, allowing the user to easily manage their data with this resource-based approach.    Every API call is established on which specific request type (GET, POST, PUT, DELETE) will be used.    The API has a limit of 20 concurrent connections and a hard timeout of 600 seconds per request.    To start using this API, you will need your Access Token (available <a target=\"_blank\" href=\"https://app.elasticemail.com/marketing/settings/new/manage-api\">here</a>). Remember to keep it safe. Required access levels are listed in the given request’s description.    Downloadable library clients can be found in our Github repository <a target=\"_blank\" href=\"https://github.com/ElasticEmail?tab=repositories&q=%22rest+api%22+in%3Areadme\">here</a>
 *
 * The version of the OpenAPI document: 4.0.0
 * Contact: support@elasticemail.com
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 6.2.1
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace ElasticEmail\Model;

use \ArrayAccess;
use \ElasticEmail\ObjectSerializer;

/**
 * ChannelLogStatusSummary Class Doc Comment
 *
 * @category Class
 * @description Summary of channel log status
 * @package  ElasticEmail
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class ChannelLogStatusSummary implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'ChannelLogStatusSummary';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'channel_name' => 'string',
        'recipients' => 'int',
        'email_total' => 'int',
        'sms_total' => 'int',
        'delivered' => 'int',
        'bounced' => 'int',
        'in_progress' => 'int',
        'opened' => 'int',
        'clicked' => 'int',
        'unsubscribed' => 'int',
        'complaints' => 'int',
        'inbound' => 'int',
        'manual_cancel' => 'int',
        'not_delivered' => 'int'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'channel_name' => 'string',
        'recipients' => 'int64',
        'email_total' => 'int64',
        'sms_total' => 'int64',
        'delivered' => 'int64',
        'bounced' => 'int64',
        'in_progress' => 'int64',
        'opened' => 'int64',
        'clicked' => 'int64',
        'unsubscribed' => 'int64',
        'complaints' => 'int64',
        'inbound' => 'int64',
        'manual_cancel' => 'int64',
        'not_delivered' => 'int64'
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'channel_name' => false,
		'recipients' => false,
		'email_total' => false,
		'sms_total' => false,
		'delivered' => false,
		'bounced' => false,
		'in_progress' => false,
		'opened' => false,
		'clicked' => false,
		'unsubscribed' => false,
		'complaints' => false,
		'inbound' => false,
		'manual_cancel' => false,
		'not_delivered' => false
    ];

    /**
      * If a nullable field gets set to null, insert it here
      *
      * @var boolean[]
      */
    protected array $openAPINullablesSetToNull = [];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of nullable properties
     *
     * @return array
     */
    protected static function openAPINullables(): array
    {
        return self::$openAPINullables;
    }

    /**
     * Array of nullable field names deliberately set to null
     *
     * @return boolean[]
     */
    private function getOpenAPINullablesSetToNull(): array
    {
        return $this->openAPINullablesSetToNull;
    }

    /**
     * Setter - Array of nullable field names deliberately set to null
     *
     * @param boolean[] $openAPINullablesSetToNull
     */
    private function setOpenAPINullablesSetToNull(array $openAPINullablesSetToNull): void
    {
        $this->openAPINullablesSetToNull = $openAPINullablesSetToNull;
    }

    /**
     * Checks if a property is nullable
     *
     * @param string $property
     * @return bool
     */
    public static function isNullable(string $property): bool
    {
        return self::openAPINullables()[$property] ?? false;
    }

    /**
     * Checks if a nullable property is set to null.
     *
     * @param string $property
     * @return bool
     */
    public function isNullableSetToNull(string $property): bool
    {
        return in_array($property, $this->getOpenAPINullablesSetToNull(), true);
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'channel_name' => 'ChannelName',
        'recipients' => 'Recipients',
        'email_total' => 'EmailTotal',
        'sms_total' => 'SmsTotal',
        'delivered' => 'Delivered',
        'bounced' => 'Bounced',
        'in_progress' => 'InProgress',
        'opened' => 'Opened',
        'clicked' => 'Clicked',
        'unsubscribed' => 'Unsubscribed',
        'complaints' => 'Complaints',
        'inbound' => 'Inbound',
        'manual_cancel' => 'ManualCancel',
        'not_delivered' => 'NotDelivered'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'channel_name' => 'setChannelName',
        'recipients' => 'setRecipients',
        'email_total' => 'setEmailTotal',
        'sms_total' => 'setSmsTotal',
        'delivered' => 'setDelivered',
        'bounced' => 'setBounced',
        'in_progress' => 'setInProgress',
        'opened' => 'setOpened',
        'clicked' => 'setClicked',
        'unsubscribed' => 'setUnsubscribed',
        'complaints' => 'setComplaints',
        'inbound' => 'setInbound',
        'manual_cancel' => 'setManualCancel',
        'not_delivered' => 'setNotDelivered'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'channel_name' => 'getChannelName',
        'recipients' => 'getRecipients',
        'email_total' => 'getEmailTotal',
        'sms_total' => 'getSmsTotal',
        'delivered' => 'getDelivered',
        'bounced' => 'getBounced',
        'in_progress' => 'getInProgress',
        'opened' => 'getOpened',
        'clicked' => 'getClicked',
        'unsubscribed' => 'getUnsubscribed',
        'complaints' => 'getComplaints',
        'inbound' => 'getInbound',
        'manual_cancel' => 'getManualCancel',
        'not_delivered' => 'getNotDelivered'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }


    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->setIfExists('channel_name', $data ?? [], null);
        $this->setIfExists('recipients', $data ?? [], null);
        $this->setIfExists('email_total', $data ?? [], null);
        $this->setIfExists('sms_total', $data ?? [], null);
        $this->setIfExists('delivered', $data ?? [], null);
        $this->setIfExists('bounced', $data ?? [], null);
        $this->setIfExists('in_progress', $data ?? [], null);
        $this->setIfExists('opened', $data ?? [], null);
        $this->setIfExists('clicked', $data ?? [], null);
        $this->setIfExists('unsubscribed', $data ?? [], null);
        $this->setIfExists('complaints', $data ?? [], null);
        $this->setIfExists('inbound', $data ?? [], null);
        $this->setIfExists('manual_cancel', $data ?? [], null);
        $this->setIfExists('not_delivered', $data ?? [], null);
    }

    /**
    * Sets $this->container[$variableName] to the given data or to the given default Value; if $variableName
    * is nullable and its value is set to null in the $fields array, then mark it as "set to null" in the
    * $this->openAPINullablesSetToNull array
    *
    * @param string $variableName
    * @param array  $fields
    * @param mixed  $defaultValue
    */
    private function setIfExists(string $variableName, array $fields, $defaultValue): void
    {
        if (self::isNullable($variableName) && array_key_exists($variableName, $fields) && is_null($fields[$variableName])) {
            $this->openAPINullablesSetToNull[] = $variableName;
        }

        $this->container[$variableName] = $fields[$variableName] ?? $defaultValue;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets channel_name
     *
     * @return string|null
     */
    public function getChannelName()
    {
        return $this->container['channel_name'];
    }

    /**
     * Sets channel_name
     *
     * @param string|null $channel_name Channel name
     *
     * @return self
     */
    public function setChannelName($channel_name)
    {

        if (is_null($channel_name)) {
            throw new \InvalidArgumentException('non-nullable channel_name cannot be null');
        }

        $this->container['channel_name'] = $channel_name;

        return $this;
    }

    /**
     * Gets recipients
     *
     * @return int|null
     */
    public function getRecipients()
    {
        return $this->container['recipients'];
    }

    /**
     * Sets recipients
     *
     * @param int|null $recipients Number of recipients
     *
     * @return self
     */
    public function setRecipients($recipients)
    {

        if (is_null($recipients)) {
            throw new \InvalidArgumentException('non-nullable recipients cannot be null');
        }

        $this->container['recipients'] = $recipients;

        return $this;
    }

    /**
     * Gets email_total
     *
     * @return int|null
     */
    public function getEmailTotal()
    {
        return $this->container['email_total'];
    }

    /**
     * Sets email_total
     *
     * @param int|null $email_total Number of emails
     *
     * @return self
     */
    public function setEmailTotal($email_total)
    {

        if (is_null($email_total)) {
            throw new \InvalidArgumentException('non-nullable email_total cannot be null');
        }

        $this->container['email_total'] = $email_total;

        return $this;
    }

    /**
     * Gets sms_total
     *
     * @return int|null
     */
    public function getSmsTotal()
    {
        return $this->container['sms_total'];
    }

    /**
     * Sets sms_total
     *
     * @param int|null $sms_total Number of SMS
     *
     * @return self
     */
    public function setSmsTotal($sms_total)
    {

        if (is_null($sms_total)) {
            throw new \InvalidArgumentException('non-nullable sms_total cannot be null');
        }

        $this->container['sms_total'] = $sms_total;

        return $this;
    }

    /**
     * Gets delivered
     *
     * @return int|null
     */
    public function getDelivered()
    {
        return $this->container['delivered'];
    }

    /**
     * Sets delivered
     *
     * @param int|null $delivered Number of delivered messages
     *
     * @return self
     */
    public function setDelivered($delivered)
    {

        if (is_null($delivered)) {
            throw new \InvalidArgumentException('non-nullable delivered cannot be null');
        }

        $this->container['delivered'] = $delivered;

        return $this;
    }

    /**
     * Gets bounced
     *
     * @return int|null
     */
    public function getBounced()
    {
        return $this->container['bounced'];
    }

    /**
     * Sets bounced
     *
     * @param int|null $bounced Number of bounced messages
     *
     * @return self
     */
    public function setBounced($bounced)
    {

        if (is_null($bounced)) {
            throw new \InvalidArgumentException('non-nullable bounced cannot be null');
        }

        $this->container['bounced'] = $bounced;

        return $this;
    }

    /**
     * Gets in_progress
     *
     * @return int|null
     */
    public function getInProgress()
    {
        return $this->container['in_progress'];
    }

    /**
     * Sets in_progress
     *
     * @param int|null $in_progress Number of messages in progress
     *
     * @return self
     */
    public function setInProgress($in_progress)
    {

        if (is_null($in_progress)) {
            throw new \InvalidArgumentException('non-nullable in_progress cannot be null');
        }

        $this->container['in_progress'] = $in_progress;

        return $this;
    }

    /**
     * Gets opened
     *
     * @return int|null
     */
    public function getOpened()
    {
        return $this->container['opened'];
    }

    /**
     * Sets opened
     *
     * @param int|null $opened Number of opened messages
     *
     * @return self
     */
    public function setOpened($opened)
    {

        if (is_null($opened)) {
            throw new \InvalidArgumentException('non-nullable opened cannot be null');
        }

        $this->container['opened'] = $opened;

        return $this;
    }

    /**
     * Gets clicked
     *
     * @return int|null
     */
    public function getClicked()
    {
        return $this->container['clicked'];
    }

    /**
     * Sets clicked
     *
     * @param int|null $clicked Number of clicked messages
     *
     * @return self
     */
    public function setClicked($clicked)
    {

        if (is_null($clicked)) {
            throw new \InvalidArgumentException('non-nullable clicked cannot be null');
        }

        $this->container['clicked'] = $clicked;

        return $this;
    }

    /**
     * Gets unsubscribed
     *
     * @return int|null
     */
    public function getUnsubscribed()
    {
        return $this->container['unsubscribed'];
    }

    /**
     * Sets unsubscribed
     *
     * @param int|null $unsubscribed Number of unsubscribed messages
     *
     * @return self
     */
    public function setUnsubscribed($unsubscribed)
    {

        if (is_null($unsubscribed)) {
            throw new \InvalidArgumentException('non-nullable unsubscribed cannot be null');
        }

        $this->container['unsubscribed'] = $unsubscribed;

        return $this;
    }

    /**
     * Gets complaints
     *
     * @return int|null
     */
    public function getComplaints()
    {
        return $this->container['complaints'];
    }

    /**
     * Sets complaints
     *
     * @param int|null $complaints Number of complaint messages
     *
     * @return self
     */
    public function setComplaints($complaints)
    {

        if (is_null($complaints)) {
            throw new \InvalidArgumentException('non-nullable complaints cannot be null');
        }

        $this->container['complaints'] = $complaints;

        return $this;
    }

    /**
     * Gets inbound
     *
     * @return int|null
     */
    public function getInbound()
    {
        return $this->container['inbound'];
    }

    /**
     * Sets inbound
     *
     * @param int|null $inbound Number of inbound messages
     *
     * @return self
     */
    public function setInbound($inbound)
    {

        if (is_null($inbound)) {
            throw new \InvalidArgumentException('non-nullable inbound cannot be null');
        }

        $this->container['inbound'] = $inbound;

        return $this;
    }

    /**
     * Gets manual_cancel
     *
     * @return int|null
     */
    public function getManualCancel()
    {
        return $this->container['manual_cancel'];
    }

    /**
     * Sets manual_cancel
     *
     * @param int|null $manual_cancel Number of manually cancelled messages
     *
     * @return self
     */
    public function setManualCancel($manual_cancel)
    {

        if (is_null($manual_cancel)) {
            throw new \InvalidArgumentException('non-nullable manual_cancel cannot be null');
        }

        $this->container['manual_cancel'] = $manual_cancel;

        return $this;
    }

    /**
     * Gets not_delivered
     *
     * @return int|null
     */
    public function getNotDelivered()
    {
        return $this->container['not_delivered'];
    }

    /**
     * Sets not_delivered
     *
     * @param int|null $not_delivered Number of messages flagged with 'Not Delivered'
     *
     * @return self
     */
    public function setNotDelivered($not_delivered)
    {

        if (is_null($not_delivered)) {
            throw new \InvalidArgumentException('non-nullable not_delivered cannot be null');
        }

        $this->container['not_delivered'] = $not_delivered;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed|null
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


