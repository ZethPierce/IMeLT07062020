<?php
session_start();
include('connection.php');
include('tags.php');
include('admin_sidebar.php');
$id=$_GET["id"];

if(isset($_POST['updatedata'])){ 
		$module_id = $_POST['module_id'];
        $module_num = $_POST['module_num'];
        $module_name = $_POST['module_name'];
        $lesson_num = $_POST['lesson_num'];
        $lesson_name = $_POST['lesson_name'];
        $lesson_header = $_POST['lesson_header'];
        $lesson_image = $_POST['lesson_image'];
        $lesson_figure = $_POST['lesson_figure'];
        $lesson_figure_title = $_POST['lesson_figure_title'];
        $lesson_body = $_POST['lesson_body'];

 		$query = mysqli_query($conn, "UPDATE tbl_module_lessons 
        	SET
        	module_id='$module_id',
        	module_num='$module_num', 
        	module_name='$module_name', 
        	lesson_num='$lesson_num',
        	lesson_name='$lesson_name', 
        	lesson_header='$lesson_header', 
        	lesson_image='$lesson_image', 
        	lesson_figure='$lesson_figure', 
        	lesson_figure_title='$lesson_figure_title',
        	lesson_body='$lesson_body'
        	WHERE 
        	general_id=$id");
				 if($query){
					header('Location: admin_managemodules.php');
				}
}

$res = mysqli_query($conn, "SELECT * FROM tbl_module_lessons WHERE general_id=$id");



?>

<!DOCTYPE html>
<html>
<head>
	<title>ImeLT</title>
	<link rel="stylesheet" type="text/css" href="assets/css/login.css">
</head>
<body>
	<div class="container">
		<div class="row padding-compress" style="margin-top: 20px;">
			<div class="lineBorder mx-auto" >
			<?php 
			while($row = mysqli_fetch_array($res)){
			?>
			<form action="" method="post" enctype="multipart/form-data">
				<input type="hidden" id="general_id" name="general_id">
			 <div class="form-group">
	            <label for="module_num">Module ID</label>
	            <input type="text" id="module_id" name="module_id" value="<?php echo $row['module_id']; ?>" class="form-control">
	          </div>

          <div class="form-group">
            <label for="module_num">Module Number</label>
            <input type="text" id="module_num" name="module_num" class="form-control" value='<?php echo $row["module_num"]; ?>'>
          </div>

          <div class="form-group">
            <label for="module_num">Module Name</label>
            <textarea type="text"  name="module_name" class="form-control" value='<?php echo $row["module_name"]; ?>'><?php echo $row["module_name"]; ?></textarea>
          </div>

          <div class="form-group">
            <label for="module_num">Lesson Number</label>
            <input type="text" id="lesson_num" name="lesson_num" class="form-control" value='<?php echo $row["lesson_num"]; ?>'>
          </div>

          <div class="form-group">
            <label for="module_num">Lesson Name</label>
            <input type="text" id="lesson_name" name="lesson_name" class="form-control" value='<?php echo $row["lesson_name"]; ?>'>
          </div>

          <div class="form-group">
            <label for="module_num">Lesson Header</label>
            <textarea type="text" id="lesson_header" name="lesson_header" onclick="textAreaAdjust(this)" class="form-control h-50" value='<?php echo $row["lesson_header"]; ?>'><?php echo $row["lesson_header"]; ?></textarea>
          </div>
          
          <div class="form-group">
            <label for="module_num">Lesson Images</label>
            <img src='assets/img/lessons/<?php echo $row["lesson_image"]; ?>' 
            id="imgPreview" class="form-control img-fluid" 
            value='<?php echo $row["lesson_image"]; ?>'>
<!-- 			 <label for="img">Image</label>
              <div class="custom-file">
                  <input type="file" class="custom-file-input form-control" name="img" value="<?php echo $row['lesson_image']; ?>"   name="lesson_image">
                  <label class="custom-file-label" for="img" id="imgLabel">Choose file</label>
              </div> -->
              <input type="text" id="lesson_image" name="lesson_image" class="form-control" value='<?php echo $row["lesson_image"]; ?>'>
          </div>

          <div class="form-group">
            <label for="module_num">Lesson Figures</label>
            <input type="text" id="lesson_figure" name="lesson_figure" class="form-control" value='<?php echo $row["lesson_figure"]; ?>'>
          </div>

          <div class="form-group">
            <label for="module_num">Lesson Figure Title</label>
            <input type="text" id="lesson_figure_title" value='<?php echo $row["lesson_figure_title"]; ?>' name="lesson_figure_title" class="form-control">
            
          </div>
          
          <div class="form-group">
            <label for="module_num">Lesson Body</label>
            <textarea id="lesson_body" name="lesson_body" class="form-control" onclick="textAreaAdjust(this)" value='<?php echo $row["lesson_body"]; ?>' id="lesson_body"><?php echo $row["lesson_body"]; ?></textarea>
          </div>

      <?php } ?>
      	<div class="text-right">
            
        	<button type="button" class="btn btn-default" style="margin-bottom: 15px;"  data-dismiss="modal">Close</button>
        	
        	<input type="submit" name="updatedata" style="margin-bottom: 15px;" class="btn btn-primary">
        </form>
     	</div>
		</div>
	</div>
</div>
</body>
</html>
<script>
	$('input[type="file"]'). change(function(e){
    fileName = e. target. files[0]. name;
    $('#imgLabel').text(fileName);
    $('#imgPreview').attr('src','assets/img/lessons/'+fileName);
});


function textAreaAdjust(o) {
  o.style.height = "1px";
  o.style.height = (25+o.scrollHeight)+"px";
}
</script>