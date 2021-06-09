<!DOCTYPE html>
<html lang="en" class="find-pet">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Find Pet</title>
        <link rel="stylesheet" href="css/style.css">
		<style>
			.find-wrapper {
				margin: 10px;
			}
		</style>
    </head>

    <body>
<?php
	include 'db_connections.php';
	$pet_conn = OpenPetConn();
	$pets = $pet_conn->query("SELECT BREED,SPECIES,AGE FROM `table 2`");
	if ($pets->num_rows > 0){
		while ($row = $pets->fetch_assoc()){
			$pet = $row["SPECIES"];
			$breed = $row["BREED"];
			$ages[] = $row["AGE"];
			if ($pet == "D"){
				$dogs[] = $breed;
			}
			else{
				$cats[] = $breed;
			}
		}
	}
?>
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
			<h2 class="find-pet-header section__title">Find your pet</h2><br>
			<!--Search section-->
			<form action="index.php" class="find-wrapper" method="post">
		
				<label>Please Select Gender:</label>
				<select name="gender">
					<option value="">Both</option>
					<option value="M">Male</option>
					<option value="F">Female</option>
				</select><br><br>
				
				<label>Select Dog Breed:</label>
				<select name="dog">
					<option value="">None</option>
				</select><br><br>
				<label>Select Cat Breed:</label>
				<select name="cat">
					<option value="">None</option>
				</select><br><br>
				
				<label>Enter Age:</label>
				<select name="age">
					<option value=""></option>
				</select><br><br>
				
				<label>Vaccinations</label>
				<select name="vaccination">
					<option value=""></option>
					<option value="Y">Yes</option>
					<option value="N">No</option>
				</select><br><br>
				
				<label>Good with Kids</label>
				<select name="kids">
					<option value=""></option>
					<option value="Y">Yes</option>
					<option value="N">No</option>
				</select><br><br>
				
				<label>House Trained</label>
				<select name="house">
					<option value=""></option>
					<option value="Y">Yes</option>
					<option value="N">No</option>
				</select><br><br>
				
				<label>Neutered</label>
				<select name="neutered">
					<option value=""></option>
					<option value="Y">Yes</option>
					<option value="N">No</option>
				</select><br><br>
				
				<label>Shelter</label>
				<select name="shelter">
					<option value=""></option>
					<option value="10000">Paws Welfare League</option>
					<option value="10001">Bark 'n Bubbles</option>
					<option value="10002">Barking Lot</option>
					<option value="10003">Beast of the Best</option>
				</select><br><br>
				<input type="submit" name="submit" value="Submit"><br><br>
<script>
	var list1 = <?php echo '["' . implode('", "', $dogs) . '"]' ?>;
	var list2 = <?php echo '["' . implode('", "', $cats) . '"]' ?>;
	var list3 = <?php echo '["' . implode('", "', $ages) . '"]' ?>;
	dogs = [];
	cats = [];
	ages = [];
	for (l of list1){
		if(!dogs.includes(l)){
			dogs.push(l);
		}
	}
	for (l of list2){
		if(!cats.includes(l)){
			cats.push(l);
		}
	}
	for (l of list3){
		if(!ages.includes(l)){
			ages.push(l);
		}
	}
	dogs.sort();
	cats.sort();
	ages.sort();
	
	dogBreeds = document.getElementsByName("dog");
	catBreeds = document.getElementsByName("cat");
	ageNumber = document.getElementsByName("age");
	
	var d;
	for (d of dogs){
		dogBreeds[0].appendChild(addOption(d));
	}
	var c;
	for (c of cats){
		catBreeds[0].appendChild(addOption(c));
	}
	var a;
	for (a of ages){
		ageNumber[0].appendChild(addOption(a));
	}
	
	function addOption(pet){
		var opt = document.createElement('option');
		opt.textContent = pet;
		opt.value = pet;
		return opt;
	}
</script>
			</form>
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
    </body>
</html>