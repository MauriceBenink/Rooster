<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="Jquery.js"></script>
    <link rel ="stylesheet" href = 'https://roosters.xedule.nl/Css/main.css?v=2.2'>
    <title>Document</title>


</head>
<body>
<div id="container">
        <div id = 'Form'>
            <a>klas : ITB4-1b</a>
            <button id = 'ao1'> AO1</button>
            <button id = 'ao2'> AO2</button>
            <button id = 'be1'> B1</button>
            <button id = 'be2'> B2</button>
            <button id = 'switch'>Custom invoer</button>
        </div>
</div>
        <script>
            vakken = "Clusterles,Clusterlessen";


            customthing = '<div>om meerdere vakken in the voeren moet je ze schijden met een komma en geen spaties (klas1,klas2,klas3)</div><form method="post">            <div id="site1"> Klasserooster:</div> <div class="inputboxes"> <input name="site1" type="text" placeholder="Xscedule link van je klassen rooster"></div>            <div id="site2"> keuzevak rooster:</div> <div class="inputboxes"> <input name="site2" type="text" placeholder="Xscedule link van je keuze vak rooster"></div>            <div id="keuzevak"> vak namen:</div> <div class="inputboxes"> <input name="vak" type="text" placeholder="naam van het vak om te verwijderen"></div>            <div class="buttons"> <input type="submit" value="Submit"></div>        </form>';
            $("#switch").click( function(){
                $("#Form").html(customthing);
            });
            $("#ao1").click(function(){
                link1 = "https://roosters.xedule.nl/Attendee/ScheduleCurrent/14308?Code=B-ITB4-1b&attId=1&OreId=34";
                link2 = "https://roosters.xedule.nl/Attendee/ScheduleCurrent/75056?Code=B-ITA4-1CL1&attId=1&OreId=34";
                vak = vakken;
                processer(link1,link2,vak);
            });
            $("#ao2").click(function(){
                link1 = "https://roosters.xedule.nl/Attendee/ScheduleCurrent/14308?Code=B-ITB4-1b&attId=1&OreId=34";
                link2 = "https://roosters.xedule.nl/Attendee/ScheduleCurrent/75057?Code=B-ITA4-1CL2&attId=1&OreId=34";
                vak = vakken;
                processer(link1,link2,vak);
            });
            $("#be1").click(function(){
                link1 = "https://roosters.xedule.nl/Attendee/ScheduleCurrent/14308?Code=B-ITB4-1b&attId=1&OreId=34";
                link2 = "https://roosters.xedule.nl/Attendee/ScheduleCurrent/75054?Code=B-ITB4-1CL1&attId=1&OreId=34";
                vak = vakken;
                processer(link1,link2,vak);
            });
            $("#be2").click(function(){
                link1 = "https://roosters.xedule.nl/Attendee/ScheduleCurrent/14308?Code=B-ITB4-1b&attId=1&OreId=34";
                link2 = "https://roosters.xedule.nl/Attendee/ScheduleCurrent/75055?Code=B-ITB4-1CL2&attId=1&OreId=34";
                vak = vakken;
                processer(link1,link2,vak);
            });

            function processer(link1,link2,vak){
                compiled = link1+"%%"+link2+"%%"+vak;
                compiled = compiled.replace(/&/g,"ENTEKEN");
                console.log(compiled);
                ajax_function("rooster",compiled);
            }


            function ajax_function(type,value = ''){
                data = {};
                data[type] = value;

                $.ajax({
                    type: 'POST',
                    url: 'ajax.php',
                    data: data,
                    success: function (x) {

                       window.location.replace("rooster.php"+x);
                    }
                })
            }
        </script>
<?php
if(isset($_POST['site1'])&&!empty($_POST['site1'])&&isset($_POST['site2'])&&!empty($_POST['site2'])&&isset($_POST['vak'])&&!empty($_POST['vak'])){
    $site1 = $_POST['site1'];
    $site2 = $_POST['site2'];
    $vak = $_POST['vak'];
    unset($_POST);
    echo "<script>
                link1 = '$site1';
                link2 = '$site2';
                vak = '$vak';
                processer(link1,link2,vak);
             </script>";
}
?>

</body>
</html>
