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

    <!--Media Queries Css-->
    <link rel="stylesheet" href="<?php  echo base_url(); ?>public/css/screen.css" />

    <!--Jquery-1.11.1.min.js-->
    <script src="<?php  echo base_url(); ?>public/js/jquery-1.11.3.min.js"></script>

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
            <div class="col-sm-3">
                <div class="referral-container">
                    <div class="referral-buttons-container">
                        <a class="referral-button" href="<?php echo base_url('dashboard/reference');?>">Refer A Friend</a>
                        <a href="<?php echo base_url('dashboard/tree');?>" class="referral-button">Your Referral Tree</a>
                        <a href="<?php echo base_url('dashboard/table'); ?>" class="referral-button">Your Referral table</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="referral-content-container">
                    <div class="error"><?php if(isset($message)){echo $message;} ?></div>
<!--                    <form role="form" method="post" action="--><?php //echo base_url('dashboard/buy'); ?><!--">-->
<!--                    <div class="referral-number">-->
<!--                        <p>Please Enter Points Quantity(Per Point price=--><?php //echo $setting['per_point_price']; ?><!--):</p>-->
<!--                        <input name="quantity" type="number"/> <button type="submit" name="enter" value="enter">Enter</button>-->
<!--                    </div>-->
<!---->
<!--                    </form>-->


                    <form action="<?php echo base_url('dashboard/buy');?>" method="post">

                        <h4>Please Select Number of Points You Want to buy</h4>

                             <?php foreach($point_price as $price){ ?>
                                 <div>
                        <label><input type="radio" name="Amount"  value="<?php echo $price['id'] ?>" required="required"> $<?php echo $price['price']; ?> = <?php echo $price['quantity']; ?> Points</label></div>
                                 <?php }?>
                        <input type="submit" name="submit" value="Buy">
                    </form>


                    <div class="referral-number">

<?php if(isset($amount)){
    echo "Points Total Quantity:= ".$quantity.'<br>';
    echo "Total ammount to pay:=".$amount.' '.$setting['currency'];
    echo '<form name="_xclick" action="https:/'.$setting['url'].'/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="'.$setting['email'].'">
<input type="hidden" name="currency_code" value="'.$setting['currency'].'">
<input type="hidden" name="item_number" value="points">
<input type="hidden" name="item_name" value="points">
<input type="hidden" name="amount" value="'.$amount.'">
<input type="image" src="https://www.paypalobjects.com/webstatic/en_US/btn/btn_buynow_pp_142x27.png" border="0" name="submit" alt="Make payments with PayPal - it\'s fast, free and secure!">
</form>';

} ?>                    </div>

                </div>
            </div>
            <div class="col-sm-3">
                <div class="points-container">
                    <div class="points-counting-container">
                        <div class="points-counting">
                            You have <span class="points-number-counting"><?php echo $points ?></span> Points
                        </div>
                    </div>
                </div>
                <div class="points-button-container">
                    <a href="<?php echo base_url('dashboard/buy'); ?>">	<button class="points-button">Buy Points</button></a>
                    <a href="<?php echo base_url('dashboard/reference'); ?>">	<button class="points-button">Earn FREE Points</button>   </a>

                </div>
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
</body>
</html>