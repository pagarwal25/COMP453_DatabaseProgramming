<!DOCTYPE html>
<html>


<body>
<h2> left part</h2>




<form action="rightResult.html.php"  method="post" target="rightFrame">
     <div><label for="zipcode">ZipCode:</label></br>
        <input type="text" name="zipcode" id="zipcode">
      </div>
      <div><label for="price">Affordable Price:</label>
        <input type="text" name="price" id="price">
      </div>
      <div><label for="Property_type">Property Type:</label></br>
        <select name="Property_type" style="width:100px">
		<option value="blank"></option>
		<option value="1">1</option>
		<option value="2">2</option>
		
		
		</select>
      </div>
    </br>
     
      <div><input type="submit" value="Search"></div>
    </form>
</body>
</html>