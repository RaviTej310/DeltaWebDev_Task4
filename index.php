<html>
<head>
<title>Task 4</title>
<style>
body {
background-color: #B8B8B8;
}
form { 
margin: 0 auto; 
width:200px;
align: center;
}
input {
margin-bottom: 20px;
margin-top: 8px;
border: 1px solid grey;
height: 25px;
}
.layout {
        width: 300px;
        clear: both;
    }
.layout input {
        width: 100%;
        clear: both;
    }
.error {color: #FF0000;}
</style>
</head>
<body>
<?php
error_reporting( error_reporting() & ~E_DEPRECATED );
$your_nameErr = $emailErr = $passwordErr = $roll_numberErr = $year_of_studyErr = $captchaErr = $departmentErr = "";
$your_name = $email = $password = $roll_number = $department = $year_of_study = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["your_name"])) {
     $your_nameErr = "Name is required";
   } else {
     $your_name = test_input($_POST["your_name"]);
	 $safe_your_name = mysql_real_escape_string($your_name);
   }
   
   if (empty($_POST["email"])) {
     $emailErr = "Email is required";
   } else {
     $email = test_input($_POST["email"]);
	 $safe_email = mysql_real_escape_string($email);
   }
     
   if (empty($_POST["password"])) {
     $passwordErr = "Password is required";
   } else {
     $password = sha1($_POST["password"]);
	 $safe_password = mysql_real_escape_string($password);
   }

   if (empty($_POST["roll_number"])) {
     $roll_numberErr = "Roll number is required";
   } else {
     $roll_number = test_input($_POST["roll_number"]);
	 $safe_roll_number = mysql_real_escape_string($roll_number);
   }

   if (empty($_POST["year_of_study"])) {
     $year_of_studyErr = "Year of study is required";
   } else {
     $year_of_study = test_input($_POST["year_of_study"]);
	 $safe_year_of_study = mysql_real_escape_string($year_of_study);
   }
   if (empty($_POST["department"])) {
     $departmentErr = "Department is required";
   } else {
     $department = test_input($_POST["department"]);
	 $safe_department = mysql_real_escape_string($department);
   }
   if (empty($_POST["captcha"])) {
     $captchaErr = "Captcha is required";
   } 
}

function test_input($data) {
   $data = trim($data);
   $data = htmlspecialchars($data);
   return $data;
}

?>
<br><span class="error">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* Required fields</span><br><br><br>
<div class="layout">
<form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return validateForm()" name="myForm">
Roll number : <span class="error">*<?php echo $roll_numberErr;?></span> <input align="center" type="text" name="roll_number"></input>
Name : <span class="error">*<?php echo $your_nameErr;?></span><input align="center" type="text" name="your_name"></input><br>
Department : <span class="error">*<?php echo $departmentErr;?></span><input align="center" type="text" name="department"></input>
Year of study : <span class="error">*<?php echo $year_of_studyErr;?></span><input align="center" type="text" name="year_of_study"></input><br>
Email : <span class="error">*<?php echo $emailErr;?></span><input align="center" type="text" name="email"></input>
Password : <span class="error">*<?php echo $passwordErr;?></span><input align="center" type="password" name="password" id="password"></input>Click to display password<br><br><input  type="checkbox" onclick="checkbox()" style="margin: 0; padding 0;"></input><br><br>
Photo : <span class="error">*</span><input type="file" name='image' id='image'></input>
<script>
var a=Math.floor(Math.random()*10);
var b=Math.floor(Math.random()*10);
var c=a+b;
document.write(a);document.write("+");document.write(b);document.write("=");
</script><span class="error"> *<?php echo $captchaErr;?></span>
<input type="text" name="captcha" id="captcha"/>
<input align="center" type="submit" name="submit" value="Submit"></input><br>
<form>
</div>
<script>
function checkbox(obj) {
  var obj = document.getElementById('password');
  obj.type = "text";
}
</script>
<script>

function validateForm() {
    var captcha=document.getElementById('captcha').value;
	if (captcha==c ){}
	else 
	{
	    alert("Captcha answer is incorrect. I think you're a robot.");
		return false;
	}
    var x = document.forms["myForm"]["roll_number"].value;
    if (x == null || x == "") {
        alert("Roll number must be filled out");
		return false;
    }
	var x = document.forms["myForm"]["your_name"].value;
    if (x == null || x == "") {
        alert("Name must be filled out");
        return false;
	}
	var x = document.forms["myForm"]["department"].value;
    if (x == null || x == "") {
        alert("Department must be filled out");
		return false;
    }
	var x = document.forms["myForm"]["password"].value;
    if (x == null || x == "") {
        alert("Password must be filled out");
	    return false;
    }
	var x = document.forms["myForm"]["year_of_study"].value;
    if (x == null || x == "") {
        alert("Year of study must be filled out");
		return false;
    }
	var x = document.forms["myForm"]["email"].value;
    if (x == null || x == "") {
        alert("Email must be filled out");
		return false;
    }
	var file = document.getElementById('image');
    if(file.value =="") {
    alert("Please upload an image before submitting")
    return false;
    }
	var filename=document.getElementById('image').value;
    var extension=filename.substr(filename.lastIndexOf('.')+1).toLowerCase();
    if(extension=='jpg' || extension=='gif'|| extension=='png'|| extension=='jpeg') {
        return true;
    } else {
        alert('Not Allowed to upload this type of file! Please upload an image only.');
        return false;
    }
    return false;
}
//I did not provide client side validation for image size because it depends on the search engine API
</script>
<?php
error_reporting( error_reporting() & ~E_NOTICE );
error_reporting( error_reporting() & ~E_WARNING );

$connection = @mysql_connect('localhost', 'root', '') or die (mysql_error());
@mysql_select_db('deltawebdev_task4', $connection) or die (mysql_error());	

generate();
while($sum_next!=0)
{
    generate();
}
$product=0;
for($k=0;$k<9;$k++)
	{
	     $product=($product*10)+$number[$k];
	}

function generate() {
global $number;
$number = array("0","0","0","0","0","0","0","0","0");
$number[0]= mt_rand(1,9);
$number[1]= mt_rand(0,9);
$number[2]= mt_rand(0,9);
$number[3]= mt_rand(0,9);
$number[4]= mt_rand(0,9);
$number[5]= mt_rand(0,9);
$number[6]= mt_rand(0,9);
$number[7]= mt_rand(0,9);
$number[8]= mt_rand(0,9);
for($i=1;$i<8;$i=$i+2) 
{
    $number[$i]=$number[$i]*2;
	if($number[$i]>9)
	{
	     $x=$number[$i]%10;
		 $number[$i]=$number[$i]-$x;
		 $y=$number[$i]/10;
		 $number[$i]=$x+$y;
	}
}
global $sum,$sum_next;
$sum=0;$sum_next=0;

for($j=0;$j<9;$j++)
{
    $sum=$sum+$number[$j];
}
$sum_next=$sum%10;
}

$query = @mysql_query("INSERT INTO accounts (roll_number,your_name,department,year_of_study,email,password,random_number) VALUES ('".$safe_roll_number."','".$safe_your_name."','".$safe_department."','".$safe_year_of_study."','".$safe_email."','".$safe_password."','$product')");

if(isset($_POST['submit']))
{   
    if ($_FILES["image"]["size"] < 1) {
		echo "<script>alert('Please upload an image!');</script>";
	}
	elseif ($_FILES["image"]["size"]/512000 > 1) {
		echo "<script>alert('Please upload an image less than 500KB.');</script>";
	}
	else
	{
	    $image=addslashes($_FILES['image']['tmp_name']);
		$name=addslashes($_FILES['image']['name']);
		$image=file_get_contents($image);
		$image=base64_encode($image);
		saveimage($name,$image);
	}
}
function saveimage($name,$image)
{
   $roll_number=$_POST['roll_number'];
   $connection = @mysql_connect('localhost', 'root', '') or die (mysql_error());
   @mysql_select_db('deltawebdev_task4', $connection) or die (mysql_error());	
   $qry = "UPDATE accounts SET name = '$name', image='$image' WHERE roll_number = '$roll_number' ";
   mysql_query($qry);
   $result=mysql_query($qry);
   if($result)
   {
      echo "<script>alert('Image uploaded.');</script>";
   }
   else
   {
      echo "<script>alert('Image upload failed.');</script>";
   }
}

$roll_number=$_POST['roll_number'];
mkdir($roll_number); 
$target_path = $roll_number."/"; 
$target_path = $target_path . basename( $_FILES['image']['name']); 
if(move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) 
{} 
$filename="$roll_number/index.html"; 
$filehandle=fopen($filename,'w') or die("can't open file"); 
$namef=addslashes($_FILES['image']['name']); 
$strdata="<html><body><br><br><center><img height='300px' width='300px' src='".$namef."'></center></body</html>"; 
fwrite($filehandle,$strdata); 
fclose($filehandle);
?>
</body>

</html>