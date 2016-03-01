<link href="/static/css/mycss.css" rel="stylesheet" media="screen">
<script src="/static/js/isotope.pkgd.min.js"></script>
<script type="text/javascript" src="http://www.technicalkeeda.com/js/javascripts/plugin/json2.js"></script>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 left">
            <div id="filters" class="button-group">
                <button class="button is-checked" data-filter="*">show all</button>
                <button class="button" data-filter=".Intel계열">Intel</button>
                <button class="button" data-filter=".nVidia계열">nVidia</button>
                <button class="button" data-filter=".ATI계열">ATI</button>
            </div>
        </div>
        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 content">
            <div class="isotope">
                <?php foreach($data as $item){ ?>
                <div class="thumbs_with_description <?=$item->graphic_spec?>" data-category="<?=$item->graphic_spec?>">
                    <div class="image">
                        <img src="<?=$item->img_url?>" class="thumbsnail">
                    </div>
                    <div class="description">
                        <?=$item->model?>
                    </div>
                    <span class="text-content"><span><?=$item->lcd_size?><br><?=$item->graphic_chip?></span></span>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<script>
    var page = 31;
    var $container = $('.isotope');
    $('#filters').on('click', 'button', function() {
        var filterValue = $(this).attr('data-filter');
        // use filterFn if matches value
        filterValue = filterValue;
        $container.isotope({
            filter: filterValue,
        });
    });
    $(document).ready(function() {
        $('.isotope').isotope({
            itemSelector: '.thumbs_with_description',
            layoutmod: 'masonry',
        });
        $(window).scroll(function() {

            if ($(window).scrollTop() == ($(document).height() - ($(window).height()))) {
                loadData();
                $container.isotope();
            }
        });

        function loadData() {
            $.ajax({
                type: "post",
                url: "https://laptop-comparison-eldkqmfhf123.c9users.io/Getmoredata/addon",
                cache: false,
                data: {
                    'start': page
                },
                success: function(response) {
                    var arr = JSON.parse(response);
                    try {
                        var i;
                        for (i = 0; i < 30; i++) {
                            var items = "";
                            items = "<div class='thumbs_with_description " + arr[i]['graphic_spec'] + "' data-category='" + arr[i]['graphic_spec'] + "'>" +"<div class='image'>"+"<img src='" + arr[i]['img_url'] + "' class='thumbsnail'>"+"</div>"+ "<div class='description'>" + arr[i]['model'] + "</div>";
                            items = items+"<span class='text-content'><span>"+arr[i]['lcd_size']+"<br>"+arr[i]['graphic_chip']+"</span></span>";
                            items = items+"</div>";
                            $container.isotope('insert', $(items));
                        }
                        page += 30;
                    }
                    catch (e) {
                        alert("error at json processing");
                    }
                },
                error: function() {
                    alert("error at ajax connection");
                }
            });
        }
    });
</script>