<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>tapirs-technologies.co.uk - home</title>
    <meta name="description" content="tapirs technologies - agile i.t. - open source, enterprise class and automation for all" />

    <?php
      // @codeCoverageIgnoreStart
      readfile('../../../common/head.htm');
      // @codeCoverageIgnoreEnd
    ?>
  </head>
  <body style="background-color:#eceeef" data-spy="scroll" data-target=".navbar-nav-middle" data-offset="50">

    <?php include('../../../common/navbar.htm');?>

    <div class="jumbotron text-center" style="margin-bottom:0px">
      <h1 class="display-4">{lunisolar}</h1>
      <p class="lead">{convert excel spreadsheets into calendar files for outlook and google calendar}</p>
      <hr class="my-4">
      <p></p>
    </div>

    <div class="container bg-white">
      <form class="form-horizontal" id="upload_form" action="upload.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label class="control-label col-sm-2" for="fileToUpload">select your excel file</label>
          <div class="col-sm-10">
            <input type="file" class="form-control" id="fileToUpload" name="fileToUpload" required>
          </div>
        </div>
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default" form="upload_form" name="submit" value="upload">upload</button>
        </div>
      </form>

      <hr class="my-4">

      <div id="accordion">
        <div class="card">
          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                creating a calendar
              </button>
            </h5>
          </div>

          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
              <p>to create a new calendar; click the browse button and find the spreadsheet that contains your events</p>

              <p>if you haven't created one yet you can download a template <a href="template.xlsx">here</a></p>

              <p>then hit the upload button and your calendar file will download automatically</p>

              <p>opening the ics file will add it to the default calendar application on your computer/phone</p>

              <p><strong>some rules</strong></p>

              <p>the first cell (a1) should contain a title, this will be used to name the calendar file</p>

              <p>days should be put in the first column and the format should be <code>day name day number</code> for example <code>mon 8</code></p>

              <p>times should be put in the second column and they should use the 12-hour clock, but can also be <code>AM, PM or time tbc</code> and these will be set in the calendar as the following defaults <code>8.30 AM, 12.00 PM or 8.30 AM</code></p>

              <p>the event description goes in the third column</p>

              <p>you can have multiple events per day just make sure they go onto seperate rows</p>


            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingTwo">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                adding calendar to outlook
              </button>
            </h5>
          </div>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
            <div class="card-body">
              <p>if you need to add the calendar file to outlook</p>

              <p>download the ics file to your computer</p>

              <p>open up outlook and click on the "file" menu</p>

              <p>click "Open & Export" and then click on the "Open Calendar"</p>

              <p>browse to where the calendar file is downloaded and click open</p>

              <p>all events should now be added to your calendar</p>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingThree">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                adding calendar to google
              </button>
            </h5>
          </div>
          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
              <p>if you need to add the calendar to google</p>

              <p>download the ics file to your computer</p>

              <p>goto <a href="https://calendar.google.com">google calendar</a> and login</p>

              <p>click on the settings cog and click "settings"</p>

              <p>click "import & export"</p>

              <p>click "select file from your computer" and browse for the calendar file</p>

              <p>click import and a message should appear to say all events have been imported</p>

              <p>n.b. make sure you have the time zone set to Europe/London</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include('../../../common/footer.htm');?>
  </body>
</html>
