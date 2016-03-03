<div class="container-fluid">
    <div class="row">
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 left">
            <div id="sidebar">
                <div id="filters" class="button-group">
                    <button class="button is-checked" data-filter="*">show all</button>
                    <button class="button" data-filter=".Intel계열">Intel</button>
                    <button class="button" data-filter=".nVidia계열">nVidia</button>
                    <button class="button" data-filter=".ATI계열">ATI</button>
                </div>
                <div class="comparelist" id="comparelist">

                </div>
            </div>
        </div>
        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 content">
            <div class="isotope">
                <?php foreach($data as $item){ ?>
                <div class="thumbs_with_description <?=$item->graphic_spec?>" data-category="<?=$item->graphic_spec?>" id="<?=$item->pid?>">
                    <div class="image">
                        <img src="<?=$item->img_url?>" class="thumbsnail">
                        <span class="text-content"><span><?=$item->lcd_size?><br><?=$item->graphic_chip?></span></span>
                    </div>
                    <div class="description">
                        <?=$item->model?></div>
                    <button type="button" class="btn btn-default btn-xs compare-btn" id="<?=$item->pid?>" onclick="addlist(this.id)">비교목록 <span class="glyphicon glyphicon-plus"></span></button>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<script>
    var page = 31;
    var added_item_cnt = 0;
    var compare_arr = [];
    var $container = $('.isotope');
    $(function()
    {
        $('#sidebar').affix({
            offset: {top:150}
        });
    });
    $('#filters').on('click', 'button', function() {
        var filterValue = $(this).attr('data-filter');
        // use filterFn if matches value
        filterValue = filterValue;
        $container.isotope({
            filter: filterValue,
        });
    });

    function getDBbyID(id) {
        var res;
        $.ajax({
            type: "post",
            url: "https://laptop-comparison-eldkqmfhf123.c9users.io/Getmoredata/getDatabyID",
            cache: false,
            async: false,
            data: {
                'pid': id
            },
            success: function(response) {
                try {
                    res = response;
                }
                catch (e) {
                    alert("json parse error");
                }
            },
            error: function(e) {
                alert("ajax error");
            }

        });
        return res;
    }

    function addlist(id) {
        if (added_item_cnt == 2) return;
        var arr = JSON.parse(getDBbyID(id));
        var item = "<li id='" + arr[0]['pid'] + "'>" + arr[0]['model'] + "<button type='button' class='btn btn-default btn-xs deletelist' id='" + arr[0]['pid'] + "'onclick='dellist(this.id)'><span class='glyphicon glyphicon-minus'></span></li>";
        var list = $('.comparelist');
        list.append(item);
        compare_arr[added_item_cnt] = arr[0]['pid'];
        added_item_cnt++;
        if (added_item_cnt == 2) {
            list.append("<a href='compare/id/" + compare_arr[0] + "/" + compare_arr[1] + "' id='comparebutton'><button type='button' class='btn btn-default btn-md'>비교하기</button></a>");
        }
    }

    function dellist(id) {
        var parentNode = document.getElementById("comparelist");
        parentNode.removeChild(document.getElementById(id));
        if (added_item_cnt == 2)
            parentNode.removeChild(document.getElementById('comparebutton'));
        added_item_cnt--;
    }
    $(document).ready(function() {
        $('.isotope').isotope({
            itemSelector: '.thumbs_with_description',
            layoutmod: 'masonry',
        });
        $(window).scroll(function() { // When hit bottom

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
                            items = "<div class='thumbs_with_description " + arr[i]['graphic_spec'] + "' data-category='" + arr[i]['graphic_spec'] + "'>" + "<div class='image'>" + "<img src='" + arr[i]['img_url'] + "' class='thumbsnail'>" + "<span class='text-content'><span>" + arr[i]['lcd_size'] + "<br>" + arr[i]['graphic_chip'] + "</span></span>" + "</div>" + "<div class='description'>" + arr[i]['model'] + "</div>";
                            items = items + "</div>";
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