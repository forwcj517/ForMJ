
<?php
$edit_data = $this->db->get_where('tour', array('id' => $param2))->result_array();
foreach ($edit_data as $row):
    ?>

<div class="row" style = "height:100% ; overflow-y: scroll;">
    <div class="col-md-12">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_city'); ?>
                </div>
            </div>
            <div class="panel-body">

                <form>
                    <fieldset class="gllpLatlonPicker">
                        <input type="text" class="gllpSearchField">
                        <input type="button" class="gllpSearchButton" value="search">
                        <br/><br/>
                        <div class="gllpMap">Google Maps</div>
                        <br/>
                        lat/lon:
                        <input type="text" class="gllpLatitude" value="-0.023559"/>
                        /
                        <input type="text" class="gllpLongitude" value="37.90619300000003"/>
                        <br/>
                        <br/>
                        zoom: 
                        <input type="text" class="gllpZoom" value="8"/>
                        
                        <input type="button" class="gllpUpdateButton" value="update map">
                        <br/>
                    </fieldset>
                </form>

<!--                <form action="<?php echo site_url('admin/manager_city/create');?>" class="form-horizontal form-groups-bordered validate" enctype="multipart/form-data"/>-->
                						
                                       			
    <?php echo form_open_multipart('admin/audiolist_upload_it/do_update/' . $row['id'] . '/' . $param3,  array('class' => 'form-horizontal form-groups-bordered validate','enctype'=>"multipart/form-data"));?>

                <br/>                                
                <div class="form-group">
                    <div class="row">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>											
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="name" value="<?= $row['name']; ?>" required autofocus>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>											
                        <div class="col-sm-5">
                            <textarea type = "text" class = "form-control" name="description" cols="40" rows="5"  required autofocus><?= $row['description']; ?></textarea>
                        </div>    
                    </div>   
                    <div class="row" style="margin-top: 10px;">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('video_id'); ?></label>											
                        <div class="col-sm-5">
                            <input type = "text" class = "form-control" name="video_id" cols="40" rows="5"  value="<?= $row['video_id']; ?>" required autofocus/>
                        </div>    
                    </div> 
                    <div class="row" style="margin-top: 10px;">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('price'); ?></label>											
                        <div class="col-sm-5">
                            <input type = "number" class = "form-control" name="price" cols="40" rows="5" value="<?= $row['price']; ?>"  required autofocus/>
                        </div>    
                    </div>
                     <div class="row" style="margin-top: 10px;">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('max_count'); ?></label>											
                        <div class="col-sm-5">
                            <input type = "number" class = "form-control" name="max_count"  value="<?= $row['max_count']; ?>" required autofocus/>
                        </div>    
                    </div>
                    
                    
                    
                    <div class="row" style="margin-top: 10px;">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('include'); ?></label>											
                        <div class="col-sm-5">
                            <textarea type = "text" class = "form-control" name="include" cols="40" rows="5"  required autofocus><?= $row['include']; ?></textarea>
                        </div>    
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('know'); ?></label>											
                        <div class="col-sm-5">
                            <textarea type = "text" class = "form-control" name="know" cols="40" rows="5"    required autofocus><?= $row['know']; ?></textarea>
                        </div>    
                    </div>
                    
                    <div class="row" style="margin-top: 10px;">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('summary'); ?></label>											
                        <div class="col-sm-5">
                            <textarea type = "text" class = "form-control" name="summary" cols="40" rows="5"  required autofocus><?= $row['summary']; ?></textarea>
                        </div>    
                    </div>   
                    
                    <div class="form-group" style="margin-top: 10px;">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Auto Confirm'); ?></label>
                        <div class="col-sm-5">
                            <select id="auto_confirm" name="auto_confirm" class="form-control" required data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" >											                                
                                <option value="1" selected >Auto Confirm Allow</option>
                                <option value="0"  >Auto Confirm Disable</option>                                
                            </select>
                        </div>
                    </div>
                    
                    
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('logo'); ?></label>	
                        <div class=" col-sm-5">
                            <input type="file" name="userlogo" size="20" />
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('file path'); ?></label>	
                        <div class=" col-sm-5">
                            <input type="file" name="userfile" size="20" />
                        </div>
                    </div>                                                              
                </div>
                
                <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('select category'); ?></label>
                        <div class="col-sm-5">

                            <select id="category_id" name="category_id" class="form-control" required data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" autofocus>											
                                <?php
                                $semesters = $this->db->get_where('category', null)->result_array(); //array('company' => $this->session->userdata('admin_id'))
                                foreach ($semesters as $row1):
                                    ?>
                                    <option value="<?php echo $row1['id']; ?>" selected >
                                    <?php echo $row1['name']; ?>
                                    </option>
<?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                
                <div class="form-group" hidden = "true">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('city_id'); ?></label>										
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="city_id" value=<?php echo $param2; ?> READONLY>
                    </div>
                </div>                         
                
                <div class="form-group" hidden = "true" >
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('location'); ?></label>										
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id = "lat" name="lat"  value="-0.023559" required autofocus >
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id = "lon" name="lon"  value="37.90619300000003" required autofocus >
                        <input type="text" class="location" id="location" name="location" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_tour'); ?></button>
                    </div>
                </div>

                </form>




            </div>
        </div>
    </div>
</div>


 <?php
endforeach;
?>


<script src="<?php echo base_url('assets/picker/js/jquery-gmaps-latlon-picker.js');?>"></script>
<script>


    $(document).ready(function () {


        sleep(1000);


        if (!$.gMapsLatLonPickerNoAutoInit) {

            $(".gllpLatlonPicker").each(function () {
                $obj = $(document).gMapsLatLonPicker();
                $obj.init($(this));
            });
        }
    });


    function sleep(milliseconds) {
        var start = new Date().getTime();
        for (var i = 0; i < 1e7; i++) {
            if ((new Date().getTime() - start) > milliseconds) {
                break;
            }
        }
    }


    $(document).bind("location_changed", function (event, object) {
        console.log("changed: " + $(object).attr('id'));
    });



    function updateSize() {
        var nBytes = 0,
                filePath = document.getElementById("uploadInput");
        oFiles = document.getElementById("uploadInput").files,
                nFiles = oFiles.length;
        for (var nFileId = 0; nFileId < nFiles; nFileId++) {
            nBytes += oFiles[nFileId].size;
        }
        var sOutput = nBytes + " bytes";
        // optional code for multiples approximation
        for (var aMultiples = ["KiB", "MiB", "GiB", "TiB", "PiB", "EiB", "ZiB", "YiB"], nMultiple = 0, nApprox = nBytes / 1024; nApprox > 1; nApprox /= 1024, nMultiple++) {
            sOutput = nApprox.toFixed(3) + " " + aMultiples[nMultiple] + " (" + nBytes + " bytes)";
        }
        // end of optional code
        var fileName0 = oFiles[0].name;
        var fileExt0 = fileName0.split(/[.]/);

        /*var fileName1 = oFiles[1].name;
         var fileExt1 = fileName1.split(/[.]/);
         
         if(fileExt0[1] == "mp4" || fileExt0[1] == "avi" || fileExt0[1] == "3gp" ){
         document.getElementById("fileName").value = fileExt0[0];
         }
         if(fileExt1[1] == "mp4" || fileExt1[1] == "avi" || fileExt1[1] == "3gp" ){
         document.getElementById("fileName").value = fileExt0[0];
         }*/
        document.getElementById("fileName").value = fileExt0[0];


        document.getElementById("fileDescription").value = fileExt0[0];
        //  document.getElementById("uploadLogo").value = s;
        // document.getElementById("fileSize").innerHTML = sOutput;

        // readBlob(0,nBytes);
    }

    var tagResult;
    function readBlob(opt_startByte, opt_stopByte) {
        var files = document.getElementById('uploadInput').files;
        if (!files.length) {
            alert('Please select a file!');
            return;
        }
        var file;// = files[1];
        var fileName0 = files[0].name;
        var fileExt0 = fileName0.split(/[.]/);
        var fileName1 = files[1].name;
        var fileExt1 = fileName1.split(/[.]/);

        if (fileExt0[1] != "mp4" && fileExt0[1] != "avi" && fileExt0[1] != "3gp") {
            file = files[0];
        }
        if (fileExt1[1] != "mp4" && fileExt1[1] != "avi" && fileExt1[1] != "3gp") {
            file = files[1];
        }
        var start = parseInt(opt_startByte) || 0;
        var stop = parseInt(opt_stopByte) || file.size - 1;

        var reader = new FileReader();

        // If we use onloadend, we need to check the readyState.
        reader.onloadend = function (evt) {
            if (evt.target.readyState == FileReader.DONE) { // DONE == 2
                document.getElementById("fileDescription").innerHTML = evt.target.result;
                tagResult = evt.target.result;

                if (tagResult != null && tagResult != "") {
                    //var xml = result,
                    xmlDoc = $.parseXML(tagResult),
                            $xml = $(xmlDoc),
                            $title = $xml.find("street");

                    // Append "RSS Title" to #someElement
                    //$( "#fileDescription" ).append( $title.text() );
                    document.getElementById("fileDescription").innerHTML = $title.text();
                }
            }
        };
        var blob = file.slice(start, stop + 1);
        reader.readAsBinaryString(blob);
    }


</script>
<script src="<?php echo base_url('https://code.jquery.com/jquery-1.10.2.js');?>"></script>

<script src="<?php echo base_url('assets/js/bootstrap-timepicker.min.js');?>"></script>

<script>
    $('.datepicker').datepicker({
        format: "yyyy-mm-dd"
    });


    $(document).ready(function () {


        $('input.timepicker').timepicker({
            timeFormat: 'HH:mm:ss'

        });


    });

</script>



