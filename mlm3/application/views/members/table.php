<!DOCTYPE html>
<html>
<head>
    <title>Site Title</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Bootstrap Css-->
    <link rel="stylesheet" href="<?php  echo base_url(); ?>public/css/bootstrap.min.css" />

    <!--Custom Css-->
    <link rel="stylesheet" href="<?php  echo base_url(); ?>public/css/style.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css" />

    <!--Media Queries Css-->
    <link rel="stylesheet" href="<?php  echo base_url(); ?>public/css/screen.css" />

    <!--Jquery-1.11.1.min.js-->
    <script src="<?php  echo base_url(); ?>public/js/jquery-1.11.3.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>

    <!--Bootstrap Jquery-->
    <script src="<?php  echo base_url(); ?>public/js/bootstrap.min.js"></script>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/
           html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/
           respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="yellow-line"></div>
<?php $this->load->view('members/dashboard_top'); ?>
<div class="clearfix"></div>
<div class="container">
    <div class="refer-points-box">
    <div class="row">
    <div class="col-md-12">

    <table id="example" class="display" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>#</th>
            <th>You</th>
            <th>Level-1</th>
            <th>Level-2</th>
            <th>Level-3</th>
            <th>Level-4</th>
            <th>Level-5</th>
            <th>Level-6</th>
            <th>Level-7</th>
            <th>Level-8</th>
            <th>Level-9</th>
            <th>Level-10</th>


        </tr>
        </thead>
        <tbody id="myTable">

        <?php

        foreach($table as $row) {?>
            <tr>
                <th></th>
                <td><a href="<?php echo base_url();?>dashboard/tree/<?php echo $row['parent_id'] ?>"><?php echo $row['parent_name'] ?></a> </td>

                <td><a href="<?php echo base_url();?>dashboard/tree/<?php echo $row['child_id_1'] ?>"><?php echo $row['child_name_1'] ?></a> </td>

                <td><a href="<?php echo base_url();?>dashboard/tree/<?php echo $row['child_id_2'] ?>"><?php echo $row['child_name_2'] ?></a> </td>

                <td><a href="<?php echo base_url();?>dashboard/tree/<?php echo $row['child_id_3'] ?>"><?php echo $row['child_name_3'] ?></a> </td>

                <td><a href="<?php echo base_url();?>dashboard/tree/<?php echo $row['child_id_4'] ?>"><?php echo $row['child_name_4'] ?></a> </td>

                <td><a href="<?php echo base_url();?>dashboard/tree/<?php echo $row['child_id_5'] ?>"><?php echo $row['child_name_5'] ?></a> </td>

                <td><a href="<?php echo base_url();?>dashboard/tree/<?php echo $row['child_id_6'] ?>"><?php echo $row['child_name_6'] ?></a> </td>

                <td><a href="<?php echo base_url();?>dashboard/tree/<?php echo $row['child_id_7'] ?>"><?php echo $row['child_name_7'] ?></a> </td>

                <td><a href="<?php echo base_url();?>dashboard/tree/<?php echo $row['child_id_8'] ?>"><?php echo $row['child_name_8'] ?></a> </td>

                <td><a href="<?php echo base_url();?>dashboard/tree/<?php echo $row['child_id_9'] ?>"><?php echo $row['child_name_9'] ?></a> </td>

                <td><a href="<?php echo base_url();?>dashboard/tree/<?php echo $row['child_id_10'] ?>"><?php echo $row['child_name_10'] ?></a> </td>




            </tr>    <?php } ?>

        </tbody>
    </table>
    </div>
    </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="footer">
    <div class="container">
        <div class="col-xs-12">
            <div class="copyright">
                &copy 2015 Website Name. All rights reserved. <a href="#">Privacy Ploicy</a> | <a href="#">Terms of Service</a>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="yellow-line"></div>

<!--Marquee Jquery-->
<script src="<?php  echo base_url(); ?>public/js/jquery.marquee.min.js"></script>

<script>
    $(function (){
        $('.footer-gallery').marquee({
            speed: 50000,
            gap: 0,
            delayBeforeStart: 0,
            direction: 'left',
            duplicated: true
        });
    });
    $(".right-menu-button").click(function(){
        $(".pop-over-menu").slideToggle(500);
    });
</script>
<script>
    $(document).ready(function() {
        $('#example').DataTable( {
            "pagingType": "full_numbers"
        } );
    } );
</script>
<script>
    var table = document.getElementsByTagName('table')[0],
        rows = table.getElementsByTagName('tr'),
        text = 'textContent' in document ? 'textContent' : 'innerText';
    console.log(text);

    for (var i = 1, len = rows.length; i < len; i++){
        rows[i].children[0][text] = i + '' + rows[i].children[0][text];
    }
</script>
</body>
</html>