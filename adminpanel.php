<?php
    session_start();


if (isset($_SESSION['user']) || isset($_SESSION['pass'])) {
    $password = $_SESSION['pass'];
    $username = $_SESSION['user'];
    
}

if(empty($password) || empty($username))
{
    header('location: login.html');
}
else
{
   
?>
<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>

<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">


  <title></title>
  <style>
	body {
		background-image: url("pozad.png");
		background-position: right bottom;
		background-repeat: no-repeat;
		background-size: 100%;
		background-attachment: fixed;
		background-color: #e1e2e8;
    font-family: "Roboto Condensed", sans-serif;
	}

	.mdl-layout__drawer{
     		background-color: #010e56;
      		color: white;
	}
.mdl-layout__drawer .mdl-navigation .mdl-navigation__link{
      		
      		color: white !important;
	}
	hr{
  		display: block;
    		margin-top: 0.5em;
    		margin-bottom: 0.5em;
    		margin-left: auto;
    		margin-right: auto;
    		border-style: inset;
    		border-width: 2px;
    		border-color: #b4b4ba;
	}
      
      .activ:active{
          	transform: scale(0.9);
	}

      .table.table-hover{
  		width: 60%;
	}
a
{
    text-decoration: none !important;
}

a:hover
{
    color:lightgray !important;
}

.mdl-layout__header-row{
  background-color: #00a651;
}
</style>

</head>
<body >
<div class="mdl-layout mdl-js-layout">
  <header class="mdl-layout__header mdl-layout__header--scroll">
    <div class="mdl-layout__header-row">
      <!-- Title -->
      <span class="mdl-layout-title" style="font-family: Roboto Condensed;">Mobtech - Admin panel</span>
      <!-- Add spacer, to align navigation to the right -->
      <div class="mdl-layout-spacer"></div>
      

            <!-- Navigation. We hide it in small screens. -->
<nav class="mdl-navigation mdl-layout--large-screen-only">
                <a class="mdl-navigation__link" href="logout.php"> Izloguj se</a>
            </nav>
        </div>
  </header>
  

<h1 align="center">Naručeni telefoni</h1>
<hr  width="60%" ></hr>

<?php
// konektovanje na bazu podataka
include('connect-db.php');

// broj pitanja na jednom tabu
$per_page = 20;

// racunanje ukupnih tabova za prikaz
if ($result = $mysqli->query("SELECT * FROM kupac"))
{
if ($result->num_rows != 0)
{
$total_results = $result->num_rows;
// ceil() returns the next highest integer value by rounding up value if necessary
$total_pages = ceil($total_results / $per_page);

// check if the 'page' variable is set in the URL (ex: view-paginated.php?page=1)
if (isset($_GET['page']) && is_numeric($_GET['page']))
{
$show_page = $_GET['page'];

// make sure the $show_page value is valid
if ($show_page > 0 && $show_page <= $total_pages)
{
$start = ($show_page -1) * $per_page;
$end = $start + $per_page;
}
else
{
// error - show first set of results
$start = 0;
$end = $per_page;
}
}
else
{
// if page isn't set, show first set of results
$start = 0;
$end = $per_page;
}

// display pagination


// display data in table
echo "<table align='center' class='table table-hover'  >";
echo "<tr><th>Id</th>  <th>Ime i prezime</th> <th>Telefon</th> <th>Adresa </th> <th> Paket </th> </tr>";

// loop through results of database query, displaying them in the table
for ($i = $start; $i < $end; $i++)
{
// make sure that PHP doesn't try to show results that don't exist
if ($i == $total_results) { break; }

// find specific row
$result->data_seek($i);
$row = $result->fetch_row();

// echo out the contents of each row into a table
echo "<tr>";
echo '<td>' . $row[0] . '</td>';
echo '<td>' . $row[1] . '</td>';
echo '<td>' . $row[2] . '</td>';
echo '<td>' . $row[3] . '</td>';
echo '<td>' . $row[4] . '</td>';
echo '<td> <button type="button" style="margin-right: -40px;" class="btn btn-success" data-toggle="modal" data-target="#myModal'.$i.'">Odobri</button>
<!-- Modal -->
  <div class="modal fade" id="myModal'.$i.'" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
          <p>Da li želite da odobrite zahtev?</p>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
         <a href="delete.php?id=' . $row[0] . '"> <button type="button" class="btn btn-success" >Odobri</button></a>
        </div>
      </div>
      
    </div>
  </div>
</td>';
echo '<td> <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal'.$i.'">Izbriši</button>
<!-- Modal -->
  <div class="modal fade" id="myModal'.$i.'" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
          <p>Da li želite da obrišete zahtev?</p>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
         <a href="delete.php?id=' . $row[0] . '"> <button type="button" class="btn btn-danger" >Obriši</button></a>
        </div>
      </div>
      
    </div>
  </div>
</td>';
echo "</tr>";
}

// close table>
echo "</table>";
}
else
{
echo "No results to display!";
}
}
// error with the query
else
{
echo "Error: " . $mysqli->error;
}

// close database connection
$mysqli->close();
echo "<p align='center'><b>Pogledaj stranicu:</b> ";
for ($i = 1; $i <= $total_pages; $i++)
{
if (isset($_GET['page']) && $_GET['page'] == $i)
{
echo "<a href='adminpanel.php?page=$i'><button type='button' class='btn btn-default active'>$i</button></a> ";
}
else
{
echo "<a href='adminpanel.php?page=$i'><button type='button' class='btn btn-default'>$i</button></a> ";
}
}
echo "</p>";

?>
    </div>
  </main>
</div>


<script>
    var dialog = document.querySelector('dialog');
    var showModalButton = document.querySelector('.show-modal');
    if (! dialog.showModal) {
      dialogPolyfill.registerDialog(dialog);
    }
    showModalButton.addEventListener('click', function() {
      dialog.showModal();
    });
    dialog.querySelector('.close').addEventListener('click', function() {
      dialog.close();
    });
  </script>

</body>
</html>
<?php }?>