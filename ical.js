function parseJwt (token) {
    var base64Url = token.split('.')[1];
    var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
    return JSON.parse(window.atob(base64));
}

function toggleHelp(div) {
  //var instructions = '<h4>creating a calendar</h4>to create a new calendar; click the browse button and find the spreadsheet with your events in (you can download a template for that <a href="template.xlsx">here</a>)';
 //instructions = instructions + '<h4 onclick="getHelp(\'outlook\')">adding calendar to outlook</h4><div id="outlook"></div><h4 onclick="toggleHelp(\'google\')">adding calendar to google</h4><div id="outlook"></div>';

  if( document.getElementById(div).style.display == "none") {
    document.getElementById(div).style.display = "block";
  } else {
    document.getElementById(div).style.display = "none";
  }
};
