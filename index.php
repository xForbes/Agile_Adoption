<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Agile Adoption</title>
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <header>
            <h1 class="logo"><a href="index.php">Agile Adoption</a></h1>
            <nav">
                <ul class="navList">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="contact_us.html">Contact Us</a></li>
                    <li><a href="wish_list.php">My Wish List</a></li>
                    <li><a href="find_pet.php">Find Pet</a></li>                 
                </ul>
            </nav>
        </header>
        <main>

            <h2 class="main-header">Welcome!</h2>

<?php
	include 'db_connections.php';
	$pet_conn = OpenPetConn();
	$petTable = "`table 2`";
	$shelterTable = "`table 1`";
	
	if (isset($_POST['gender']) or isset($_POST['dog']) or isset($_POST['cat']) or isset($_POST['age'])or isset($_POST['vaccination'])or isset($_POST['kids'])or isset($_POST['house'])or isset($_POST['neutered'])or isset($_POST['shelter'])){
		$gender = $_POST["gender"];
		$dog = $_POST["dog"];
		$cat = $_POST["cat"];
		$age = $_POST["age"];
		$vaccination = $_POST["vaccination"];
		$kids = $_POST["kids"];
		$house = $_POST["house"];
		$neutered = $_POST["neutered"];
		$shelterID = $_POST["shelter"];
	}
	else{
		$gender = "";
		$dog = "";
		$cat = "";
		$age = "";
		$vaccination = "";
		$kids = "";
		$house = "";
		$neutered = "";
		$shelterID = "";
	}
	$attCount = 0;
	if ($gender != ""){
		$statment1 = " WHERE GENDER = '" . $gender ."'";
		$attCount++;
	}
	else{
		$statment1 = "";
	}
	if ($age != ""){
		if ($attCount > 0){
			$statment2 = " AND AGE = '" . $age ."'";
		}
		else{
			$statment2 = " WHERE AGE = '" . $age ."'";
			$attCount++;
		}
	}
	else{
		$statment2 = "";
	}
	if ($vaccination != ""){
		if ($attCount > 0){
			$statment3 = " AND VACCINES = '" . $vaccination ."'";
		}
		else{
			$statment3 = " WHERE VACCINES = '" . $vaccination ."'";
			$attCount++;
		}
	}
	else{
		$statment3 = "";
	}
	if ($kids != ""){
		if ($attCount > 0){
			$statment4 = " AND KIDS = '" . $kids ."'";
		}
		else{
			$statment4 = " WHERE KIDS = '" . $kids ."'";
		}
	}
	else{
		$statment4 = "";
	}
	if ($house != ""){
		if ($attCount > 0){
			$statment5 = " AND HOUSETRAIN = '" . $house ."'";
		}
		else{
			$statment5 = " WHERE HOUSETRAIN = '" . $house ."'";
		}
	}
	else{
		$statment5 = "";
	}
	if ($neutered != ""){
		if ($attCount > 0){
			$statment6 = " AND NEUTERED = '" . $neutered ."'";
		}
		else{
			$statment6 = " WHERE NEUTERED = '" . $neutered ."'";
		}
	}
	else{
		$statment6 = "";
	}
	if ($shelterID != ""){
		if ($attCount > 0){
			$statment7 = " AND SHELTER_ID = '" . $shelterID ."'";
		}
		else{
			$statment7 = " WHERE SHELTER_ID = '" . $shelterID ."'";
		}
		$statment8 = " WHERE SHELTER_ID = '" . $shelterID ."'";
	}
	else{
		$statment7 = "";
		$statment8 = "";
	}
	$sql = "SELECT * FROM " . $petTable . $statment1 . $statment2 . $statment3 . $statment4 . $statment5 . $statment6 . $statment7;
	$sql1 = "SELECT * FROM " . $shelterTable . $statment8;
	$pets = $pet_conn->query($sql);
	if ($pets->num_rows > 0){
		while ($row = $pets->fetch_assoc()){
			if ($row["SPECIES"] == "D"){
				if ($dog == ""){
					$dogList[] = $row["PET_NAME"] . "/" . $row["GENDER"] . "/" . $row["AGE"] . "/" . $row["BREED"] . "/" . $row["VACCINES"] . "/" . $row["KIDS"] . "/" . $row["HOUSETRAIN"] . "/" . $row["NEUTERED"] . "/" . $row["PET_ID"] . "/" . $row["SHELTER_ID"];
				}
				else{
					if ($row["BREED"] == $dog){
						$dogList[] = $row["PET_NAME"] . "/" . $row["GENDER"] . "/" . $row["AGE"] . "/" . $row["BREED"] . "/" . $row["VACCINES"] . "/" . $row["KIDS"] . "/" . $row["HOUSETRAIN"] . "/" . $row["NEUTERED"] . "/" . $row["PET_ID"] . "/" . $row["SHELTER_ID"];	
					}
				}
			}
			else if ($row["SPECIES"] == "C"){
				if ($cat == ""){
					$catList[] = $row["PET_NAME"] . "/" . $row["GENDER"] . "/" . $row["AGE"] . "/" . $row["BREED"] . "/" . $row["VACCINES"] . "/" . $row["KIDS"] . "/" . $row["HOUSETRAIN"] . "/" . $row["NEUTERED"] . "/" . $row["PET_ID"] . "/" . $row["SHELTER_ID"];
				}
				else{
					if ($row["BREED"] == $cat){
						$catList[] = $row["PET_NAME"] . "/" . $row["GENDER"] . "/" . $row["AGE"] . "/" . $row["BREED"] . "/" . $row["VACCINES"] . "/" . $row["KIDS"] . "/" . $row["HOUSETRAIN"] . "/" . $row["NEUTERED"] . "/" . $row["PET_ID"] . "/" . $row["SHELTER_ID"];	
					}
				}
			}
		}
	}
	CloseCon($pet_conn);
	$shelter_conn = OpenShelterConn();
	$shelters = $shelter_conn->query($sql1);
	if ($shelters->num_rows > 0){
		while ($row = $shelters->fetch_assoc()){
			$shelterList[] = $row["SHELTER_NAME"] . "|" . $row["PHONE_NUMBER"] . "|" . $row["ADDRESS"] . "|" . $row["EMAIL"] . "|" . $row["SHELTER_ID"];
		}
	}
	CloseCon($shelter_conn);
?>
            <!--start section for pet display-->
            <section>
                <div class="pet-display-header">
                    <h2 class="section__title">Take A Look At Some Of Our Pets!</h2>
                </div>
                 <!--Dogs wrapper-->
                 <section class="pets-wrapper">
					<form action="wish_list.php" class="find-wrapper" method="post">
                    <h2 class="section__title">Dogs</h2>
                    <div id="dogs" class="pets">
                        <!--javascript runs here-->
                    </div>
					<br>
					<h2 class="section__title">Cats</h2>
					<div id="cats" class="pets">
					</div>
					<br>
					<label>Submit Pets to Wish List: </label>
					<input type="submit" name="submit" value="Submit"><br><br>
					</form>
                </section>
            </section> <!--end section for pet display-->
        </main>

        <footer>
            <nav">
                <ul class="navList">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="contact_us.html">Contact Us</a></li>
                    <li><a href="wish_list.php">My Wish List</a></li>
                    <li><a href="find_pet.php">Find Pet</a></li>              
                </ul>
            </nav>
            <h1 class="footer-logo"><a href="index.php">Agile <br>Adoption</a></h1>
        </footer>
		<div id="profiles">
		</div>
<script>

//Stores the variables from the find_pet page.
var DogList = <?php echo '["' . implode('", "', $dogList) . '"]' ?>;
var CatList = <?php echo '["' . implode('", "', $catList) . '"]' ?>;
var ShelterList = <?php echo '["' . implode('", "', $shelterList) . '"]' ?>;

var shel_list = [];
var s;
for (s of ShelterList){
	var x = s.split("|");
	shel_list.push(x);
}
//Builds off of div
var Dogs = document.getElementById("dogs");
var Cats = document.getElementById("cats");

var Profiles = document.getElementById("profiles");
var element;
var count = 0;
for (element of DogList){
	var sub = element.split("/");
	count = createDogPet(sub,shel_list,count);
}
for (element of CatList){
	var sub = element.split("/");
	count = createCatPet(sub,shel_list,count);
}
//Counts the number of pets for the wish_list.
var c = document.createElement('INPUT');
c.setAttribute("type","hidden");
c.setAttribute("name","count");
c.setAttribute("value",count);
Dogs.appendChild(c);

function createDogPet(sub,shel_list,count){
	var img = "pet_images/" + sub[8] + ".jpg";
	var d = Dogs.appendChild(createNewPetElement(sub[0]));
	d.appendChild(createPetTitle(sub[0]));
	d.appendChild(createPetImage(img));
	d.appendChild(createPetInformation(sub[1],sub[3]));
	var p = Profiles.appendChild(createPetProfile(sub,img,shel_list));
	d.appendChild(createPetButtons(p,sub,count));
	count = count + 1;
	return count;
}

function createCatPet(sub,shel_list,count){
	var img = "pet_images/" + sub[8] + ".jpg";
	var c = Cats.appendChild(createNewPetElement(sub[0]));
	c.appendChild(createPetTitle(sub[0]));
	c.appendChild(createPetImage(img));
	c.appendChild(createPetInformation(sub[1],sub[3]));
	var p = Profiles.appendChild(createPetProfile(sub,img,shel_list));
	c.appendChild(createPetButtons(p,sub,count));
	count = count + 1;
	return count;
}
function createPetProfile(sub,img,ShelterList){
	var profile = document.createElement('div');
	profile.classList.add("modal");
	
	var profileFront = document.createElement('div');
	profileFront.classList.add("modal-front");
	profile.appendChild(profileFront);
	
	var profileHeader = document.createElement('div');
	profileHeader.classList.add("modal-header");
	profileFront.appendChild(profileHeader);
	
	var xbtn = document.createElement('span');
	xbtn.classList.add("close");
	xbtn.innerHTML = "x";
	xbtn.onclick = function(){profile.style.display = 'none';};
	profileHeader.appendChild(xbtn);
	
	var header = document.createElement('h2');
	header.textContent = sub[0];
	profileHeader.appendChild(header);
	
	var modal_body = document.createElement('div');
	modal_body.classList.add("modal-body");
	profileFront.appendChild(modal_body);
		
	var modal_pad_left = document.createElement('div');
	modal_pad_left.classList.add("body-pad-left");
	modal_body.appendChild(modal_pad_left);
	
	var modal_body_left = document.createElement('div');
	modal_body_left.classList.add("modal-body-left");
	modal_body.appendChild(modal_body_left);
	
	var tac = document.createElement('div');
	tac.style.textAlign = 'center';
	modal_body_left.appendChild(tac);
	
	var pi = document.createElement('img');
	pi.classList.add("pet-img");
	pi.setAttribute("src",img);
	pi.setAttribute("alt","Pet Image");
	tac.appendChild(pi);
	
	var modal_body_right = document.createElement('div');
	modal_body_right.classList.add("modal-body-right");
	modal_body.appendChild(modal_body_right);
	
	var profile_info1 = document.createElement('div');
	profile_info1.classList.add("profile-info");
	modal_body_right.appendChild(profile_info1);
	
	var info_header1 = document.createElement('p');
	info_header1.classList.add("info-header");
	info_header1.textContent = "Pet Facts";
	profile_info1.appendChild(info_header1);
	
	var profile_selections1 = document.createElement('div');
	profile_selections1.classList.add("profile-sections");
	profile_info1.appendChild(profile_selections1);
	
	var fact_left1 = document.createElement('div');
	fact_left1.classList.add("fact-left");
	profile_selections1.appendChild(fact_left1);
	
	var info1 = document.createElement('p');
	info1.classList.add("info-h2");
	fact_left1.appendChild(info1);
	
	var name1 = document.createElement('b');
	name1.classList.add("info-h1");
	name1.innerHTML = "Name:";
	info1.appendChild(name1);
	info1.innerHTML += " " + sub[0] + "<br>";
	
	var gender1 = document.createElement('b');
	gender1.classList.add("info-h1");
	gender1.innerHTML = "Gender:";
	info1.appendChild(gender1);
	var gender;
	if (sub[1] == "F"){
		g = "Female";
	}
	else{
		g = "Male";
	}
	info1.innerHTML += " " + g + "<br>";
								
	var age1 = document.createElement('b');
	age1.classList.add("info-h1");
	age1.innerHTML = "Age:";
	info1.appendChild(age1);
	info1.innerHTML += " " + sub[2] + "<br>";
					
	var breed1 = document.createElement('b');
	breed1.classList.add("info-h1");
	breed1.innerHTML = "Breed:";
	info1.appendChild(breed1);
	info1.innerHTML += " " + sub[3] + "<br>";
	
	var fact_right1 = document.createElement('div');
	fact_right1.classList.add("fact-right");
	profile_selections1.appendChild(fact_right1);
	
	var info2 = document.createElement('p');
	info2.classList.add("info-h2");
	fact_right1.appendChild(info2);
	
	var element;
	for (element of ShelterList){
		if (element[4] == sub[9]){
			var shelter1 = document.createElement('b');
			shelter1.classList.add("info-h1");
			shelter1.innerHTML = "Shelter:";
			info2.appendChild(shelter1);
			info2.innerHTML += " " + element[0] + "<br>";
			
			var location1 = document.createElement('b');
			location1.classList.add("info-h1");
			location1.innerHTML = "Location:";
			info2.appendChild(location1);
			info2.innerHTML += " " + element[2] + "<br>";
			
			var shelter_contact1 = document.createElement('b');
			shelter_contact1.classList.add("info-h1");
			shelter_contact1.innerHTML = "Shelter Contact:";
			info2.appendChild(shelter_contact1);
			info2.innerHTML += " " + element[1] + "<br>";
			
			var shelter_contact2 = document.createElement('b');
			shelter_contact2.classList.add("info-h1");
			shelter_contact2.innerHTML = "Shelter Email:";
			info2.appendChild(shelter_contact2);
			info2.innerHTML += " " + element[3] + "<br>";
		}
	}
		
	var profile_info2 = document.createElement('div');
	profile_info2.classList.add("profile-info");
	modal_body_right.appendChild(profile_info2);
	
	var info_header2 = document.createElement('p');
	info_header2.classList.add("info-header");
	info_header2.textContent = "Pet Info";
	profile_info2.appendChild(info_header2);
	
	var profile_selections2 = document.createElement('div');
	profile_selections2.classList.add("profile-sections");
	profile_info2.appendChild(profile_selections2);
	
	var info_left1 = document.createElement('div');
	info_left1.classList.add("info-left");
	profile_selections2.appendChild(info_left1);
	
	var u1 = document.createElement('ul');
	u1.classList.add("info-h2");
	u1.style.marginLeft = "50px";
	info_left1.appendChild(u1);
	
	if (sub[7] == "Y"){
		var l1 = document.createElement('li');
		l1.innerHTML = "Neutered";
		u1.appendChild(l1);
	}
	if (sub[4] == "Y"){
		var l2 = document.createElement('li');
		l2.innerHTML = "Vaccinated";
		u1.appendChild(l2);
	}
	if (sub[5] == "Y"){
		var l3 = document.createElement('li');
		l3.innerHTML = "Good with kids";
		u1.appendChild(l3);
	}
	if (sub[6] == "Y"){
		var l4 = document.createElement('li');
		l4.innerHTML = "House trained";
		u1.appendChild(l4);
	}
	
	var story_info = document.createElement('div');
	story_info.classList.add("story-info");
	modal_body_right.appendChild(story_info);
	
	var info_header3 = document.createElement('p');
	info_header3.classList.add("info-header");
	info_header3.textContent = "My Story";
	story_info.appendChild(info_header3);
	
	var story = document.createElement('div');
	story.classList.add("story");
	story.innerHTML = "Coming soon!";
	story_info.appendChild(story);
	
	var body_pad_right = document.createElement('div');
	body_pad_right.classList.add("body-pad-right");
	modal_body.appendChild(body_pad_right);
	
	var modal_footer = document.createElement('div');
	modal_footer.classList.add("modal-footer");
	profileFront.appendChild(modal_footer);
	
	return profile;
}
function createNewPetElement(name){
	var name = document.createElement('div');
	name.classList.add('pet');
	return name;
}
function createPetTitle(name){
	let pet__title = document.createElement('h2');
	pet__title.textContent = name;
	pet__title.classList.add('pet__title');
	return pet__title;
}
function createPetImage(img){
	let pet__img = document.createElement('img');
	pet__img.setAttribute("src",img);
	pet__img.setAttribute("width","100%");
	pet__img.setAttribute("height","100%");
	pet__img.setAttribute("alt", "Pet picture");
	return pet__img;
}
function createPetInformation(gender,breed){
	var pet__information_div = document.createElement('div');
	pet__information_div.classList.add('pet__information');
	let pet__gender = document.createElement('p');
	pet__gender.textContent = gender;
	pet__information_div.appendChild(pet__gender);
	let pet__breed = document.createElement('p');
	pet__breed.textContent = breed;
	pet__information_div.appendChild(pet__breed);
	return pet__information_div;
}
function createPetButtons(profile,sub,count){
	let button_div = document.createElement('div');
	let button_wishList = document.createElement('a');
	let button_viewProfile = document.createElement('a');
	let input = document.createElement("INPUT");
	
	button_div.classList.add('btn__wrapper');
	
	button_wishList.classList.add('btn');
	button_wishList.classList.add('btn-color');
	button_wishList.textContent = 'Add to Wish List';
	
	button_viewProfile.classList.add('btn');
	button_viewProfile.classList.add('btn-color');
	button_viewProfile.textContent = "View Pet Profile";
	
	input.setAttribute("type","hidden");
	input.setAttribute("name","pet"+count);
	
	//Value is the file extension if pet is selected for wish list.
	button_wishList.addEventListener('click',function(){
		if (button_wishList.textContent == "Add to Wish List"){
			button_wishList.textContent = "Don't Add to Wish List";
			input.setAttribute("value", sub[8] + ".jpg");
		}
		else{
			button_wishList.textContent = "Add to Wish List";
			input.setAttribute("value","");
		}
	});
	button_viewProfile.addEventListener('click',function(){
			profile.style.display = 'block';
	});
	button_div.append(button_wishList,button_viewProfile);
	
	Dogs.appendChild(input);
	return button_div;
}
</script>
    </body>
</html>