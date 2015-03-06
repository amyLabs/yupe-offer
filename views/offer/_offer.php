<div class="row">
    <div class="col-sm-12">
        <h2><?php echo CHtml::link(
                CHtml::encode($data->title),
                ['/offer/offer/showOffer/', 'slugType' => CHtml::encode($data->type->slug), 'slug' => CHtml::encode($data->slug)]
            ); ?>
        </h2>
    </div>
    <div class="col-sm-12">
        <p> <?php echo $data->text; ?> </p>
    </div>
</div>
<hr/>