<?php
include ('database_connection.php');

if (isset($_POST["action"])) {
    $action = $_POST["action"];

    if ($action == 'fetch_data') {
        $minimum_price = isset($_POST["minimum_price"]) ? $_POST["minimum_price"] : null;
        $maximum_price = isset($_POST["maximum_price"]) ? $_POST["maximum_price"] : null;
        $brand = isset($_POST["brand"]) ? $_POST["brand"] : array();
        $ram = isset($_POST["ram"]) ? $_POST["ram"] : array();
        $storage = isset($_POST["storage"]) ? $_POST["storage"] : array();
        $final_query = "";
        $query = "SHOW TABLES";
        $result = mysqli_query($connect, $query);
        if ($result) {
            $tables = array();
            while ($row = mysqli_fetch_row($result)) {
                if ($row[0] !== 'country' && $row[0] !== 'login') {
                    $tables[] = $row[0];
                }
            }
            foreach ($tables as $table) {
                $table_query = "SELECT id, Title, nop, timelimit, photo, tlimit, coo, status FROM $table WHERE 1=1";
                if (!empty($minimum_price) && !empty($maximum_price)) {
                    $table_query .= " AND timelimit BETWEEN $minimum_price AND $maximum_price";
                }
                if (!empty($brand)) {
					$brand_filter = implode("','", $brand);
					$table_query .= " AND status IN('" . implode("','", $brand) . "')";
				}				
                if (!empty($ram)) {
                    $ram_filter = implode("','", $ram);
                    $table_query .= " AND nop IN('" . implode("','", $ram) . "')";
                }
                if (!empty($storage)) {
                    $storage_filter = implode("','", $storage);
                    $table_query .= " AND vlink IN('" . implode("','", $storage) . "')";
                }
                $final_query .= "($table_query) UNION ";
            }
            $final_query = rtrim($final_query, " UNION ");
            $statement = $connect->prepare($final_query);
            $statement->execute();
            $result = $statement->get_result();
            $output = '';
            if ($result->num_rows > 0) {
                $data = $result->fetch_all(MYSQLI_ASSOC);
                foreach ($data as $row) {
                    $output .= '
                            <div class="col-sm-4 col-lg-3 col-md-3">
                                <div style="border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:16px; height:450px;">
                                    <img src="' . $row['photo'] . '" alt="" class="img-responsive" >
                                    <h4 style="text-align:center;" class="text-danger" ><a href="detail.php?name=' . $row['coo'] . '&&id=' . $row['id'].'">' . $row['Title'] . '</a><br /></h4>';

                    if (!empty($row['tlimit'])) {
                        $output .= 'Time Limit:' . $row['tlimit'] . '<br />';
                    }

                    if (!empty($row['nop'])) {
                        $output .= 'No. of Players: ' . $row['nop'] . ' <br />';
                    }

                    $output .= '
                                </div>
                            </div>';

                }
            } else {
                $output = '<h3>No Data Found</h3>';
            }
            echo $output;
        } else {
            echo "Error fetching tables.";
        }
    } else {

    }
} else {
    echo "Error: Action parameter is not set.";
}
?>
