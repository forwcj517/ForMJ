<?php
//include ('../common/header.php') 
$this->load->view('rezdy/common/header');
?>

<script type="text/javascript" src="https://uniquehunting.com/js/scripts.js"></script>
<script src="http://code.jquery.com/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript">
</script>

<script type="text/javascript">
    $(document).ready(function () {
        //how much items per page to show
        init();
    });
    function init() {
        var show_per_page = 4;
        //getting the amount of elements inside content div
        var number_of_items = $('#content').children().size();
        //calculate the number of pages we are going to have
        var number_of_pages = Math.ceil(number_of_items / show_per_page);

        //set the value of our hidden input fields
        $('#current_page').val(0);
        $('#show_per_page').val(show_per_page);

        //now when we got all we need for the navigation let's make it '

        /* 
         what are we going to have in the navigation?
         - link to previous page
         - links to specific pages
         - link to next page
         */
        var navigation_html = '<a class="previous_link" href="javascript:previous();">Prev</a>';
        var current_link = 0;
        while (number_of_pages > current_link) {
            navigation_html += '<a class="page_link" href="javascript:go_to_page(' + current_link + ')" longdesc="' + current_link + '">' + (current_link + 1) + '</a>';
            current_link++;
        }
        navigation_html += '<a class="next_link" href="javascript:next();">Next</a>';

        $('#page_navigation').html(navigation_html);

        //add active_page class to the first page link
        $('#page_navigation .page_link:first').addClass('active_page');

        //hide all the elements inside content div
        $('#content').children().css('display', 'none');

        //and show the first n (show_per_page) elements
        $('#content').children().slice(0, show_per_page).css('display', 'block');
    }


    function previous() {

        new_page = parseInt($('#current_page').val()) - 1;
        //if there is an item before the current active link run the function
        if ($('.active_page').prev('.page_link').length == true) {
            go_to_page(new_page);
        }

    }

    function next() {
        new_page = parseInt($('#current_page').val()) + 1;
        //if there is an item after the current active link run the function
        if ($('.active_page').next('.page_link').length == true) {
            go_to_page(new_page);
        }

    }
    function go_to_page(page_num) {
        //get the number of items shown per page
        var show_per_page = parseInt($('#show_per_page').val());

        //get the element number where to start the slice from
        start_from = page_num * show_per_page;

        //get the element number where to end the slice
        end_on = start_from + show_per_page;

        //hide all children elements of content div, get specific items and show them
        $('#content').children().css('display', 'none').slice(start_from, end_on).css('display', 'block');

        /*get the page link that has longdesc attribute of the current page and add active_page class to it
             
         and remove that class from previously active page link*/
        $('.page_link[longdesc=' + page_num + ']').addClass('active_page').siblings('.active_page').removeClass
                ('active_page');

        //update the current page input field
        $('#current_page').val(page_num);
    }

    function filterTours(city) {
        locations = <?php echo json_encode($tours); ?>;
        var toAppend = '';
        $i = 0;
        $.each(locations, function (i, o) {



//                           <div class="col-md-3">
//                               
//                                <div class="tour-section">
//                                <a href="http://localhost/surfmoon/index.php/user/overview/"><img src="https://img.rezdy.com/PRODUCT_IMAGE/59945/lava2_tb.jpg" class="img-responsive" style="height: 230px;"> </a>
//                                        <div class="tour-dec">                    
//                                            <p><b>$ 200 </b> Big Island Lava Hike Tours</p>                                            
//                                        </div>
//                                    </div>
//                            </div>   

            if(city != null && o.city_id != null){
                if (o.city_id.includes(city)) {
                    if ($i % 4 == 0) {
                        toAppend = toAppend + '<div class="row">';
                    }
                    toAppend = toAppend + '<div class="col-sm-3">';
                    toAppend = toAppend + '<div class="tour-section">';

                    toAppend = toAppend + '<a  href="<?php echo site_url('user/overview/') ?>' + o.id + '">';
                    toAppend = toAppend + '<img src="' + o.image_url + '" class="img-responsive" style="width:100%;height: 230px;"/>';
                    toAppend = toAppend + '</a>';

                    toAppend = toAppend + '<div class="tour-dec">';
                    toAppend = toAppend + '<p> <b>$' + o.price + ' &nbsp </b>' + o.name;
                    toAppend = toAppend + '</p>';
                    toAppend = toAppend + '</div>';
                    toAppend = toAppend + '</div>';
                    toAppend = toAppend + '</div>';
                    if (($i % 4 == 3) || locations.length == $i + 1) {
                        toAppend = toAppend + '</div>                            ';
                    }
                    $i = $i + 1;
                }
            }            
        });
        //                                    if(locations.length > 0){
        $("#content").html(toAppend);
        //document.getElementById("city").innerHTML = city;

        //                                    }
        init();
    }
</script>
<style>
    #page_navigation {
        float: right; 
        border: 1px solid rgb(23, 141, 164); 
        padding: 5px;
    }
    #page_navigation a{
        border-left: 1px solid #e1e1e1;
        color: black;
        padding:6px 9px;
        text-decoration: none;

    }
    .active_page{
        background:#FD5E63;
        color:white !important;
    }
</style>



<script>
    function changelist(id)
    {
        filterTours(id);
        //$('.result').hide();
        //$('#list' + id).show();
        //concept(id);
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




<div class="row">
    <div class="container">
        <div class="row">
            
            <div class="col-sm-12">

                <div class="border result" id="list">                                    
                    <div class="row">
                        <h3 id="city">Rooms</h3>
                    </div>

                    <input type='hidden' id='current_page' />
                    <input type='hidden' id='show_per_page' />                                                        
                    <div id='content'>

                        <?php
                        $i = 0;                                               
                        foreach ($tours as $row1):
                            ?>                                                                                          
                                <?php if ($i % 4 == 0 && $i == 0) { ?>                                                                                          
                                <div class="row" style="margin-bottom: 15px;">            
                                    <?php } else if ($i % 4 == 0) { ?>                                                                                      
                                    <div class="row" style="margin-bottom: 15px;">      
    <?php } ?>

                                    <div class="col-md-3">
                                        <a href="">
                                            <div class="tour-section">
                                                <a href="<?php echo site_url('user/overview/'.$row1['id']) ?>">
                                                    <img src="<?php echo base_url($row1['image_url']); ?>" class="img-radius" style="display: block; width: 100%;height: 230px; padding: 0px; margin: 0px;"> 
                                                </a>
                                                <div class="tour-dec" style="margin-right:15px; margin-left: 15px; padding-bottom: 10px;">                    
                                                    <p><b> <?php echo currency().$row1['price']; ?> </b> <?php echo $row1['name']; ?></p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>  
    <?php if (($i % 4 == 3 ) || sizeof($tours) == $i + 1) { ?>
                                    </div>

                                <?php } ?>
                                <?php
                                $i++;
                            endforeach;
                            ?>
                        </div>                                                                                    

                        <div id='page_navigation'>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
$this->load->view('rezdy/common/footer');
?>
