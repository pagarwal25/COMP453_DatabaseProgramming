

<!doctype html>
<html>
    <head>
        <style>
 
           body{font-family:Verdana;}
		   td {  padding: 15px;} 
		   .inputStyle{
    border-radius: 7px;
	box-shadow:inset 0 0 7px #D4D4D4;
	
	height: 40px;
	font-size: 0.8em;
	border: 1px solid #D4D4D4;
	width:300px ;
}
input:focus {outline:none;}

.inputStyleSubmit{
    border-radius: 7px;
	background-color:#FF8732;
	color:white;
	height: 40px;
	font-size: 0.8em;
	border: 1px solid #FF8732;
	width:200px ;
	cursor:pointer;
	
}
        </style>
    </head>
    <body>
        <center>
            <form action="listingpage.html.php" method="POST">
                <h2>Fill the form to become a member:</h2>
                <table>
				<tr>
				<td><label for="username">Username *: </label></td>
				<td><input class="inputStyle type="text" id="username" name="username" /></td>
				</tr>
                <td><label for="password">Password *: </label></td><td><input class="inputStyle" type="password" id="password" name="password"/></td>
				</tr>
                <!-- You may want to consider adding a "confirm" password box also -->
                
                             
                <tr>
				<td><label for="email">Email *: </label></td><td><input class="inputStyle type="email" id="email" name="email"/></td>
				</tr>
				
                <!-- Valid input types: http://www.w3schools.com/html5/html5_form_input_types.asp -->
                <tr>
				<td><label for="tel">Telephone: </label></td><td><input class="inputStyle type="text" id="tel" name="telephone"/></td>
				</tr>
                
                <tr>
				<td><label for="zip">Post Code: </label></td><td><input class="inputStyle type="text" id="zip"  name="zip"/></td>
				</tr>
                <tr>
				<td></td>
				<td align="right"><input class="inputStyleSubmit" type="submit" value="Submit" /></td></tr>
 </table >
                <p>Note: Please make sure your details are correct before submitting form and that all fields marked with * are completed!.</p>
          
		   </form>
		   </center>
        
    </body>
</html>
