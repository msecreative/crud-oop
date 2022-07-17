<?php include "inc/header.php";
//require "classes/Student.php";
  spl_autoload_register(function($class){
    include "classes/".$class.".php";
  });
?>
<section class="mainleft">
  <?php
     $user = new Student();
     if (isset($_POST['submit'])) {
       $name = $_POST['name'];
       $dept = $_POST['dept'];
       $age  = $_POST['age'];
   
       $user->setName($name);
       $user->setDept($dept);
       $user->setAge($age);
   
       if ($user->insert()) {
         echo "<span class='insert'>Data Inserted Successfully</span>";
       }
     }
    //  update query
     if (isset($_POST['edit'])) {
       $id = $_POST['id'];
       $name = $_POST['name'];
       $dept = $_POST['dept'];
       $age  = $_POST['age'];
   
       $user->setName($name);
       $user->setDept($dept);
       $user->setAge($age);
   
       if ($user->update($id)) {
         echo "<span class='insert'>Data Updated Successfully</span>";
       }
     }
  ?>

  <?php
    if (isset($_GET['action']) && $_GET['action'] == "delete") {
      $id = $_GET['id'];
      if ($user->delete($id)) {
        echo "<span class='delete'>Data Deleted Successfully</span>";
      }
    }

  ?>
  <!-- Update Data -->
  <?php
    if (isset($_GET['action']) && $_GET['action'] == "edit") {
      $id = $_GET['id'];
      $result = $user->readById($id);

  ?>
  <form action="" method="post">
    <table>
    <input type="text" name="id" value="<?=$result['id'] ?>" hidden/>
        <tr>
            <td>Name: </td>
            <td><input type="text" name="name" required="1" value="<?=$result['name'] ?>"/></td>    
        </tr>

        <tr>
          <td>Department: </td>
            <td><input type="text" name="dept" required="1" value="<?=$result['dept'] ?>"/></td>
        </tr>

        <tr>
          <td>Age: </td>
            <td><input type="text" name="age" required="1" value="<?=$result['age'] ?>"/></td>
        </tr>
        <tr>
          <td></td>
            <td>
            <input type="submit" name="edit" value="Submit"/>
            <input type="reset" value="Clear"/>
            </td>
        </tr>
      </table>
    </form>
  <?php
    }else{
  ?>
<form action="" method="post">
 <table>
    <tr>
        <td>Name: </td>
        <td><input type="text" name="name" required="1"/></td>    
    </tr>

    <tr>
       <td>Department: </td>
        <td><input type="text" name="dept" required="1"/></td>
    </tr>

    <tr>
      <td>Age: </td>
        <td><input type="text" name="age" required="1"/></td>
    </tr>
    <tr>
      <td></td>
        <td>
        <input type="submit" name="submit" value="Submit"/>
        <input type="reset" value="Clear"/>
        </td>
    </tr>
  </table>
</form>
<?php } ?>
</section>



<section class="mainright">
  <table class="tblone">
    <tr>
        <th>No</th>
        <th>Name</th>
        <th>Department</th>
        <th>Age</th>
        <th>Action</th>
    </tr>
<?php 
$i = 0;
foreach ($user->readAll() as $key => $value) {
    $i++;
  ?>
    <tr>
        <td><?=$i?></td>
        <td><?=$value["name"]?></td>
        <td><?=$value["dept"]?></td>
        <td><?=$value["age"]?></td>
        <td>
        <?php echo "<a href='index.php?action=edit&id=".$value['id']."'>Edit</a>"?> ||
        <?php echo "<a href='index.php?action=delete&id=".$value['id']."'>Delete</a>"?>
        </td>
    </tr>
  <?php }?>
  </table>
</section>










<?php include "inc/footer.php"; ?>