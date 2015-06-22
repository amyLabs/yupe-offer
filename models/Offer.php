<?php
/**
 * Offer основная модель для предложений
 *
 * @author apexwire <apexwire@amylabs.ru>
 * @link http://yupe.ru
 * @copyright 2009-2015 amyLabs && Yupe! team
 * @package yupe.modules.news.models
 * @since 0.1
 *
 */

/**
 * This is the model class for table "{{offer}}".
 *
 * The followings are the available columns in table '{{offer}}':
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property integer $type_id
 * @property integer $user_id
 * @property string $text
 * @property integer $status
 */
class Offer extends yupe\models\YModel
{
    const STATUS_BLOCKED = 0;
    const STATUS_ACTIVE = 1;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{offer}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return [
			['title, slug, type_id, text, status', 'required'],
			['type_id, user_id, status', 'numerical', 'integerOnly'=>true],
			['title, slug', 'length', 'max'=>150],
            ['slug','unique'],
			['text', 'length', 'max'=>250],
			['id, title, slug, type_id, user_id, text, status', 'safe', 'on'=>'search'],
		];
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return [
            'type' => [self::BELONGS_TO, 'OfferType', 'type_id'],
            'user' => [self::BELONGS_TO, 'User', 'user_id'],
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
            'slug' => Yii::t('OfferModule.offer', 'Slug'),
			'type_id' => Yii::t('OfferModule.offer', 'Offer type'),
			'user_id' => Yii::t('OfferModule.offer', 'User'),
			'text' => Yii::t('OfferModule.offer', 'Text'),
			'status' => Yii::t('OfferModule.offer', 'Status'),
		];
	}

    public function scopes()
    {
        return [
            'active'    => [
                'condition' => 'status = :status',
                'params'    => [':status' => self::STATUS_ACTIVE],
            ],
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
		$criteria->compare('title',$this->title,true);
        $criteria->compare('slug',$this->slug,true);
		$criteria->compare('type_id',$this->type_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, [
			'criteria'=>$criteria,
		]);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Offer the static model class
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
     * Возвращает список предложений по typeID
     *
     * @param $typeID
     * @return Offer
     */
    static public function getByType($typeID)
    {
        $offers = new Offer('search');
        $offers->unsetAttributes();
        $offers->setAttributes([
            'type_id' => $typeID,
            'status' => self::STATUS_ACTIVE
        ]);

        return $offers;
    }

    public function getLinkByUser()
    {
        return ($this->user === null)
            ? '---'
            : CHtml::link($this->user->getFullName(), ["/user/userBackend/view", "id" => $this->user->id]);
    }

    /**
     * @param array $post
     * @return bool
     */
    public function createPublicOffer(array $post)
    {
        if (empty($post['type_id'])/* || is_null($post['user_id'])*/) {
            $this->addError('type_id', Yii::t('OfferModule.offer', "Offer is empty!"));

            return false;
        }

        $offerType = OfferType::model()->active()->findByPk((int)$post['type_id']);

        if (null === $offerType || !$offerType->checkParamAdd($post['user_id']) ) {
            $this->addError('type_id', Yii::t('OfferModule.offer', "You can't write in this offerType!"));
            return false;
        }

        $this->setAttributes($post);
        $this->slug = uniqid();
        $this->type_id = $post['type_id'];
        $this->user_id = $post['user_id'];
        $this->status = self::STATUS_BLOCKED;

        return $this->save();
    }
}
