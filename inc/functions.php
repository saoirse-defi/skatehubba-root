<?php 

require_once('inc/config.php');

?>

<?php 

    function getSpots(){
      
      $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

      $sql_spots = "SELECT * FROM spots";

      $query = mysqli_query($conn, $sql_spots);

      $result_check = mysqli_num_rows($query);

      $spots = array();

          while($r = mysqli_fetch_assoc($query)){
                $spots[] = $r;
          }
      
      $indexed = array_map('array_values', $spots);

      echo json_encode($indexed);

        if (!$spots) {
            return null;
        }
    }
?>