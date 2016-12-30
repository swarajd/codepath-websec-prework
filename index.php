<html>
 <head>
  <title>PHP Test</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">
 </head>
 <body>
<form name="tipcalc" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);
?>" method="post">
    <h1>Tip calculator</h1>
    Bill subtotal: $<input 
        type="text" 
        name ="subtotal" 
        value="<?php echo(isset($_POST['subtotal']) ? htmlspecialchars($_POST['subtotal']) : '') ?>"><br>
    Tip percentage:
     <?php 

$percentages = array(10, 15, 20);

$selected = isset($_POST['percentage']) ? $_POST['percentage'] : null;

for ($x = 0; $x < count($percentages); $x++) {
	echo('<input type="radio" name="percentage" value="' 
        . $percentages[$x] 
        . '" '
        . (($selected == $percentages[$x]) ? 'checked' : '')
        . ' >' 
        . $percentages[$x] 
        . '%');
}

echo('<br>');

$perc_set     = isset($_POST['percentage']);
$subtotal_set = isset($_POST['subtotal']) && strlen($_POST['subtotal']) > 0;
$posted       = $_SERVER['REQUEST_METHOD'] === 'POST';
$set_vals = $perc_set && $subtotal_set;
$valid_subtotal = $set_vals && is_numeric($_POST['subtotal']) && $_POST['subtotal'] > 0;

if ($valid_subtotal) {
    echo('<p class="good res">');
    echo('Tip: $' . $_POST['subtotal'] * $_POST['percentage']/100 . '<br/>');
    echo('Total: $' . $_POST['subtotal'] * ($_POST['percentage']/100 + 1));
    echo("</p>");
} else if ($posted) {
    echo('<p class="bad res">');
    if (!$perc_set && !$subtotal_set) {
        echo('neither percentage nor subtotal was set');
    } else if (!$perc_set) {
        echo('the percentage was not set');
    } else if (!$subtotal_set) {
        echo('the subtotal was not set');
    } else {
        echo('the subtotal was not formatted correctly');
    }
    echo("</p>");
}




?>
<br>
<input type="submit"> 
</form>
 </body>
</html>