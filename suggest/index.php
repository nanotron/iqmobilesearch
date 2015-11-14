<?php
  header("Content-type: text/javascript\n\n");  

  if(isset($_GET['q'])) { 
    $query = urlencode($_GET['q']);
    $data = "http://suggestqueries.google.com/complete/search?output=firefox&qu=".$query;
    $response = file_get_contents($data);
    echo $response;
  }    
?>
