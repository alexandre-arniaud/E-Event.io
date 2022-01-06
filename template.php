<?php
function start_page($title)
{
?> <!DOCTYPE html>
<html lang="fr">
<head>
    <title><?php echo $title; ?></title>
    <meta charset="utf-8">
    <?php
    if ($title == 'E-event.io | Connexion')
    {
      print ('<link rel="stylesheet" type="text/css" href="css/login.css">');
    }
    else if ($title == 'E-event.io | Inscription')
    {
      print ('<link rel="stylesheet" type="text/css" href="css/signup.css">');
    }?>
</head>
<body>
<?php
}
function end_page()
{
?> </body>
</html>
<?php
}
?>
<?php end_page(); ?>
