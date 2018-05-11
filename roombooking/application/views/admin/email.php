
<!DOCTYPE html>
<html lang="en">

    <body>



        <div class="contact email">
            <div class="container">
          
<div class="row">
    <div class="col-sm-12">
        <!-- Start Form -->
        <div class="border_con">
            <h3>Email Content</h3>

            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <h6>from</h6>
                            <input type="text" class="form-control" style="height:45px" placeholder="Surf You to the Moon" onkeyup="$('#headingtext').text(this.value);">
                        </div>
                        <div class="form-group">
                            <h6>from email</h6>
                            <input type="text" class="form-control" style="height:45px" placeholder="reservations@surfyoutothemoon.com" onkeyup="$('#emailtext').text(this.value);">
                        </div>
                        <div class="form-group">
                            <h6>Subject</h6>
                            <input type="text" onkeyup="$('#subjecttext').text(this.value);" class="form-control" style="height:45px" placeholder="Subject">
                        </div>
                        <div class="form-group">
                            <h6>Body</h6>
                            <textarea class="form-control"  name="editor1" required   maxlength="50">
                                    <p>Hi <span>{{first_name}}</span>!</p>
                                            <p>We are super excited to have you join us! We have you for <span>{{count}}</span> for <span>{{activity}}</span> on <span>{{date}}</span>! We're glad you came out to see us and look forward to meeting you! <span>{{contactphone}}</span></p>
                                            <p><span>{{contactphone}}</span> If you haven't already, please electronically approve the waiver before your tour here:</p>
                                            <p><span>{{waiver_urls}}</span></p>
                                            <p>Below are some details about your activity:</p>
                            </textarea>


                        </div>

                    </div>
                    
                    
                    <div class="col-sm-6" style="margin-top: 37px;" id="content">
                        <div class="right">
                            <div class="bg_right">
                                <p><b id="headingtext">Surf You to the Moon</b></p>
                                <p><b id="emailtext">reservations@surfyoutothemoon.com</b></p>
                                <p id="subjecttext">Congratulations Your activity, <span>{{activity}}</span> for <span>{{count}}</span> on <span>{{date}}</span> is approved!</p>
                            </div>
                            
                            <div class="right_inner">
                                <img src="<?php echo base_url('images/login.png')?> " class="img-responsive" width="100px">
                                <div id="bodytext">
                                    <p>Hi <span>first_name</span>!</p>
                                    <p>We are super excited to have you join us! We have you for <span>{{count}}</span> for <span>{{activity}}</span> on <span>date</span>! We're glad you came out to see us and look forward to meeting you! <span>contactphone</span></p>
                                    <p><span>{{contactphone}}</span> If you haven't already, please electronically approve the waiver before your tour here:</p>
                                    <p><span>{{waiver_urls}}</span></p>
                                    <p>Below are some details about your activity:</p>
                                </div>

                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    
                    <div class="clearfix"></div>
                    <div class="form-group col-sm-12 confirm" style="text-align:center;">
                        <div class="col-md-6">
                            
                        </div>
                        <div class="col-md-6">
                            <button style="margin-top: 24px;" type="button" onclick="calls();" class="btn-red waves-effect waves-light btn-lg">Preview</button>
                            <button style="margin-top: 24px; margin-left: 20px;" type="button" onclick="save();" class="btn-red waves-effect waves-light btn-lg">Save</button>
                        </div>
                        
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
        $(function () {
            CKEDITOR.replace('editor1');
            $(".textarea").wysihtml5();
        });
        function calls()
        {
            var dataa = CKEDITOR.instances.editor1.getData();

            $("#bodytext").html(dataa);
        }
        
        
        var first = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'
                    + '<html xmlns="http://www.w3.org/1999/xhtml">'
                    + '<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>Email</title>'
                    + '<style type="text/css">body {margin: 0; padding: 0; min-width: 100%!important;}.content {width: 100%; max-width: 600px;} '
                    + '</style></head>    <body yahoo bgcolor="#f6f8f1"><table class="content" align="center"  width="100%" bgcolor="#f6f8f1" border="0" cellpadding="0" cellspacing="0"><tr><td>';
        
        var second = '</td></tr></table></body></html>';


        function save(){            
            
            
            var htmlString = $("#content").html();   
            from = $("#headingtext").text();
            from_email = $("#emailtext").text();
            subject = $("#subjecttext").text();
            body = first + htmlString + second;     
            
            ajaxSave();
            
        }
        
        var from;
        var from_email;
        var subject;
        var body;
    function ajaxSave() { 
        
        jQuery.ajax({
            type: "POST",
            url: "<?php echo site_url('user/saveEmail'); ?>",
            dataType: 'json',
            data: {from: from, from_email: from_email, subject: subject , body: body},
            success: function (data) {
                if (data)
                {
                    var res = data.result;
                    alert(res);
                }
            }
        });
    }    
    

</script>


<!-- copyright-->
</div>

</body>
</html>
