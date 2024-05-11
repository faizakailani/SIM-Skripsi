<html>
<head>
<title>Demo Kalender</title>
<script type="text/javascript" src="calendar.js"></script>
<link href="calendar.css" rel="stylesheet" type="text/css" media="screen">
 </head>
 <body>
 <form action=# method=post>
 nim: <input type=text name=nim>
 <br>
 nama: <input type=text name=nama>
 <br>
 Tanggal: <input type="text" name="date" id="date" />
 <script type="text/javascript">
  		calendar.set("date");
 </script>
 <br>
 Tanggal: <input type="text" name="date2" id="date2" />
 <script type="text/javascript">
  		calendar.set("date2");
 </script>
 <br>
 alamat: <input type=text name=alamat>
 <br>
 <input type=submit value=kirim>
 </form>
 </body>
 </html>
