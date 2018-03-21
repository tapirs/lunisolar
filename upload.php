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

    readfile('../../../common/navbar.htm');

    echo '<div class="jumbotron text-center" style="margin-bottom:0px">
      <h1 class="display-4">{lunisolar}</h1>
      <p class="lead">{convert excel spreadsheets into calendar files for outlook and google calendar}</p>
      <hr class="my-4">
      <p></p>
    </div>';

      $target_dir = "uploads/";
      $target_file = $target_dir . rand(10000, 99999) . basename($_FILES["fileToUpload"]["name"]);
      $uploadOk = 0;
      $uploadError = "";
      $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      // Check if image file is a actual image or fake image
      if(isset($_POST["submit"])) {

      }

      // Check if file already exists
      if (file_exists($target_file)) {
          $uploadError = "file already exists.";
          $uploadOk = 1;
      }

      // Check file size
      if ($_FILES["fileToUpload"]["size"] > 500000) {
          $uploadError = "your file is too large.";
          $uploadOk = 2;
      }

      // Allow certain file formats
      if($fileType != "xls" && $fileType != "xlsx" ) {
          $uploadError = "Sorry, only XLS & XLSX files are allowed.";
          $uploadOk = 3;
      }

      echo '<div class="container">';

      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk != 0) {
          echo "<p>sorry, your file was not uploaded.<p>";

          if ($uploadOk == 3) {
            echo "<p>it looks like you tried to upload a file that wasn't an xls or xlsx file<p>";
          } else {
            echo "<p>if the problem persists then please fill out <a href='/contact_us.php'>this contact form</a> and add the following error code<p>";
            echo "<code>" . base64_encode($uploadError) . "</code>";
          }

          echo "<p>click <a href='index.php'>here</a> to try again";
      // if everything is ok, try to upload file
      } else {
          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "<p>your file has been uploaded and you calendar file should start to download automatically</p><p>if it doesn't then click the download button below.<p>";
            echo "<form id=\"ical_form\" action=\"ical.php\" method=\"post\">
            <input type=\"hidden\" name=\"filename\" value=\"$target_file\">
            <input type=\"submit\" class=\"btn btn-default\" name=\"submit\" value=\"download\">
            <button class='btn btn-default'><a href='index.php'>upload another file</a></button>
            </form>

            <script type=\"text/javascript\">
              document.getElementById('ical_form').submit();
            </script>";
          } else {
              echo "Sorry, there was an error uploading your file.";
          }
      }

  echo '</div>
  </body>
</html>'

?>
