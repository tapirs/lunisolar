<?php
echo '<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>tapirs-technologies.co.uk - home</title>
    <meta name="description" content="tapirs technologies - agile i.t. - open source, enterprise class and automation for all" />';

    readfile('../../../common/head.htm');
  echo '</head>
  <body style="background-color:#eceeef" data-spy="scroll" data-target=".navbar-nav-middle" data-offset="50">';

    readfile('../../..//navbar.htm');

    echo '<div class="jumbotron text-center" style="margin-bottom:0px">
      <h1 class="display-4">{lunisolar}</h1>
      <p class="lead">{convert excel spreadsheets into calendar files for outlook and google calendar}</p>
      <hr class="my-4">
      <p></p>
    </div>';

      $target_dir = "uploads/";
      $target_file = $target_dir . rand(10000, 99999) . basename($_FILES["fileToUpload"]["name"]);
      $uploadOk = 1;
      $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      // Check if image file is a actual image or fake image
      if(isset($_POST["submit"])) {

      }

      // Check if file already exists
      if (file_exists($target_file)) {
          echo "Sorry, file already exists.";
          $uploadOk = 0;
      }

      // Check file size
      if ($_FILES["fileToUpload"]["size"] > 500000) {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
      }

      // Allow certain file formats
      if($fileType != "xls" && $fileType != "xlsx" ) {
          echo "Sorry, only XLS & XLSX files are allowed.";
          $uploadOk = 0;
      }



      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
      } else {
          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "<form id=\"ical_form\" action=\"ical.php\" method=\"post\">
            <input type=\"hidden\" name=\"filename\" value=\"$target_file\">
            </form>

            <script type=\"text/javascript\">
              document.getElementById('ical_form').submit();
            </script>";

          } else {
              echo "Sorry, there was an error uploading your file.";
          }
      }

  echo '</body>
</html>'

?>
