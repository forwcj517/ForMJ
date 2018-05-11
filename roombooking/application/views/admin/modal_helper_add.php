
<body onload="updateSize();">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title" >
                        <i class="entypo-plus-circled"></i>
                        <?php echo get_phrase('add_helper'); ?>
                    </div>
                </div>
                <div class="panel-body">





                    <?php echo form_open_multipart('admin/manager_customer/create', array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => "multipart/form-data")); ?>




                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name'); ?></label>										
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id = "name" name="name" value="" required autofocus >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('surname'); ?></label>										
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id = "surname" name="surname" value="" required autofocus >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('sex'); ?></label>
                        <div class="col-sm-5">

                            <select id="sex" name="sex" class="form-control" required data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" autofocus>											
                                <option value="0" selected > Female </option>
                                <option value="1" > Male</option>																										
                            </select>
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email'); ?></label>										
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id = "email" name="email" value="" required autofocus >
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('street'); ?></label>										
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id = "address" name="address" value="" required autofocus >
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('code'); ?></label>										
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id = "code" name="code" value="" required autofocus >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('city'); ?></label>										
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id = "city" name="city" value="" required autofocus >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('country'); ?></label>										
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id = "country" name="country" value="" required autofocus >
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('select salary'); ?></label>
                        <div class="col-sm-5">

                            <select id="salary" name="salary" class="form-control" required data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" autofocus>											
                                <?php
                                $semesters = $this->db->get_where('salary', array('company' => $this->session->userdata('admin_id')))->result_array();
                                foreach ($semesters as $row1):
                                    ?>
                                    <option value="<?php echo $row1['id']; ?>" selected >
                                    <?php echo $row1['name']; ?>
                                    </option>
<?php endforeach; ?>
                            </select>
                        </div>
                    </div>




                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('start_date'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" class="form-control datepicker" name="startdate" value="<?= $row['startdate']; ?>" required data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="" autofocus>
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('end_dat'); ?></label>										
                        <div class="col-sm-5">
                            <input type="text" class="form-control datepicker" name="enddate" value="<?= $row['enddate']; ?>" required data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="" autofocus>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('active'); ?></label>
                        <div class="col-sm-5">

                            <select id="agree" name="agree" class="form-control" required data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" autofocus>											
                                <option value="0" selected > Deactive </option>
                                <option value="1" > Active </option>																										
                            </select>
                        </div>
                    </div>





                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('select group'); ?></label>
                        <div class="col-sm-5">

                            <select id="parentId" name="parentId" class="form-control" required data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" autofocus>

                                <?php
                                $semesters = $this->db->get_where('usertable', array('user_type' => 2, 'company' => $this->session->userdata('admin_id')))->result_array();
                                foreach ($semesters as $row1):
                                    ?>
                                    <option value="<?php echo $row1['no']; ?>" selected >
                                    <?php echo $row1['name']; ?>
                                    </option>
<?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <!-- <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>											
                            <div class="col-sm-5">
                            
                                    <textarea type = "text" class = "form-control" id="fileDescription" name="epg_descr" cols="40" rows="5"  required autofocus READONLY></textarea>
                            </div>
                    </div>
                    
                                                                                               <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('logo'); ?></label>			
                            <div class=" col-sm-5">
                                    <input type="file" name="userlogo" size="20" / READONLY>
                            
                            </div>
                    </div>
                    
                    
                    
                    <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('file path'); ?></label>			
                            <div class=" col-sm-5">
                                    <input type="file" name="userfile" id="uploadInput" onchange="updateSize();" size="20" />
                            
                            </div>
                    </div>
                    
                    <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('album'); ?></label>										
                            <div class="col-sm-5">
                                    <input type="text" class="form-control" name="album" value="<?php echo $param2; ?>" READONLY>
                            </div>
                    </div> -->

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('add_helper'); ?></button>
                        </div>
                    </div>



                    </form>




                </div>
            </div>
        </div>
    </div>
</body>


<script>
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
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>



<script src="assets/js/bootstrap-datepicker.js"></script>
<script>
    $('.datepicker').datepicker({
        format: "yyyy-mm-dd"
    });
</script>




