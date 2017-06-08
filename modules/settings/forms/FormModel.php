<?php

namespace app\modules\settings\forms;

use Yii;
use yii\base\Exception;
use yii\base\InvalidParamException;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\helpers\Inflector;
use yii\helpers\Json;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 * @var array $keys Array of the keyStorage keys to be handled by this model ($key => $config)
 * Example:
 * [
 *   'keys' => [
 *       'frontend.maintenance' => [
 *           'label' => 'Maintenance mode',
 *           'type' => FormModel::TYPE_CHECKBOX,
 *           'rules' => [ [... validation rules ...], [ ... ] ]
 *           // 'items' => ['a' => 'b']  - For lists like TYPE_DROPBOX,
 *           // 'options' => [ ... ... ] - Options that will be passed to ActiveInput or widget
 *           // 'labelOptions' => [ ... ... ] - Options that will be passed to label
 *           // 'widget' => 'yii\jui\Datepicker' - Widget class name if TYPE_WIDGET
 *       ]
 *    ]
 * ]
 */
class FormModel extends Model
{
    const TYPE_DROPDOWN = 'dropdownList';
    const TYPE_TEXTINPUT = 'textInput';
    const TYPE_TEXTAREA = 'textarea';
    const TYPE_CHECKBOX = 'checkbox';
    const TYPE_RADIOLIST = 'radioList';
    const TYPE_CHECKBOXLIST = 'checkboxList';
    const TYPE_WIDGET = 'widget';

    const FORMAT_PLAIN = 1;
    const FORMAT_JSON = 2;
    const FORMAT_SERIALIZED = 3;

    /**
     * @var array
     */
    protected $keys = [];
    /**
     * @var array
     */
    protected $map = [];

    /**
     * @var string
     */
    public $keyStorage = 'keyStorage';

    /**
     * @var array
     */
    public $scenarios = [];

    /**
     * @var int
     */
    public $format = self::FORMAT_PLAIN;

    /**
     * @var array
     */
    protected $attributes;

    /**
     * @param $keys
     */
    public function setKeys($keys)
    {
        $variablized = $values = [];
        foreach ($keys as $key => $data) {
            $variablizedKey = Inflector::variablize($key);
            $this->map[$variablizedKey] = $key;
            $value = $this->getKeyStorage()->get($key, null, false);
            if (static::FORMAT_JSON == ArrayHelper::getValue($data, 'format')) {
                $formattedValue = Json::decode($value);
            } elseif (static::FORMAT_SERIALIZED == ArrayHelper::getValue($data, 'format')) {
                $formattedValue = unserialize($value);
            } else {
                $formattedValue = $value;
            }
            $values[$variablizedKey] = $formattedValue;
            $variablized[$variablizedKey] = $data;
        }
        $this->keys = $variablized;
        foreach ($values as $k => $v) {
            $this->setAttribute($k, $v);
        }
        parent::init();
    }

    /**
     * @return array
     */
    public function getKeys()
    {
        return $this->keys;
    }

    /**
     * Returns the list of attribute names.
     * By default, this method returns all public non-static properties of the class.
     * You may override this method to change the default behavior.
     * @return array list of attribute names.
     */
    public function attributes()
    {
        $names = [];
        foreach ($this->keys as $attribute => $values) {
            $names[] = $attribute;
        }

        return $names;
    }

    /**
     * @return array
     */
    public function rules()
    {
        $rules = [];
        foreach ($this->keys as $attribute => $data) {
            $attributeRules = ArrayHelper::getValue($data, 'rules', []);
            if (!empty($attributeRules)) {
                foreach ($attributeRules as $rule) {
                    array_unshift($rule, $attribute);
                    $rules[] = $rule;
                }
            } else {
                $rules[] = [$attribute, 'safe'];
            }

        }
        return $rules;
    }

    /**
     * @return array
     */
    public function scenarios()
    {
        return ArrayHelper::merge(
            $this->scenarios,
            parent::scenarios()
        );
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        $labels = [];
        foreach ($this->keys as $attribute => $data) {
            $label = is_array($data) ? ArrayHelper::getValue($data, 'label') : $data;
            $labels[$attribute] = $label;
        }
        return $labels;
    }

    /**
     * @param bool $runValidation
     * @return bool
     * @throws Exception
     */
    public function save($runValidation = true)
    {
        if ($runValidation && !$this->validate()) {
            return false;
        }
        foreach ($this->attributes as $variablizedKey => $value) {
            $originalKey = ArrayHelper::getValue($this->map, $variablizedKey);
            if (!$originalKey) {
                throw new Exception;
            }
            $format = ArrayHelper::getValue($this->keys[$variablizedKey], 'format', static::FORMAT_PLAIN);
            if (static::FORMAT_JSON == $format) {
                $formattedValue = Json::encode($value);
            } elseif (static::FORMAT_SERIALIZED == $format) {
                $formattedValue = serialize($value);
            } else {
                $formattedValue = $value;
            }
            $this->getKeyStorage()->set($originalKey, $formattedValue);
        }
        return true;
    }

    /**
     * @return null|object
     * @throws \yii\base\InvalidConfigException
     */
    protected function getKeyStorage()
    {
        return Yii::$app->get($this->keyStorage);
    }

    /**
     * PHP getter magic method.
     * This method is overridden so that attributes and related objects can be accessed like properties.
     *
     * @param string $name property name
     * @throws \yii\base\InvalidParamException if relation name is wrong
     * @return mixed property value
     * @see getAttribute()
     */
    public function __get($name)
    {
        if (isset($this->attributes[$name]) || array_key_exists($name, $this->attributes)) {
            return $this->attributes[$name];
        } elseif ($this->hasAttribute($name)) {
            return null;
        } else {
            $value = parent::__get($name);
            return $value;
        }
    }

    /**
     * PHP setter magic method.
     * This method is overridden so that AR attributes can be accessed like properties.
     * @param string $name property name
     * @param mixed $value property value
     */
    public function __set($name, $value)
    {
        if ($this->hasAttribute($name)) {
            $this->attributes[$name] = $value;
        } else {
            parent::__set($name, $value);
        }
    }

    /**
     * Checks if a property value is null.
     * This method overrides the parent implementation by checking if the named attribute is null or not.
     * @param string $name the property name or the event name
     * @return boolean whether the property value is null
     */
    public function __isset($name)
    {
        try {
            return $this->__get($name) !== null;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Sets a component property to be null.
     * This method overrides the parent implementation by clearing
     * the specified attribute value.
     * @param string $name the property name or the event name
     */
    public function __unset($name)
    {
        if ($this->hasAttribute($name)) {
            unset($this->attributes[$name]);
        }
    }

    /**
     * Returns a value indicating whether the model has an attribute with the specified name.
     * @param string $name the name of the attribute
     * @return boolean whether the model has an attribute with the specified name.
     */
    public function hasAttribute($name)
    {
        return isset($this->attributes[$name]) || in_array($name, $this->attributes(), false);
    }

    /**
     * Returns the named attribute value.
     * If this record is the result of a query and the attribute is not loaded,
     * null will be returned.
     * @param string $name the attribute name
     * @return mixed the attribute value. Null if the attribute is not set or does not exist.
     * @see hasAttribute()
     */
    public function getAttribute($name)
    {
        return isset($this->attributes[$name]) ? $this->attributes[$name] : null;
    }

    /**
     * Sets the named attribute value.
     * @param string $name the attribute name
     * @param mixed $value the attribute value.
     * @throws InvalidParamException if the named attribute does not exist.
     * @see hasAttribute()
     */
    public function setAttribute($name, $value)
    {
        if ($this->hasAttribute($name)) {
            $this->attributes[$name] = $value;
        } else {
            throw new InvalidParamException(get_class($this) . ' has no attribute named "' . $name . '".');
        }
    }
}
