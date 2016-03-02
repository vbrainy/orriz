<!DOCTYPE html>
<html>
<head>
<!--    <style>-->
<!--        #myDIV {-->
<!--            height: 250px;-->
<!--            width: 400px;-->
<!--            padding: 10px;-->
<!--            margin: 15px;-->
<!--            border: 5px solid red;-->
<!--            background-color: lightblue;-->
<!--        }-->
<!--    </style>-->
    <link rel="stylesheet" href="<?php  echo base_url(); ?>public/css/tree.css" />
</head>
<body>

<p>Click the button to get the height and width of div, including padding and border (using both offsetHeight and offsetWidth).</p>

<button onclick="myFunction()">Try it</button>


    <div style="overflow-x: auto; overflow-y:auto" class="tree" id="tree">
        <?php echo $child; ?>
    </div>



<script>
    function myFunction() {
        var elmnt = document.getElementById("tree");
        var txt = "Height including padding and border: " + elmnt.offsetHeight + "px<br>";
        txt += "Width including padding and border: " + elmnt.offsetWidth + "px";
        document.getElementById("demo").innerHTML = txt;
    }
</script>

</body>
</html>
