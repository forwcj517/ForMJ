
<body onload="updateSize();">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title" >
                        <i class="entypo-plus-circled"></i>
                        <?php echo get_phrase('add_promocode'); ?>
                    </div>
                </div>
                <div class="panel-body">



                    <?php echo form_open_multipart('admin/basic_promocode/create', array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => "multipart/form-data")); ?>



                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('title'); ?></label>										
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id = "title" name="title" value="" required autofocus >
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('price'); ?></label>										
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id = "price" name="price" value="" required autofocus >
                        </div>
                    </div>
                                                                         
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('discount'); ?></label>										
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id = "discount" name="discount" value="" required autofocus >
                        </div>
                    </div>
                    

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('add_promo_code'); ?></button>
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




