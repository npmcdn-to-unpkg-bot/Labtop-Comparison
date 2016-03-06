<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 left sidebar">
                <div id="filters">
                    <p>
                        <input type="text" class="quicksearch" placeholder="검색" id="search_query" />
                    </p>
                    <label>그래픽</label>
                    <br>
                    <select class="selectpicker" id="graphic_filter">
                        <option selected value="">Show All</option>
                        <option value="Intel">Intel</option>
                        <option value="nVidia">nVidia</option>
                        <option value="ATI">ATI</option>
                    </select>
                </div>
                <div class="comparelist" id="comparelist">

                </div>
            </div>

            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 content">
                <div class="dataset" id="dataset">
                    <div class="isotope" id="isotope">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    var page = 0;
    var init = 0;
    var added_item_cnt = 0;
    var compare_arr = [];
    var $container = $('.isotope');
    $(function() {
        $('#sidebar').affix({
            offset: {
                top: 150
            }
        });
    })

    $('#graphic_filter').change(function() {
        var e = document.getElementById('graphic_filter');
        var selected = e.options[e.selectedIndex].value;
        page = 0;
        var $elem = document.getElementById('isotope').childNodes;
        $container.isotope('remove', $elem);
        loadData($('#search_query').val(), selected);
    });

    $('#search_query').keyup(function() {
        delay(function() {
            var query = $('#search_query').val();
            page = 0;
            var $elem = document.getElementById('isotope').childNodes;
            var e = document.getElementById('graphic_filter');
            var graphic_filter = e.options[e.selectedIndex].value;
            $container.isotope('remove', $elem);
            loadData(query, graphic_filter);
        }, 200);

    });
    var delay = (function() {
        var timer = 0;
        return function(callback, ms) {
            clearTimeout(timer);
            timer = setTimeout(callback, ms);
        };
    })();

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
                var e = document.getElementById('graphic_filter');
                var selected = e.options[e.selectedIndex].value;
                loadData($('#search_query').val(), selected);
            }
        });
        if (init == 0) {
            init = 1;
            var e = document.getElementById('graphic_filter');
            var selected = e.options[e.selectedIndex].value;
            loadData($('#search_query').val(), selected);
        }
    });

    function loadData(query, gpu_filter) {
        $.ajax({
            type: "post",
            url: "https://laptop-comparison-eldkqmfhf123.c9users.io/Getmoredata/addon",
            cache: false,
            data: {
                'start': page,
                'query': query,
                'graphic_filter': gpu_filter
            },
            success: function(response) {
                var arr = JSON.parse(response);
                try {
                    var i;
                    var items = "";
                    for (i = 0; i < arr.length; i++) {
                        items = items + "<div id='thumbs_with_description' class='thumbs_with_description " + arr[i]['graphic_spec'] + "' data-category='" + arr[i]['graphic_spec'] + "'>" + "<div class='image'>" + "<img src='" + arr[i]['img_url'] + "' class='thumbsnail'>" + "<span class='text-content'><span>" + arr[i]['lcd_size'] + "<br>" + arr[i]['graphic_chip'] + "</span></span>" + "</div>" + "<div class='description'>" + arr[i]['model'] + "</div>";
                        items = items + "<button type='button' class='btn btn-default btn-xs compare-btn' id='" + arr[i]['pid'] + "'onclick='addlist(this.id)'>비교목록 <span class='glyphicon glyphicon-plus'></span></button>";
                        items = items + "</div>";
                    }
                    $container.isotope('insert', $(items));
                    page += 30;
                }
                catch (e) {
                    alert("error at json processing");
                }
            },
            error: function() {
                //           alert("error at ajax connection");
            }
        });
    }
</script>
