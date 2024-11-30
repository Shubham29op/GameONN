
<?php

//index.php

include ('database_connection.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> filter in php</title>

    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/jquery-ui.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <br />
            <h2 align="center">GameOn</h2>
            <br />
            <div class="col-md-3">
                <div class="list-group">
                    <h3>Time(in minutes)</h3>
                    <input type="hidden" id="hidden_minimum_price" value="0" />
                    <input type="hidden" id="hidden_maximum_price" value="300" />
                    <p id="price_show">0 - 300</p>
                    <div id="price_range"></div>
                </div>
                <div class="list-group">
                    <h3>Status</h3>
                    <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
                        <?php

                        $query = "SHOW TABLES";
                        $result = mysqli_query($connect, $query);
                        if ($result) {
                            while ($row = mysqli_fetch_row($result)) {
                                $table_name = $row[0];
                                if ($table_name !== 'country' && $table_name !== 'login') {
                                    $status_query = "SELECT DISTINCT(status) FROM $table_name ORDER BY id DESC";
                                    $status_statement = mysqli_query($connect, $status_query);
                                    $status_result = mysqli_fetch_all($status_statement, MYSQLI_ASSOC);
                                    foreach ($status_result as $status_row) {
                                        ?>
                                        <div class="list-group-item checkbox">
                                            <label><input type="checkbox" class="common_selector brand"
                                                    value="<?php echo $status_row['status']; ?>">
                                                <?php echo $status_row['status']; ?>
                                            </label>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                        }

                        ?>
                    </div>
                </div>

                <div class="list-group">
                    <h3>No. Of Players</h3>
                    <?php

                    $query = "SHOW TABLES";
                    $result = mysqli_query($connect, $query);
                    if ($result) {
                        while ($row = mysqli_fetch_row($result)) {
                            $table_name = $row[0];
                            if ($table_name !== 'country' && $table_name !== 'login') {
                                $size_query = "SELECT DISTINCT(nop) FROM $table_name ORDER BY nop DESC";
                                $size_statement = mysqli_query($connect, $size_query);
                                $size_result = mysqli_fetch_all($size_statement, MYSQLI_ASSOC);
                                foreach ($size_result as $size_row) {
                                    ?>
                                    <div class="list-group-item checkbox">
                                        <label><input type="checkbox" class="common_selector ram"
                                                value="<?php echo $size_row['nop']; ?>">
                                            <?php echo $size_row['nop']; ?>
                                        </label>
                                    </div>
                                    <?php
                                }
                            }
                        }
                    }

                    ?>
                </div>


            </div>

            <div class="col-md-9">
                <br />
                <div class="row filter_data">

                </div>
            </div>
        </div>

    </div>
    <style>
        #loading {
            text-align: center;
            background: url('loader.gif') no-repeat center;
            height: 150px;
        }
    </style>

    <script>
        $(document).ready(function () {

            filter_data();

            function filter_data() {
                $('.filter_data').html('<div id="loading" style="" ></div>');
                var action = 'fetch_data';
                var minimum_price = $('#hidden_minimum_price').val();
                var maximum_price = $('#hidden_maximum_price').val();
                var brand = get_filter('brand');
                var ram = get_filter('ram');
                var storage = get_filter('storage');
                $.ajax({
                    url: "fetch_data.php",
                    method: "POST",
                    data: { action: action, minimum_price: minimum_price, maximum_price: maximum_price, brand: brand, ram: ram, storage: storage },
                    success: function (data) {
                        $('.filter_data').html(data);
                    }
                });
            }

            function get_filter(class_name) {
                var filter = [];
                $('.' + class_name + ':checked').each(function () {
                    filter.push($(this).val());
                });
                return filter;
            }

            $('.common_selector').click(function () {
                filter_data();
            });

            $('#price_range').slider({
                range: true,
                min: 00,
                max: 300,
                values: [0, 300],
                step: 5,
                stop: function (event, ui) {
                    $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
                    $('#hidden_minimum_price').val(ui.values[0]);
                    $('#hidden_maximum_price').val(ui.values[1]);
                    filter_data();
                }
            });

        });
    </script>

</body>

</html>