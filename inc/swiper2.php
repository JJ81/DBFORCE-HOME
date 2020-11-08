<div class="swiper-container">
    <div class="swiper-wrapper">
        <?php for($i=0,$size=count($review_list);$i<$size;$i++){ ?>
            <div class="swiper-slide">
                <img src="<?php echo ROOT;?>assets/review/<?php echo $review_list[$i]['thumbnail'] ;?>"
                     alt="<?php echo $review_list[$i]['title'] ;?>" />
            </div>
        <?php } ?>
    </div>
</div>

<div class="swiper-button-next"></div>
<div class="swiper-button-prev"></div>
<?php // if(PAGE === 'TRAIN'){ ?>
<div class="swiper-pagination"></div>
<?php // } ?>