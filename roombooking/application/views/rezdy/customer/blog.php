<script type="text/javascript">
    $(document).ready(function () {

        //how much items per page to show
        var show_per_page = 6;
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

    });

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
        $('#content').children().css('display', 'none').slice(start_from, end_on).css('display', 'inline-block');

        /*get the page link that has longdesc attribute of the current page and add active_page class to it
         and remove that class from previously active page link*/
        $('.page_link[longdesc=' + page_num + ']').addClass('active_page').siblings('.active_page').removeClass('active_page');

        //update the current page input field
        $('#current_page').val(page_num);
    }

</script>
</script>
<div class="home-tour">
    <div class="container"> 	
        <div class="blog">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="row blog-row">
                    <input type='hidden' id='current_page' />
                    <input type='hidden' id='show_per_page' />                    
                    <div id='content'>                                              
                          <?php                     
                                $query = $this->db->query("SELECT * FROM blog ORDER BY id ASC /*LIMIT 30*/");
                                $tours = $query->result_array();
                                foreach ($tours as $row1):?>
                                <div class="item">
                                    <div class="blog-box">
                                        <img src="<?php echo base_url()."/".$row1['image'];?>" class="img-responsove">
                                        <div class="blog-body">
                                            <h1><a href="<?php echo base_url()."index.php/user/blog_detail?id=".$row1['id'];?>"> <?php echo $row1['title'];?> </a></h1>
                                            <h2>By <a href="">Surf You To The Moon</a>	| <?php $dt = new DateTime($row1['dt']); echo $dt->format('Y-m-d');?> </h2>
                                            <p><?php $str= $row1['description'];  if(strlen($str) > 220) {echo substr($str,0,220)."[...]";}else {echo $str;}?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                          <?php endforeach; ?>
                    </div>
                    <div id='page_navigation' class="pagination-main"></div>
                </div>

            </div>
        </div>
    </div>
</div>


<style>
    *, *:before, *:after {box-sizing:  border-box !important;}

    .pagination-main {
        border: 1px solid rgb(23, 141, 164);
        display: inline-block;
        float: right;
        margin: 20px 0 0;
        padding: 5px;
    }
    .pagination-main a{
        border-left: 1px solid #e1e1e1;
        color: black;
        padding:6px 9px;
        text-decoration: none;
        cursor:pointer;
    }
    .active_page{
        background:#FD5E63;
        color:white !important;
    }

    #content {
        -moz-column-width: 18em;
        -webkit-column-width: 18em;
        -moz-column-gap: 1em;
        -webkit-column-gap:1em; 

    }

    .blog-row .item {
        display: inline-block;
        padding:  .25rem;
        width:  100%; 
    }

    .blog-row .blog-box {
        position:relative;
        display: block;
    }
</style>