<?php
$this->load->view('rezdy/common/header');
?>

<script type="text/javascript">
    $(document).ready(function () {
        var id = 'current_page1';
        //concept(1);
        changelist(1);

    });


    function concept(id)
    {
        var show_per_page = 1;
        //getting the amount of elements inside content div
        var number_of_items = $('#content' + id).children().size();
        //calculate the number of pages we are going to have
        var number_of_pages = Math.ceil(number_of_items / show_per_page);

        //set the value of our hidden input fields
        $('#current_page' + id).val(0);
        $('#show_per_page' + id).val(show_per_page);

        //now when we got all we need for the navigation let's make it '

        /* 
         what are we going to have in the navigation?
         - link to previous page
         - links to specific pages
         - link to next page
         */
        var navigation_html = '<a class="previous_link' + id + '" href="javascript:previous(' + id + ');">Prev</a>';
        var current_link = 0;
        while (number_of_pages > current_link) {
            navigation_html += '<a class="page_link' + id + '" href="javascript:go_to_page(' + current_link + ',' + id + ')" longdesc="' + current_link + '">' + (current_link + 1) + '</a>';
            current_link++;
        }
        navigation_html += '<a class="next_link' + id + '" href="javascript:next(' + id + ');">Next</a>';

        $('#page_navigation' + id).html(navigation_html);

        //add active_page class to the first page link
        $('#page_navigation' + id + ' .page_link' + id + ':first').addClass('active_page' + id);

        //hide all the elements inside content div
        $('#content' + id).children().css('display', 'none');

        //and show the first n (show_per_page) elements
        $('#content' + id).children().slice(0, show_per_page).css('display', 'block');
    }
    function previous(id) {
        new_page = parseInt($('#current_page' + id).val()) - 1;
        //if there is an item before the current active link run the function
        if ($('.active_page' + id).prev('.page_link' + id).length == true) {
            go_to_page(new_page, id);
        }

    }

    function next(id) {
        new_page = parseInt($('#current_page' + id).val()) + 1;
        //if there is an item after the current active link run the function
        if ($('.active_page' + id).next('.page_link' + id).length == true) {
            go_to_page(new_page, id);
        }

    }
    function go_to_page(page_num, id) {
        //get the number of items shown per page
        var show_per_page = parseInt($('#show_per_page' + id).val());

        //get the element number where to start the slice from
        start_from = page_num * show_per_page;

        //get the element number where to end the slice
        end_on = start_from + show_per_page;

        //hide all children elements of content div, get specific items and show them
        $('#content' + id).children().css('display', 'none').slice(start_from, end_on).css('display', 'block');

        /*get the page link that has longdesc attribute of the current page and add active_page class to it
         
         and remove that class from previously active page link*/
        $('.page_link' + id + '[longdesc=' + page_num + ']').addClass('active_page' + id).siblings('.active_page' + id).removeClass
                ('active_page' + id);

        //update the current page input field
        $('#current_page' + id).val(page_num);
    }

</script>
<style>
    .pagination-main {
        float: right; 
        border: 1px solid rgb(23, 141, 164); 
        padding: 5px;
    }
    .pagination-main a{
        border-left: 1px solid #e1e1e1;
        color: black;
        padding:6px 9px;
        text-decoration: none;
        cursor:pointer;
    }
    .active_page1, .active_page2, .active_page3{
        background:#FD5E63;
        color:white !important;
    }
    hr
    {
        display:inline-block;
        width:100%;
    }
</style>
<script>
    function changelist(id)
    {
        //$('.result').hide();
        $('#list' + id).show();
        concept(id);
    }


    $('.nav-tabs-dropdown').each(function (i, elm) {

        $(elm).text($(elm).next('ul').find('li.active a').text());

    });

    $('.nav-tabs-dropdown').on('click', function (e) {

        e.preventDefault();

        $(e.target).toggleClass('open').next('ul').slideToggle();

    });

    $('#nav-tabs-wrapper a[data-toggle="tab"]').on('click', function (e) {

        e.preventDefault();

        $(e.target).closest('ul').hide().prev('a').removeClass('open').text($(this).text());

    });
</script>






<script>
    // Starrr plugin (https://github.com/dobtco/starrr)
    var __slice = [].slice;
    (function ($, window) {
        var Starrr;

        Starrr = (function () {
            Starrr.prototype.defaults = {
                rating: void 0,
                numStars: 5,
                change: function (e, value) {               
                     $("#rate").val(value);
                }
            };

            function Starrr($el, options) {
                var i, _, _ref,
                        _this = this;

                this.options = $.extend({}, this.defaults, options);
                this.$el = $el;
                _ref = this.defaults;
                for (i in _ref) {
                    _ = _ref[i];
                    if (this.$el.data(i) != null) {
                        this.options[i] = this.$el.data(i);
                    }
                }
                this.createStars();
                this.syncRating();
                this.$el.on('mouseover.starrr', 'i', function (e) {
                    return _this.syncRating(_this.$el.find('i').index(e.currentTarget) + 1);
                });
                this.$el.on('mouseout.starrr', function () {
                    return _this.syncRating();
                });
                this.$el.on('click.starrr', 'i', function (e) {
                    return _this.setRating(_this.$el.find('i').index(e.currentTarget) + 1);
                });
                this.$el.on('starrr:change', this.options.change);
            }

            Starrr.prototype.createStars = function () {
                var _i, _ref, _results;

                _results = [];
                for (_i = 1, _ref = this.options.numStars; 1 <= _ref ? _i <= _ref : _i >= _ref; 1 <= _ref ? _i++ : _i--) {
                    _results.push(this.$el.append("<i class='fa fa-star-o'></i>"));
                }
                return _results;
            };

            Starrr.prototype.setRating = function (rating) {
                if (this.options.rating === rating) {
                    rating = void 0;
                }
                this.options.rating = rating;
                this.syncRating();
                return this.$el.trigger('starrr:change', rating);
            };

            Starrr.prototype.syncRating = function (rating) {
                var i, _i, _j, _ref;

                rating || (rating = this.options.rating);
                if (rating) {
                    for (i = _i = 0, _ref = rating - 1; 0 <= _ref ? _i <= _ref : _i >= _ref; i = 0 <= _ref ? ++_i : --_i) {
                        this.$el.find('i').eq(i).removeClass('fa-star-o').addClass('fa-star');
                    }
                }
                if (rating && rating < 5) {
                    for (i = _j = rating; rating <= 4 ? _j <= 4 : _j >= 4; i = rating <= 4 ? ++_j : --_j) {
                        this.$el.find('i').eq(i).removeClass('fa-star').addClass('fa-star-o');
                    }
                }
                if (!rating) {
                    return this.$el.find('i').removeClass('fa-star').addClass('fa-star-o');
                }
            };

            return Starrr;

        })();
        return $.fn.extend({
            starrr: function () {
                var args, option;

                option = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
                return this.each(function () {
                    var data;

                    data = $(this).data('star-rating');
                    if (!data) {
                        $(this).data('star-rating', (data = new Starrr($(this), option)));
                    }
                    if (typeof option === 'string') {
                        return data[option].apply(data, args);
                    }
                });
            }
        });
    })(window.jQuery, window);

    $(function () {
        return $(".starrr").starrr();
    });
</script>

<style>
    .inner-menu ul li.review-menu a
    {
        color: #f24d52;
        border-bottom-color:#f24d52
    }
</style>


<div class="innerpage overview">
<!--    <div class="main-iiner-img">
        <div class="banner-button">
            <a href="">View Photos</a>
        </div>
    </div>-->
    
    <!--<img src="<?php echo base_url($this->db->get_where('tour', array('id' => $id))->row()->image_url);?>" class="img-responsive" style="height:300px; position: relative; display: block;margin-left: auto; margin-right: auto;" >-->
    
    <div class="container">
        <div class="inner-wrapper">
            <!-- left-->
            <div class="col-sm-8">
                <div class="inner-menu">
                    <ul>
                        <li><a href="<?php echo site_url('user/overview/' . $id); ?>">Overview</a></li>                            
                        <li><a href="<?php echo site_url('user/location/' . $id); ?>">Location</a></li>
                        <li class="review-menu"><a href="<?php echo site_url('user/review/' . $id); ?>">Reviews</a></li>
                        <li><a href="<?php echo site_url('user/host/' . $id); ?>">Tour Guide</a></li>                                                                  
                    </ul>
                </div>
                <div class="head-over" style="padding:20px 0px;">
                    <div class="row">
                        <div class="col-sm-8">

                            <div class="star-rating">
                                <a style="font-size:20px; padding-right:30px; color:#000; font-family:SourceS"><?php $tours = $this->db->get_where('review', array('tour_id' => $id))->result_array(); echo sizeof($tours); ?> Reviews</a>
                                
                                <?php $rate = $this->db->get_where('tour', array('id' => $id))->row()->rate;
                                if($rate == 5){ ?>
                                <a href=""><i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="false"></i>
                                    <i class="fa fa-star" ></i></a>
                                <?php } else if($rate == 4) {?>
                                <a href=""><i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>                                    
                                    <i class="fa fa-star" ></i></a>
                                <?php } else if($rate == 3) {?>
                                <a href=""><i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>                                    
                                    <i class="fa fa-star" ></i></a>
                                <?php } else if($rate == 2) {?>
                                <a href=""><i class="fa fa-star" aria-hidden="true"></i>                                                   
                                    <i class="fa fa-star" ></i></a>
                                <?php } else if($rate == 1) {?>
                                <a href="">                                    
                                    <i class="fa fa-star" ></i></a>
                                <?php } ?>
                                                                
                            </div>

                        </div>
                        <!--                        <div class="col-sm-4 text-center">
                                                    <input placeholder="Search reviews"class="required email form-control" type="text">
                                                </div>-->
                        <div class="clearfix"></div>
                    </div>
                </div>	
                <!--room-info-->
                <div class="room-info-over review-page">
                    
                </div>
                <!--room-info-->


                <!-- Customer-review-->
                <div class="cut-review-section">
                    <!-- first Review-->                    
                    <div class="border result1" id="list1">
                        <input type='hidden' id='current_page1' />
                        <input type='hidden' id='show_per_page1' />
                        <div id='content1'>



                            <?php
                            $i = 0;
                            $tours = $this->db->get_where('review', array('tour_id' => $id))->result_array();
                            foreach ($tours as $row1):
                                ?>                                                                                          
                                <?php if ($i % 5 == 0 && $i == 0) { ?>
                                    <div class="item active">                                                    
                                        <div class="row">
                                        <?php } else if ($i % 5 == 0) { ?>
                                            <div class="item">                                                    
                                                <div class="row">      
                                                <?php } ?>                                                                       

                                                <div class="review-section-m">
                                                    <div class="col-sm-2">
                                                        <img src="<?php
                                                        $tid = $row1['tour_id'];
                                                        $tdata = $this->db->get_where('tour', array('id' => $tid))->row();
                                                        echo base_url() . $tdata->image_url;
                                                        ?>" class="img-responsive">									
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <h2><a href=""><?php echo $row1['title'];
                                                         ; ?></a></h2>
                                                        <div class="give-review">                                                               
                                                            <div class="price-of-proj">
                                                                <a><div id="stars-existing" class="starrr" data-rating='<?php echo $row1['rate']; ?>'></div></a>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <p><?php echo $row1['comment'];
                                                         ; ?></p>
                                                        <!--<p class="client-de">- <a href="">Date:</a> <?php echo $row1['date']; ?> <a href="">Time:</a> <?php echo $row1['time']; ?></p>-->
                                                    </div>
                                                </div>
                                                <hr>  

                                        <?php if (($i % 5 == 4 ) || sizeof($tours) == $i + 1) { ?>
                                                </div>                                                                                                
                                            </div>
                                        <?php } ?>                                
                                        <?php
                                        $i++;
                                    endforeach;
                                    ?>  



                                </div>
                                <div id="page_navigation1" class="pagination-main"></div>
                            </div>

                            <!--                    <div class="row">
                                                    <div class="review-section-m">
                                                        <div class="col-sm-2">
                                                            <img src="<?php echo base_url('assets_extra/img/original.jpg') ?>" class="img-responsive">									
                                                        </div>
                                                        <div class="col-sm-10">
                                                            <h2><a href="">Project Name</a></h2>
                                                            <div class="give-review">
                                                                <div class="nu-of-review">
                                                                    <span>4</span>
                                                                    
                                                                    <i class="fa fa-star orange" aria-hidden="true"></i>
                                                                    <i class="fa fa-star orange" aria-hidden="true"></i>
                                                                    <i class="fa fa-star orange" aria-hidden="true"></i>
                                                                    <i class="fa fa-star orange" aria-hidden="true"></i>
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                </div>
                                                                <div class="price-of-proj">
                                                                </div>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <p>"Great work experience for my first project. Professional team with great support followup & feedback policy. Thanks & Best of Luck"</p>
                            
                                                            <p class="client-de">- <a href="">Client Name</a> (2 weeks ago.) </p>
                                                        </div>
                                                    </div>
                                                </div>-->

                            <!-- first Review-->
                        </div>
                        <!-- Customer-review-->
                    </div>
                    <!-- left-->
                    <!-- right-->
                    <div class="col-sm-4">
<?php $this->load->view('rezdy/common/over-right'); ?>
                    </div>
                    <!-- right-->
                </div>
            </div>
        </div>

<?php $this->load->view('rezdy/common/footer'); ?>

        <script>
            $('document').ready(function () {
                $(".show-ami-over").click(function () {
                    $(".overline").css("display", "block");
                    $(".show-ami-over").css("display", "none");
                });
            });
        </script>