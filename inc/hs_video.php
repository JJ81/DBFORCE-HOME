<div class="hs-video-wrapper">
    <div class="hs-video-inner">
        <?php if(PAGE === 'MAIN'){?>
        <h2 class="center">
            <img src="./assets/img/stock/title-video.jpg" alt="" width="100%" />
        </h2>
        <?php } ?>
        <div class="hs-video-body">
            <div class="hs-video-body-inner clearfix">
                <div class="hs-video-viewer">
                    <div id="hs-video-screen"></div>
                    <input type="hidden"
                           class="ha-first-video"
                           value="<?php echo $representative_video[0]['video_url'];?>">
                    <input type="hidden"
                           class="ha-first-video-title"
                           value="<?php echo $representative_video[0]['video_title'];?>">
                    <div class="hs-video-title">
                        <?php echo $representative_video[0]['video_title'];?>
                    </div>
                    <div class="hs-video-ban-wrp">
                        <img src="<?php echo ROOT;?>assets/img/stock/img-ban-video.png" alt="" width="100%" />
                    </div>
                </div>
                <div class="hs-video-list-body">
                    <div class="hs-video-list-holder">
                        <ul class="hs-video-list-ul">
                            <?php for($i=0,$size=count($videos);$i<$size;$i++){ ?>
                            <li class="hs-video-ls">
                                <a href="#" class="hs-video-link __hs-video-link-active"
                                   data-id="<?php echo $videos[$i]['id'] ;?>"
                                   data-title="<?php echo $videos[$i]['video_title'] ;?>"
                                   data-url-id="<?php echo $videos[$i]['video_url'] ;?>">
                                    <img src="http://img.youtube.com/vi/<?php echo $videos[$i]['video_url'];?>/hqdefault.jpg"
                                         alt="<?php echo $videos[$i]['video_title'] ;?>" class="hs-video-img" />
                                    <span class="hs-v-title">
                                        <?php echo $videos[$i]['video_title'] ;?>
                                    </span>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>