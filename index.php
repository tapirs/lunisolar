<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <title>tapirs-technologies.co.uk - home</title>
    <meta name="description" content="tapirs technologies - agile i.t. - open source, enterprise class and automation for all" />

    <!-- favicon pointers -->
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="../../../images/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../../../images/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../../../images/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../../../images/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="../../../images/apple-touch-icon-60x60.png" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="../../../images/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="../../../images/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="../images/apple-touch-icon-152x152.png" />
    <link rel="icon" type="image/png" href="../../../images/favicon-196x196.png" sizes="196x196" />
    <link rel="icon" type="image/png" href="../../../images/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/png" href="../../../images/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="../../../images/favicon-16x16.png" sizes="16x16" />
    <link rel="icon" type="image/png" href="../../../images/favicon-128.png" sizes="128x128" />
    <meta name="application-name" content="&nbsp;"/>
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="../../../images/mstile-144x144.png" />
    <meta name="msapplication-square70x70logo" content="../../../images/mstile-70x70.png" />
    <meta name="msapplication-square150x150logo" content="../../../images/mstile-150x150.png" />
    <meta name="msapplication-wide310x150logo" content="../../../images/mstile-310x150.png" />
    <meta name="msapplication-square310x310logo" content="../../../images/mstile-310x310.png" />


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/bootstrap_override.css">

    <link href="https://cdn-images.mailchimp.com/embedcode/horizontal-slim-10_7.css" rel="stylesheet" type="text/css">

    <!-- mailchimp stuff -->
    <style type="text/css">
    	#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; width:100%;}

      @media (max-width: 768px) {
        html, body {
          width: auto !important;
          overflow-x: hidden !important;
        }
      }
    </style>

    <!-- footer stuff -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/Footer-white.css">

    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
    <script src="ical.js"></script>
    <script>
    window.addEventListener("load", function(){
    window.cookieconsent.initialise({
      "palette": {
        "popup": {
          "background": "#eaf7f7",
          "text": "#5c7291"
        },
        "button": {
          "background": "#56cbdb",
          "text": "#ffffff"
        }
      },
      "theme": "classic"
    })});
    </script>
  </head>
  <body style="background-color:#eceeef" data-spy="scroll" data-target=".navbar-nav-middle" data-offset="50">

    <?php include('../navbar.htm');?>

    <div class="jumbotron text-center" style="margin-bottom:0px">
      <h1 class="display-4">{calendar creator}</h1>
      <p class="lead">{tapirs: project}</p>
      <hr class="my-4">
      <p></p>
    </div>

    <div class="container bg-white">
      <form class="form-horizontal" id="upload_form" action="upload.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label class="control-label col-sm-2" for="fileToUpload">select your excel file to create the calendar</label>
          <div class="col-sm-10">
            <input type="file" class="form-control" id="fileToUpload" name="fileToUpload" required>
          </div>
        </div>
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default" form="upload_form" name="submit" value="upload">upload</button>
        </div>

        <div onclick="console.log(parseJwt('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.XbPfbIHMI6arZ3Y922BhjWgQzWXcXNrz0ogtVhfEd2o'))" class="col-sm-offset-2 col-sm-10">
          test
        </div>
      </form>

      <div id="test">
      </div>
    </div>
  </body>
</html>
