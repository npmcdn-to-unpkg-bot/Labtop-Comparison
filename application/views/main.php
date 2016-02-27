<link href="/static/css/mycss.css" rel="stylesheet" media="screen">
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/jquery.mosaicflow.min.js"></script>

<ul>
    <div class="clearfix mosaicflow">
        <?php
        foreach($data as $item)
        {
        ?>
            <div class="mosaicflow__item">
                <img width="180" height="180" src="<?=$item->img_link?>" alt="">
            </div>
        <?php
        }
        ?>
    </div>
</ul>