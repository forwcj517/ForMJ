<html> 
   

    <body>
        <div id="container">
            <h1>How to upload file in Codeigniter</h1>
            <div id="body">

			<code>
			<?php if($upload_data != ''):?>
			<?php var_dump($upload_data);?>

			</code>

			<?php echo $upload_data['full_path'];?>
			

			<?php endif;?>

			<?php echo form_open_multipart('upload_file/upload_it');?>

			<input type="file" name="userfile" size="20" />

			<br /><br />

			<input type="submit" value="upload" />

			</form>

			 </div>
        </div>
    </body>
</html>




