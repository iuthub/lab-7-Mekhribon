<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Validating Forms</title>
		<link href="style.css" type="text/css" rel="stylesheet" />
		<style media="screen">
      		.error {
       			 color: red;
      		}
   		 </style>
	</head>
	
	<body>
	<?php 
		error_reporting(0);
		$name=$_REQUEST["name"];
		$email=$_REQUEST["email"];
		$username=$_REQUEST["username"];
		$password=$_REQUEST["password"];
		$confirmedpassword=$_REQUEST["confirmedpassword"];
		$dateOfBirth=$_REQUEST["dateOfBirth"];
		$gender = isset($_REQUEST["gender"])? $_REQUEST["maritalStatus"] : null;
		$maritalStatus=$_REQUEST["maritalStatus"];
		$address=$_REQUEST["address"];
		$city=$_REQUEST["city"];
		$postalCode=$_REQUEST["postalCode"];
		$homePhone=$_REQUEST["homePhone"];
		$mobilePhone=$_REQUEST["mobilePhone"];	
		$cardNumber=$_REQUEST["cardNumber"];
		$cardExpiryDate=$_REQUEST["cardExpiryDate"];
		$salary=$_REQUEST["salary"];
		$webSite=$_REQUEST["webSite"];
		$gpa=$_REQUEST["gpa"];
		$isPost= $_SERVER["REQUEST_METHOD"]=="POST";
		$isGet = $_SERVER["REQUEST_METHOD"]=="GET";
		$isNameError = $isPost && !preg_match('/([a-zA-Z]){2,}$/i', $name);
		$isEmailError = $isPost && !preg_match('/.+@([a-zA-Z])+\.([a-zA-Z])+$/i', $email);
		$isUsernameError = $isPost && !preg_match('/([a-zA-Z]){5,}$/i', $username);
		$isPasswordError = $isPost && !preg_match('/([a-zA-Z0-9]){8,}$/', $password);
		$isAddressError = $isPost && !preg_match('/^[a-z]+$/i', $address);
		$isCityError = $isPost && !preg_match('/^[a-z]+$/i', $city);
		$isPostalCodeError = $isPost && !preg_match('/^[0-9]{6}$/i', $postalCode);
		$isHomePhoneError = $isPost && !preg_match('/^[0-9]{9}$/i', $homePhone);
		$isMobilePhoneError = $isPost && !preg_match('/^[0-9]{9}$/i', $mobilePhone);
		$isCardNumberError = $isPost && !preg_match('/^[0-9]{16}$/i', $cardNumber);
		$isCardExpiryDateError = $isPost && (!isset($_REQUEST["cardExpiryDate"]) || $_REQUEST["cardExpiryDate"] == "");
		$isSalaryError = $isPost && !preg_match('/([0-9]*[.])?[0-9]+$/i', $salary);
		$isWebSiteError = $isPost && !preg_match('%^(?:(?:https?|ftp)://)(?:\S+(?::\S*)?@|\d{1,3}(?:\.\d{1,3}){3}|(?:(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)(?:\.(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)*(?:\.[a-z\x{00a1}-\x{ffff}]{2,6}))(?::\d+)?(?:[^\s]*)?$%iu', $webSite);
		$isGpaError = $isPost && !preg_match('/([0-9]*[.])?[0-9]+$/i', $gpa);
		$isGenderError = $isPost && (!isset($_REQUEST["gender"]) || $_REQUEST["gender"] == "");
		$isDateOfBirthError = $isPost && (!isset($_REQUEST["dateOfBirth"]) || $_REQUEST["dateOfBirth"] == "");
		if($password == $confirmedpassword){
			$isConfirmedPasswordError = false;
		}else {
			$isConfirmedPasswordError = true;
		}
		$isFormError = $isNameError || $isEmailError || $isUsernameError || $isPasswordError || $isAddressError || $isCityError || $isPostalCodeError || 
		$isHomePhoneError || $isMobilePhoneError || $isCardNumberError || $isCardExpiryDateError || $isSalaryError || $isWebSiteError || $isGpaError || $isConfirmedPasswordError || $isGenderError || $isDateOfBirthError;
	?>
		
		
		<?php if($isGet || $isFormError) { ?>
		<h1>Registration Form</h1>

		<p>
			This form validates user input and then displays "Thank You" page.
		</p>
		
		<hr />
		<h2>Please, fill below fields correctly</h2>
		<form action="index.php" method="post">
		<dl>
			<dt>Name</dt>
			<dd>
				<input type="text" name="name" value="<?= $name ?>"></br>
				<span class = "error"><?= $isNameError?"Please, enter correct name here":"" ?></span>
			</dd>
			<dt>Email</dt>
			<dd>
				<input type="text" name="email" value="<?= $email ?>"></br>
				<span class = "error"><?= $isEmailError?"Please, enter correct email here":"" ?></span>
			</dd>
			<dt>Username</dt>
			<dd>
				<input type="text" name="username" value="<?= $username ?>"></br>
				<span class = "error"><?= $isUsernameError?"Please, enter correct username here":"" ?></span>
			</dd>
			<dt>Password</dt>
			<dd>
				<input type="password" name="password" value="<?= $password ?>"></br>
				<span class = "error"><?= $isPasswordError?"Please, enter correct password here":"" ?></span>
			</dd>
			<dt>Con?rm Password</dt>
			<dd>
				<input type="password" name="confirmedpassword" value="<?= $confirmedpassword ?>"></br>
				<span class = "error"><?= $isConfirmedPasswordError?"Your passwords do not match":"" ?></span>
			</dd>
			<dt>Date of Birth</dt>
			<dd>
			<input type="date" name="dateOfBirth" value="<?= $dateOfBirth ?>"></br>
			<span class = "error"><?= $isDateOfBirthError?"Please, choose date here":"" ?></span>
			</dd>
			<dt>Gender</dt>
			<dd>
				<input type="radio" name = "gender" value = "male"/> Male
				<input type="radio" name = "gender" value = "female"/> Female</br>
				<span class = "error"><?= $isGenderError?"Please, choose gender here":"" ?></span>
			</dd>
			<dt>Marital Status</dt>
			<dd>
			<select name = "maritalStatus" value="<?= $maritalStatus ?>">
					<option value = "single">Single</option>
					<option value = "married">Married</option>
					<option value = "divorced">Divorced</option>
					<option value = "widowed">Widowed</option>
				 </select>
			</dd>
			<dt>Address</dt>
			<dd>
			<input type="text" name="address" value="<?= $address ?>"></br>
				<span class = "error"><?= $isAddressError?"Please, enter correct address here":"" ?></span>
			</dd>
			<dt>City</dt>
			<dd>
				<input type="text" name="city" value="<?= $city ?>"></br>
				<span class = "error"><?= $isCityError?"Please, enter correct city here":"" ?></span>
			</dd>
			<dt>Postal Code</dt>
			<dd>
				<input type="text" name="postalCode" value="<?= $postalCode ?>"></br>
				<span class="error"><?= $isPostalCodeError?"Please, enter correct postal code here":"" ?></span>
			</dd>
			<dt>Home Phone</dt>
			<dd>
				<input type="text" name="homePhone" value="<?= $homePhone ?>"></br>
				<span class = "error"><?= $isHomePhoneError?"Please, enter correct home phone here":"" ?></span>
			</dd>
			<dt>Mobile Phone</dt>
			<dd>
				<input type="text" name="mobilePhone" value="<?= $mobilePhone ?>"></br>
				<span class = "error"><?= $isMobilePhoneError?"Please, enter correct mobile phone here":"" ?></span>
			</dd>
			<dt>Credit Card Number</dt>
			<dd>
				<input type="text" name="cardNumber" value="<?= $cardNumber ?>"></br>
				<span class = "error"><?= $isCardNumberError?"Please, enter correct card number here":"" ?></span>
			</dd>
			<dt>Credit Card Expiry Date</dt>
			<dd>
				<input type="date" name="cardExpiryDate" value="<?= $cardExpiryDate ?>"></br>
				<span class = "error"><?= $isCardExpiryDateError?"Please, enter correct card expiry date here":"" ?></span>
			</dd>
			<dt>Monthly Salary</dt>
			<dd>
				<input type="text" name="salary" value="<?= $salary ?>"></br>
				<span class = "error"><?= $isSalaryError?"Please, enter correct salary here":"" ?></span>
			</dd>
			<dt>Web Site URL</dt>
			<dd>
				<input type="text" name="webSite" value="<?= $webSite ?>"></br>
				<span class = "error"><?= $isWebSiteError?"Please, enter correct website here":"" ?></span>
			</dd>
			<dt>Overall GPA</dt>
			<dd>
				<input type="text" name="gpa" value="<?= $gpa ?>"></br>
				<span class = "error"><?= $isGpaError?"Please, enter correct gpa here":"" ?></span>
			</dd>
		</dl>
		
		<div>
			<input type="submit" value="Register">
		</div>
		</form>
		<?php } else { ?>
          <h1>Thank you for your submission.</h1>
    	<?php } ?>
	</body>
</html>