<div class="row">
    <div class="col-sm-12">
        <h2><?php echo CHtml::link(
                CHtml::encode($data->title),
                ['/offer/offer/show/', 'slugType' => CHtml::encode($data->slug)]
            ); ?>
        </h2>
    </div>
    <div class="col-sm-12">
        <p> <?php echo $data->description; ?> </p>
    </div>
</div>
<hr/>