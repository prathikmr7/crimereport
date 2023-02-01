<!DOCTYPE html>
<html>
<head>
    
    <?php
    session_start();
    if(!isset($_SESSION['x']))
        header("location:inchargelogin.php");
    
    $conn=mysqli_connect("localhost","root","","crime_portal");
    if(!$conn)
    {
        die("could not connect".mysqli_error());
    }
    $db_select = mysqli_select_db($conn,"crime_portal");
    
    $cid=$_SESSION['cid'];
        
    $i_id=$_SESSION['email'];
    $result1=mysqli_query("SELECT location FROM police_station where i_id='$i_id'",$conn);
      
    $q2=mysqli_fetch_assoc($result1);
    $location=$q2['location'];
    
    $query="select c_id,type_crime,d_o_c,description from complaint where c_id='$cid' and location='$location'";
    $result=mysqli_query($query,$conn); 
    if(isset($_POST['assign']))
    {
      if($_SERVER["REQUEST_METHOD"]=="POST")
      {
        $pname=$_POST['police_name'];
        $res1=mysqli_query("SELECT p_id FROM police where p_name='$pname'",$conn);
        $q3=mysqli_fetch_assoc($res1);
        $pid=$q3['p_id'];
      
      
        $res=mysqli_query("update complaint set inc_status='Assigned',pol_status='In Process',p_id='$pid' where c_id='$cid'",$conn);
      
        $message = "Case Assigned Successfully";
        echo "<script type='text/javascript'>alert('$message');</script>";
      }
    }
    ?>

</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="home.php"><b>Crime Portal</b></a>
   
      
        <li><a href="inc_logout.php">Logout &nbsp <i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
      </ul>
    </div>
  </div>
 </nav>
    
    

    
<div style="padding:50px; margin-top:10px;">
   <table class="table table-bordered">
    <thead class="thead-dark" style="background-color: black; color: white;">
    <tr>
      <th scope="col">Complaint Id</th>
      <th scope="col">Type of Crime</th>
      <th scope="col">Date of Crime</th>
      <th scope="col">Description</th>
    </tr>
       </thead>
      <?php
              while($rows=mysqli_fetch_assoc($result)){
             ?> 
       <tbody style="background-color: white; color: black;">
    <tr>
        
      <td><?php echo $rows['c_id']; ?></td>
      <td><?php echo $rows['type_crime']; ?></td>
      <td><?php echo $rows['d_o_c']; ?></td>
      <td><?php echo $rows['description']; ?></td>
        
        
    </tr>
       </tbody>
       <?php
} 
?>
          
          <title>Complaint History</title>
    
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

   <script>
    function f1()
       {
         
           var sta2=document.getElementById("ciid").value;
           var x2=sta2.indexOf(' ');
 
           if(sta2!="" && x2>=0)
           {
                 document.getElementById("ciid").value="";
                 alert("Space Not Allowed");
           }
       }
   </script>
 
<div style="position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   height: 30px;
   background-color: rgba(0,0,0,0.8);
   color: white;
   text-align: center;">
  <h4 style="color: white;">&copy <b>Crime Portal 2018</b></h4>
</div>
 <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
 <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>