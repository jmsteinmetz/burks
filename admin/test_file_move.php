<?php
session_start();

include("header.php");

?>

    <!-- Start Page Content  -->
        
<div class="breadcrumb" style=""></div>
    <div id="page-content"> 
      <!-- Start Page Header -->
      <div id="page-header">
        <h1>Reorganize Clinical Files</h1>

        <?php
        $query1 = mysql_query("select id,clinical from tbl_jobs where length(clinical) > 0");
 
        $var1=1;
        if ($var1<10) $folder = "00" . (string)$var1 . "/";
        elseif ($var1<100) $folder = "0" . (string)$var1 . "/";
        else $folder = (string)$var1 . "/";

        $var2=1;

        while($row1 = mysql_fetch_array($query1))
        {

        $id = $row1['id'];
        $new_clinical = $folder . $row1['clinical'];
        $new_clinical = str_replace("  ","_",$new_clinical);
        $new_clinical = str_replace(" ","_",$new_clinical);
        $old = "/images/gallery/clinical/cl_" . $row1['clinical'];
        $query2 = "update tbl_jobs set clinical=".addslashes($new_clinical)." where id=$id";

        echo $id;
        echo "  ";
        echo $old;
        echo "  ";
        echo $new_clinical;
        echo "  ";
        echo $var2;
        echo "  ";

        if (file_exists($old)) echo "yes<br>";
        else echo "no<br>";
        $err = error_get_last();
        echo $err['message']." ".$err[line];
        echo "<br>";
        
        $var2++;
        if ($var2 == 101) break;

        }
        ?>
       
      </div>
      <!-- End Page Header --> 
      
      <!-- Start Grid -->
      <div class="container+12">


      
      <!-- End Page Wrapper --> 
    </div>
    <!-- End Page Content  --> 

<?php include("footer");