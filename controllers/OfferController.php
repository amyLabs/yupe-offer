<?php
/**
 * OfferController контроллер для управления предложениями
 *
 * @author apexwire <apexwire@amylabs.ru>
 * @link      http://yupe.ru
 * @copyright 2009-2015 amyLabs && Yupe! team
 * @package   yupe.modules.offer.controllers
 * @license   BSD https://raw.github.com/yupe/yupe/master/LICENSE
 * @version   0.1
 *
 */

class OfferController extends \yupe\components\controllers\FrontController
{

    /**
     * экшн для отображения списка типов предложений
     */
    public function actionIndex()
    {
        $this->render('index', ['model' => OfferType::model()->active()]);
    }

    public function actionShow($slugType = null)
    {
        $offerType = OfferType::model()->active()->findByAttributes(['slug'=>$slugType]);

        if ($offerType === null) {
            throw new CHttpException(404, Yii::t('OfferModule.offer','Offer type "{offerType}" was not found!',['{offerType}' => $slugType]));
        }

        $offer = new Offer();

        if (Yii::app()->getRequest()->getIsPostRequest() && ($data = Yii::app()->getRequest()->getPost('Offer')) !== null) {

            $data['type_id'] = $offerType->id;
            $data['user_id'] = Yii::app()->getUser()->getId();

            if ($offer->createPublicOffer($data)) {

                Yii::app()->getUser()->setFlash(
                    \yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('OfferModule.offer', 'Offer sent for moderation!')
                );

                $this->redirect(['/offer/offer/show', 'slugType' => CHtml::encode($offerType->slug)]);
            }
        }

        $this->render('show', [
            'offerType' => $offerType,
            'offer' => $offer
        ]);
    }

    public function actionShowOffer($slugType = null, $slug = null)
    {
        $offerType = OfferType::model()->active()->findByAttributes(['slug'=>$slugType]);

        if ($offerType === null) {
            throw new CHttpException(404, Yii::t('OfferModule.offer','Offer type "{offerType}" was not found!',['{offerType}' => $slugType]));
        }

        if ($offerType->param_view == OfferType::PARAM_VIEW_USER && Yii::app()->user->isGuest) {
            throw new CHttpException(403,  Yii::t('OfferModule.offer','You do not have access to offer type "{offerType}"!',['{offerType}' => $slugType]));
        }

        $offer = Offer::model()->active()->findByAttributes(['type_id'=> $offerType->id, 'slug'=> $slug]);

        if ($offer === null) {
            throw new CHttpException(404, Yii::t('OfferModule.offer','Offer "{offer}" was not found!',['{offer}' => $slug]));
        }

        $this->render('showOffer', ['offer' => $offer]);
    }
}
