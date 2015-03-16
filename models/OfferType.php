<?php
/**
 * OfferType модель для типов предложений
 *
 * @author apexwire <apexwire@amylabs.ru>
 * @link http://yupe.ru
 * @copyright 2009-2015 amyLabs && Yupe! team
 * @package yupe.modules.news.models
 * @since 0.1
 *
 */

/**
 * This is the model class for table "{{offer_type}}".
 *
 * The followings are the available columns in table '{{offer_type}}':
 * @property integer $id
 * @property string $slug
 * @property string $title
 * @property string $description
 * @property integer $status
 * @property integer $param_add
 * @property integer $param_view
 * @property integer $param_message
 */
class OfferType extends yupe\models\YModel
{
    const STATUS_BLOCKED = 0;
    const STATUS_ACTIVE = 1;

    const PARAM_ADD_NOBODY = 0;
    const PARAM_ADD_ALL = 1;
    const PARAM_ADD_USER = 2;

    const PARAM_VIEW_ALL = 0;
    const PARAM_VIEW_USER = 1;

    const PARAM_MESSAGE_ALL = 0;
    const PARAM_MESSAGE_USER = 1;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{offer_type}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return [
			['title, slug, description, status', 'required'],
			['status, param_add, param_view, param_message', 'numerical', 'integerOnly'=>true],
			['title, slug', 'length', 'max'=>150],
			['description', 'length', 'max'=>250],
			['id, title, slug, description, status', 'safe', 'on'=>'search'],
        ];
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return [
        ];
	}

    public function scopes()
    {
        return [
            'active'    => [
                'condition' => 'status = :status',
                'params'    => [':status' => self::STATUS_ACTIVE],
            ]
        ];
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('OfferModule.offer', 'ID'),
            'title' => Yii::t('OfferModule.offer', 'Title'),
            'slug' => Yii::t('OfferModule.offer', 'Url'),
			'description' => Yii::t('OfferModule.offer', 'Description'),
			'status' => Yii::t('OfferModule.offer', 'Status'),
            'params' => Yii::t('OfferModule.offer', 'Params'),
            'param_add' => Yii::t('OfferModule.offer', 'Who can add offers?'),
            'param_view' => Yii::t('OfferModule.offer', 'Who can view offers?'),
            'param_message' => Yii::t('OfferModule.offer', 'Who can view and add messages to offers?'),
        ];
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, [
			'criteria'=>$criteria,
        ]);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OfferType the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * @return array
     */
    public function getStatusList()
    {
        return [
            self::STATUS_BLOCKED => Yii::t('OfferModule.offer', 'Blocked'),
            self::STATUS_ACTIVE  => Yii::t('OfferModule.offer', 'Active'),
        ];
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        $data = $this->getStatusList();

        return isset($data[$this->status]) ? $data[$this->status] : Yii::t('OfferModule.offer', '*unknown*');
    }

    /**
     * @return array
     */
    public function getParamAddList()
    {
        return [
            self::PARAM_ADD_NOBODY => Yii::t('OfferModule.offer', 'Nobody'),
            self::PARAM_ADD_ALL  => Yii::t('OfferModule.offer', 'All'),
            self::PARAM_ADD_USER  => Yii::t('OfferModule.offer', 'Only user'),
        ];
    }

    /**
     * @return string
     */
    public function getParamAdd()
    {
        $data = $this->getParamAddList();

        return isset($data[$this->param_add]) ? $data[$this->param_add] : Yii::t('OfferModule.offer', '*unknown*');
    }

    /**
     * @return array
     */
    public function getParamViewList()
    {
        return [
            self::PARAM_VIEW_ALL => Yii::t('OfferModule.offer', 'All'),
            self::PARAM_VIEW_USER  => Yii::t('OfferModule.offer', 'Only user'),
        ];
    }

    /**
     * @return string
     */
    public function getParamView()
    {
        $data = $this->getParamViewList();

        return isset($data[$this->param_view]) ? $data[$this->param_view] : Yii::t('OfferModule.offer', '*unknown*');
    }

    /**
     * @return array
     */
    public function getParamMessageList()
    {
        return [
            self::PARAM_MESSAGE_ALL => Yii::t('OfferModule.offer', 'All'),
            self::PARAM_MESSAGE_USER  => Yii::t('OfferModule.offer', 'Only user'),
        ];
    }

    /**
     * @return string
     */
    public function getParamMessage()
    {
        $data = $this->getParamMessageList();

        return isset($data[$this->param_message]) ? $data[$this->param_message] : Yii::t('OfferModule.offer', '*unknown*');
    }

    /**
     * Проверяем может ли пользователь добавдять данный тип предложения
     *
     * @return bool
     */
    public function checkParamAdd($user_id)
    {
        if ($this->param_add == OfferType::PARAM_ADD_NOBODY ) {
            return false;
        }

        if ($this->param_add == OfferType::PARAM_ADD_USER && is_null($user_id) ) {
            return false;
        }

        return true;
    }

    /**
     * Проверяем может ли пользователь просматривать данный тип предложения
     *
     * @return bool
     */
    public function checkParamView()
    {
        if ($this->param_view == OfferType::PARAM_VIEW_ALL ) {
            return true;
        }

        if ($this->param_view == OfferType::PARAM_VIEW_USER && !Yii::app()->user->isGuest ) {
            return true;
        }

        return false;
    }

    /**
     * Проверяем может ли пользователь оставлять комментарии к данныму типу предложения
     *
     * @return bool
     */
    public function checkParamMessage()
    {
        if ($this->param_message == OfferType::PARAM_MESSAGE_ALL ) {
            return true;
        }

        if ($this->param_message == OfferType::PARAM_MESSAGE_USER && !Yii::app()->user->isGuest ) {
            return true;
        }

        return false;
    }
}
