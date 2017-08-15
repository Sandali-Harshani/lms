<?php



if(isset($_POST['upload'])){
   
    //$target="uploads/".basename($_FILES['myfile']['name']);

   
    //data base connection
    $db=@mysqli_connect("localhost", "root", "", "folder");
    
    //get all submitted data from the form
   
    $name=$_FILES['myfile']['name'];
    $tmp_name=$_FILES["myfile"]["tmp_name"];
     $id=$_POST['Mid'];
    $text=$_POST['text'];
    
     $target="uploads/$name";
    $sql="INSERT INTO document(id,name,paths)VALUES('$id','$text','$target')";
   
    mysqli_query($db,$sql);
    
    
    if(move_uploaded_file($_FILES['myfile']['tmp_name'],$target)){
        
        $img="Upload file is success!";
        echo $img;
        
        
    }else{
        
         $img="Upload file is  Not success!";
          echo $img;
        
        
    }
    
}

?>


<?php
$db=@mysqli_connect("localhost","root","","folder");
 $sql="SELECT * FROM  document ORDER BY id ASC ";
  $result=mysqli_query($db,$sql);

?>




<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel</title>
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <link rel="stylesheet" type="text/css" href="admincss.css">
     



</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Zobrazit navigaci</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">NSBM Learning Management System (LMS)</a>
    </div>

    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#"><span class="glyphicon glyphicon-comment"></span> </a></li>
        <li ><a href="#"><span class="glyphicon glyphicon-book"></span></a></li>
        <li ><a href="#"><span class="glyphicon glyphicon-floppy-disk"></span></a></li>
        <li ><a href="#"><span class="glyphicon glyphicon-info-sign"></span> </a></li>
      </ul>
       <div class="nav navbar-right">
        <button type="button" class="btn btn-danger navbar-btn dropdown-toggle button-login" data-toggle="dropdown">Logout</button>
       </div>
    </div><!--/.nav-collapse -->
  </div>
</div>
 <br><br><br><br>





<div class="container">
    <div class="page-header">
         <marquee> <h1>Admin Panel</h1></marquee>
    </div>
</div>

<center>
	<form method="POST" action="admin.php"  enctype="multipart/form-data">

       
        <div class="input-group">
			<label>Module ID</label>
			<input type="text" name="Mid" value="">
		</div>
		<div class="input-group">
			<label>Module Name</label>
			<input type="text" name="text" value="">
		</div>
		
        <input type="hidden" name="size" value="1000000" class="choose" >
        
        <div>
        
        <input type="file" name="myfile" class="nofile">
              
        </div>
        
        <div>
        

      <!--  <textarea name="text" cols="40" rows="4" placeholder="say somthing.....">   </textarea>-->
       <!-- <textarea name="text"  class="form" rows="3" placeholder="say somthing....." cols="40"></textarea>-->
        </div>
        
        <div>
          <input type="submit" name="upload" value="Upload File" class="btn btn-primary" style="margin-top: 10px;">
        
        </div>
        
    </form>
   
</center><br><br>






<div class="container">
<div class="panel panel-default">
    <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>Module Code</th>
              <th>Name</th>
              <th>Delete OR Update</th>
            </tr>
          </thead>
          <tbody>

             <?php 
                while ($row=mysqli_fetch_array($result)) 

                	
                {  
               ?>

               <tr>
              <td><?php  echo $row['id']  ?></td>
              <td><?php echo $row['name']?></td>
              <td>
                <button type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-edit"></span> Update</button>
                <a class="del_btn" href="deletefile.php?del=<?php echo $row['id'];?>"><button type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove-circle"></span> Delete</button>
              </td>
          


             <?php
               }
             ?>


           
          </tbody>
        </table>
        </div>
</div>

<div class="container">
  <!-- FOOTER -->
  <footer>
  
  </footer>

</div><!-- /.container -->

</body>
</html>