function viewcalendar() {
  kalendarik = window.open("php_calendar/calendar.php", "kalendarik" , "location=0, menubar=0, scrollbars=0, status=0, titlebar=0, toolbar=0, directories=0, resizable=0, width=200, height=200, top=500, left=600");
  //kalendarik.resizeTo(200, 240);
  //kalendarik.moveTo(500, 500);
}
function insertdate(d) {
  window.close();
  window.opener.document.getElementById('date').value = d;
}
