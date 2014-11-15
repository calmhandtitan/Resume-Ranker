<?php
	include 'connect.inc.php';	
	include "header.html";
?>

<html>
	<head>
		<title>Resume Ranker</title>
		<meta content="author" name="rishabh and chandan">
		<link href="css/style.css" type="text/css" rel="stylesheet">
		<link href="css/style2.css" type="text/css" rel="stylesheet">
		<link href="css/demo2.css" type="text/css" rel="stylesheet">
		        <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />

		<link href="css/animate-custom.css" type="text/css" rel="stylesheet">
		<script src="js/modernizr.custom.63321.js"></script>
	</head>
	
	<body>
		<div id="wrapper_body"  height="auto">
			<table id="content"  >
				<tr>
					<td width="850" style="vertical-align:top;padding-right:20px;">
						<div class="simple">
							<h3>About us</h3>
								<p>Resume Ranker is a website meant for ranking resumes. In the competitive ethos of the technical world, it is always an added
								advantage to know where you stand and where you lack. To simplify things for the technocrats, we came up with the concept of 
								Resume Ranker. Also, from the recruiter point of view, the site serves as a gateway to speed-up shortlisting from a pool of 
								hundreds of candidates.</p>
							<hr>
							<h3>How do we rank?</h3>
								<p>The ranking system is based on a set of dynamic statistical estimators. First, a recruiter fills up its priorities and assigns
								each possible bullet of a CV a particular weight. Now, based on the recruiter's demands, the system generates a formula on which all 
								the CV's can be ranked. Thus, the same CV may have different ranks based on the choice of recruiter.</p>
						</div>
								
						
						
					</td>
					<td width="350">
				
				<section>				
                <div id="container_demo" >
                    <!-- hidden anchor to stop jump http://www.css3create.com/Astuce-Empecher-le-scroll-avec-l-utilisation-de-target#wrap4  -->
                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <div id="wrapper">
                        <div id="login" class="animate form">
                            <form  action="hello.php" autocomplete="on" method = "POST"> 
                                <h1>Log in</h1> 
                                <p> 
                                    <label for="username" class="uname" data-icon="u" > Your email or username </label>
                                    <input id="username" name="username" required="required" type="text" placeholder="myusername or mymail@mail.com"/>
                                </p>
                                <p> 
                                    <label for="password" class="youpasswd" data-icon="p"> Your password </label>
                                    <input id="password" name="password" required="required" type="password" placeholder="eg. X8df!90EO" /> 
                                </p>
								
                                <p class="keeplogin"> 
									<input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" /> 
									<label for="loginkeeping">Keep me logged in</label>
								</p>
								<p style="text-align:right;">
									<label for="logintype">Login As:</label>
									<select id="logintype" name="logintype" >
									<option value="student">Student</option>
									<option value="recruiter">Recruiter</option>
									</select>
									
								</p>
                                <p class="login button"> 
                                    <input type="submit" name="login" value="Login" /> 
								</p>
                                <p class="change_link">
									Not a member yet ?
									<a href="#toregister" class="to_register">Join us</a>
								</p>
                            </form>
                        </div>

                        <div id="register" class="animate form">
                            <form  action="hello.php" autocomplete="on" method = "POST"> 
                                <h1> Sign up </h1> 
                                <p> 
                                    <label for="usernamesignup" class="uname" data-icon="u">Your username</label>
                                    <input id="usernamesignup" name="usernamesignup" required="required" type="text" placeholder="mysuperusername690" />
                                </p>
                                <p> 
                                    <label for="emailsignup" class="youmail" data-icon="e" > Your email</label>
                                    <input id="emailsignup" name="emailsignup" required="required" type="email" placeholder="mysupermail@mail.com"/> 
                                </p>
                                <p> 
                                    <label for="passwordsignup" class="youpasswd" data-icon="p">Your password </label>
                                    <input id="passwordsignup" name="passwordsignup" required="required" type="password" placeholder="eg. X8df!90EO"/>
                                </p>
                                <p> 
                                    <label for="passwordsignup_confirm" class="youpasswd" data-icon="p">Please confirm your password </label>
                                    <input id="passwordsignup_confirm" name="passwordsignup_confirm" required="required" type="password" placeholder="eg. X8df!90EO"/>
                                </p>
								<p style="text-align:right;">
									<label for="signuptype">Signup As:</label>
									<select id="signuptype" name="signuptype" >
									<option value="student">Student</option>
									<option value="recruiter">Recruiter</option>
									</select>
									
								</p>
                                <p class="signin button"> 
									<input type="submit"  name="Signup" value="Signup"/> 
								</p>
                                <p class="change_link">  
									Already a member ?
									<a href="#tologin" class="to_register"> Go and log in </a>
								</p>
                            </form>
                        </div>
						
                    </div>
                </div>  
            </section>
				</td>
			</tr>
		</table>
		</div>
	
<?php
	if(isset($_POST['Signup'])) //if user cicked on sign up
	{
		$username = "'".$_POST['usernamesignup']."'";

		$password = $_POST['passwordsignup'];
		$password_hash = md5($password);
		$password_hash = "'".$password_hash."'";

		$email = "'".$_POST['emailsignup']."'";
		$signuptype = $_POST['signuptype'];

		
//		echo $signuptype;
//		echo $username.' '.$password_hash.' '.$email.'<br>';
		
		$sid = 0;
		$orgid = 0;
		if($signuptype=='student')
		{
//			echo "querying student login";
			$qry = "SELECT MAX(SID) as max_sid FROM STUDENT_LOGIN";
			$result = mysql_query($qry);
			while($row = mysql_fetch_assoc($result))
			{
				$sid = $row['max_sid'];
			}
			$sid += 1;	//initializing session variable

			$qry = "INSERT INTO student_login(USERNAME,PASSWORD,EMAIL, SID) 
					VALUES($username, $password_hash, $email, $sid)";
			$q = "INSERT INTO STUDENT(SID) VALUES($sid)";
				
		}
		else
		{	
//			echo "querying recruiter login";
			$qry = "SELECT MAX(ORG_ID) as max_of_organisation FROM RECRUITER_LOGIN";
			$result = mysql_query($qry);
			while($row = mysql_fetch_assoc($result))
			{
				$orgid = $row['max_of_organisation'];
			}
			$orgid += 1;

//			echo $orgid.'<br>';

			$qry = "INSERT INTO recruiter_login
					(USERNAME,PASSWORD,EMAIL,ORG_ID)
					VALUES($username, $password_hash, $email, $orgid)";
			$q = "INSERT INTO ORGANISATION(ORG_ID) VALUES($orgid)";
		}
		$result = mysql_query($qry);
		$res1 = mysql_query($q);
		
		if($result == FALSE || $res1 == FALSE)	//if sign up failed
		{
//			echo "error";
			echo mysql_error();
		}
		else //if sign up successfull
		{
			//you have been logged in, create session variable each different for student/recruiter
			if($signuptype=='student')
			{
				$_SESSION['SID'] = $sid;
				$_SESSION['sender_page'] = 'hello.php';
//				echo "adding Student session ".$_SESSION['SID'].'<br>';
				header("Location: stu_profile.php");
			}
			else
			{
				$_SESSION['ORGID'] = $orgid;
				$_SESSION['sender_page'] = 'hello.php';
//				echo "adding rec session ".$_SESSION['ORGID'].'<br>';
				header("Location: org_profile.php");	
			}
			
		}		
		
	}
	else
	if(isset($_POST['login']))	//if user clicked on log in
	{
		//Collect POST values
		$username = "'".$_POST['username']."'";
		$password = "'".md5($_POST['password'])."'";
		$logintype = $_POST['logintype'];

		if($logintype == 'student')
		{
			$qry = "SELECT * FROM student_login WHERE USERNAME = $username AND PASSWORD = $password";
		}
		else
		{
			$qry = "SELECT * FROM recruiter_login WHERE USERNAME = $username AND PASSWORD = $password";
		}
		
		//Execute query
		$result=mysql_query($qry);
		//Check whether the query was successful or not 
		if($result == TRUE)
		{
			$count = mysql_num_rows($result);
//			echo $count;
			//if $count == 1 --> 1 row matched for entered username and password
			//else wrong username or password
		}
		else
		{
			echo mysql_error();
			//Login failed
			?>
				<script type="text/javascript">
					alert("Incorrect Username or Password !!! Please Try again!");
				</script>
			<?php
			
			header("Location: hello.php");
			exit();
		}
		if( $count == 1)
		{
			//Login successful set session variables and redirect to main page.
			session_start();
			$_SESSION['IS_AUTHENTICATED'] = 1;
			$_SESSION['sender_page'] = 'hello.php';
			
			if($logintype=='student')
			{
				$query = "SELECT SID FROM STUDENT_LOGIN WHERE USERNAME = $username";
				$result = mysql_query($query);
				while($row = mysql_fetch_assoc($result))
				{
					$sid = $row['SID'];
				}

//				echo "setting student session to ".$sid.'<br>';
				$_SESSION['SID'] = $sid;

				header('location: stu_dash.php');
			}
			else if($logintype=='recruiter')
			{
				$query = "SELECT ORG_ID FROM RECRUITER_LOGIN WHERE USERNAME = $username";
				$result = mysql_query($query);
				while($row = mysql_fetch_assoc($result))
				{
					$orgid = $row['ORG_ID'];
				}

//				echo "setting recruiter session to ".$orgid.'<br>';
				$_SESSION['ORG_ID'] = $orgid;
				header('location: org_dash.php');
			}
		}
		else
		{
			//Login failed 
			?>
				<script type="text/javascript">
					alert("Incorrect Username or Password !!! Please Try again!");
				</script>
			<?php

			header("Location: hello.php");
			exit();
		}
	}	
	
 ?>