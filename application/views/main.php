<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 left">
                <div id="sidebar">
                    <div id="filters">
                        <label>화면 크기</label>
                        <br>
                        <select class="selectpicker" id="size_filter">
                            <option selected value="">Show All</option>
                            <option value="11.6">11.6인치</option>
                            <option value="13.3">13.3인치</option>
                            <option value="14">14인치</option>
                            <option value="15.6">15.6인치</option>
                            <option value="17.3">17.3인치</option>

                        </select>
                        <br>
                        <br>
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
<div class='modal fade' id='description_modal' tabindex='-1' role='dialog' area-labelledby='modallabel' aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-title" id='modallabel'></div>
            <div class="modal-body"></div>
            <div class="modal-footer"></div>
        </div>
    </div>

</div>
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

    $('#graphic_filter, #size_filter').change(function() {
        page = 0;
        var $elem = document.getElementById('isotope').childNodes;
        $container.isotope('remove', $elem);
        loadData();
    });


    $('#search_query').keyup(function() {
        delay(function() {
            var query = $('#search_query').val();
            page = 0;
            var $elem = document.getElementById('isotope').childNodes;
            $container.isotope('remove', $elem);
            loadData();
        }, 200);

    });
    var delay = (function() {
        var timer = 0;
        return function(callback, ms) {
            clearTimeout(timer);
            timer = setTimeout(callback, ms);
        };
    })();

    $('#description_modal').on('show.bs.modal', function(e) {
        var pid = ($(e.relatedTarget).attr('data-id'));
        var arr = JSON.parse(getDBbyID(pid));
        var item = "<h4>" + arr[0]['model'] + "</h4>";
        var footer = "<a target='_blank' href='http://www.bb.co.kr/model/" + arr[0]['pid'] + "'><button type='button' class='btn btn-default btn-xs'>구매하러 가기</button><button type='button' class='btn btn-default btn-xs compare-btn' id='" + arr[0]['pid'] + "' onclick='addlist(this.id)'>비교목록<span class='glyphicon glyphicon-plus'></span></button>";
        $('.modal-title').empty();
        $('.modal-title').append(item);
        item = '<div style="text-align:center;"><img src="' + arr[0]['img_url'] + '" ></div>'
        item = item + '<table><tr><td><strong>화면 크기</strong></td><td>'+arr[0]['lcd_size']+'</td></tr><tr><td><strong>해상도</strong></td><td>'+arr[0]['lcd_resolution']+'</td></tr></table><table><tr><td><strong>CPU</strong></td><td>'+arr[0]['cpu_core']+'</td></tr><tr><td><strong>CPU 클럭</strong></td><td>'+arr[0]['cpu_clock']+'</td></tr></table><table><tr><td><strong>RAM</strong></td><td>'+arr[0]['memory_size']+'</td></tr><tr><td><strong>RAM 종류</strong></td><td>'+arr[0]['memory_spec']+'</td></tr></table><table><tr><td><strong>GPU종류</strong></td><td>'+arr[0]['graphic_spec']+'</td></tr><tr><td><strong>GPU 모델</strong></td><td>'+arr[0]['graphic_chip']+'</td></tr><tr><td><strong>GPU 전용 메모리</strong></td><td>'+arr[0]['graphic_mem']+'</td></tr></table><table><tr><td><strong>사이즈</strong></td><td>'+arr[0]['size']+'</td></tr><tr><td><strong>무게</strong></td><td>'+arr[0]['weight']+'</td></tr></table>';
        $('.modal-body').empty();
        $('.modal-body').append(item);
        $('.modal-footer').empty();
        $('.modal-footer').append(footer);
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
            }
            $container.isotope('layout');
        });
        if (init == 0) {
            init = 1;
            loadData();
        }
    });

    function loadData() {
        $container.isotope('layout');
        var graphic_node = document.getElementById('graphic_filter');
        var graphic_filter = graphic_node.options[graphic_node.selectedIndex].value;
        var size_node = document.getElementById('size_filter');
        var size_filter = size_node.options[size_node.selectedIndex].value;
        var query = $('#search_query').val();
        $.ajax({
            type: "post",
            url: "https://laptop-comparison-eldkqmfhf123.c9users.io/Getmoredata/addon",
            cache: false,
            data: {
                'start': page,
                'query': query,
                'size_filter': size_filter,
                'graphic_filter': graphic_filter
            },
            success: function(response) {
                var arr = JSON.parse(response);
                try {
                    var i;
                    var items = "";
                    for (i = 0; i < arr.length; i++) {
                        items = items + "<div id='thumbs_with_description' class='thumbs_with_description panel panel-default'><button type='button' class='btn btn-default btn-xs compare-btn' id='" + arr[i]['pid'] + "' onclick='addlist(this.id)'>비교목록<span class='glyphicon glyphicon-plus'></span></button>";
                        items = items + "<div class='panel-body'><a data-toggle='modal' href='#description_modal' data-id='" + arr[i]['pid'] + "'><img src='" + arr[i]['img_url'] + "' class='thumbsnail'/></a></div><div class='panel-footer description'>" + arr[i]['model'] + "</div></div>";
                    }
                    $(items).imagesLoaded(function() {
                        $container.isotope('insert', $(items));
                    });

                    page += arr.length;
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
