<?php

session_start();
include("config.php");

if ($_SESSION["Login"] != "YES") {
    header("Location: login.php");
}
?>
<html lang="en">
    
<head>
   <title>Some Web Page</title>
   <link rel='stylesheet' href='yam-css/navigationbar&body.css'/>
   <link rel='stylesheet' href='yam-css/serviceSeller.css'/>
   <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!--windows size responsive-->
 </head>

<body id="service">

<?php 
include("logout.php");
?>

<?php if($_SESSION['LEVEL']==1):?>
<div class="body-container">
  <div class="grid-container">
    <div class="editMenu">
      <h2><u>EDIT MENU</u></h2>
    </div>

    <div class="date">
      <div><img src="servicePageImage/calendar.png" style="height: 30px; width: 30px; margin-right: 10px"></div>
      <div><text style="font-size: 1.1rem;">dd/mm/yyyy</text></div>
    </div>

    <div class="cart">
      <a data-active="cart" href="serviceCheckout.html"><img src="servicePageImage/shopping-cart.png" style="height: 40px; width: 40px; margin-right: 10px"></a>
    </div>
  
<?php 
    $sql = "SELECT * FROM menu";
    $res = mysqli_query($conn, $sql);

        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) { 
            
            echo "<div class='details'>";?>

            <img src="menuimages/<?=$row['menu_img']?>" width="20%" >
            
    <?php echo "<div class='name'> $row[menu_code]. $row[menu_name] </div>
    <div class='engName'> $row[menu_description] </div>
    <div class='price'> RM$row[menu_price] </div>
    <div class='addMinus'>
	<a href='delete_item.php?pass=$row[menu_code]'>Delete</a>
	<a href='edit_item.php?menucode=$row[menu_code]'>Edit</a>
  </div></div>";
    } } ?>
<button id="plusButton" class="allbutton" onclick="document.getElementById('id01').style.display='block'" style="width:auto;"> + </button>

<div id="id01" class="modal">
  
  <form class="modal-content animate" action="validateUpdateMenu.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <h1>Add Item</h1>
    </div>

    <div class="input-container">
      <label for="foodCname"><b>Food's Image: </b></label>
      <input type="file" name="uploadfile" accept="image/jpeg, image/png, image/jpg"><br><br>

      <label for="foodID"><b>Food's ID</b></label>
      <input type="foodID" name="menucode" placeholder="" id="foodid" >

      <label for="foodCname"><b>Food's Chinese Name</b></label>
      <input type="foodCname" name="menuname" placeholder="" id="foodCName" >

      <label for="foodEngName"><b>Food's English Name</b></label>
      <input type="foodEngName" name="menudesc" placeholder="" id="foodEngName" >
        
      <label for="foodPrice"><b>Food Price:</b></label>
      <input type="foodPrice" name="menuprice" placeholder="" id="foodPrice" >

      <!--ltr need to change to submit-->
      <button type="upload" class="allbutton" id="addButton">ADD</button>
      <!--<input type="button" id="addButton" value="ADD" >-->
      
    </div>

  </form>
</div>
  </div>  
</div> 
  <?php endif;?>

  <?php if($_SESSION['LEVEL']==2):?>

    <div class="sweetSourChicken">
        <img src="servicePageImage/sweetSourChicken.png">
        <div class="details">
          <div class="name">A. 酸甜鸡丁</div>
          <div class="quantity">100pc</div>
          <div class="engName">Sweet & Sour Chicken</div>
          <div class="price">RM3.00</div>
          <div class="addMinus">
          <form action="" style="display: flex; justify-content: space-around">
            <div><img src="servicePageImage/minus.png" style="height: 20px; width: 20px;"></div>
            <div><input type="number"id="quantity" name="quantity" min="1" max="5" style="height: 20px; width: 30px;"></div>
            <div><img src="servicePageImage/add.png" style="height: 20px; width: 20px"></div>
          </form>
          </div>
          <div>
            <button onclick="location.href='serviceCheckout.html'">ADD TO CART</a></button></div>
        </div>

    </div>
  <?php endif;?>
<script type="text/javascript" src="yam-script/script.js"></script>

</body>
</html>