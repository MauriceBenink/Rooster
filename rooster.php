<!DOCTYPE html>
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
<div id = 'mainpage'></div>
<script>
window.onload =function() {
    //what subject blocks to remove. (de namen van de blokken dat je wilt verwijderen)
    removeBlock = ["Clusterles", "Clusterlessen"];

    //main scedule  (klas zelf)
    site1 = "https://roosters.xedule.nl/Attendee/ScheduleCurrent/14308?Code=B-ITB4-1b&attId=1&OreId=34";

    //secondary scedule (ao/beheer rooster)
    site2 = "https://roosters.xedule.nl/Attendee/ScheduleCurrent/75056?Code=B-ITA4-1CL1&attId=1&OreId=34";

    <?php
    if (isset($_GET['site1']) && !empty($_GET['site1'])) {
        $site1 = str_replace("ENTEKEN", "&", $_GET['site1']);
        echo "site1 = '$site1';";
    }
    if (isset($_GET['site2']) && !empty($_GET['site2'])) {
        $site2 = str_replace("ENTEKEN", "&", $_GET['site2']);
        echo "site2 = '$site2';";
    }
    if (isset($_GET['vak']) && !empty($_GET['vak'])) {
        $vak = $_GET['vak'];
        echo "removeBlock = '$vak';";
        echo "removeBlock = removeBlock.split(',');";
    }
    echo "ajax_function('site',site1+'%&%'+site2);"
    ?>
};

    function main_page_handler(htmlCode){
        htmlCode = htmlCode.split('%&%&');
        mainpage =  $.parseHTML(htmlCode[0]);
        x=0;
        do{
            if(mainpage[x]['tagName']=="LINK"){
                delete mainpage[x];
            }
            ++x;
            if(mainpage.length<x+1){whileVar = false}else{whileVar=true}
        }while(whileVar);
        les = $(mainpage).find(".content > .Rooster.width5showTimedays > .Les > .LesCode");
        y=0;
        count =0;
        do{
            item = y;
            index =$(les).eq(y)[0]['title'];
            x=0;
            do{
                if((index).replace(/\s/g,'').toLowerCase() == (removeBlock[x]).toLowerCase()){
                    $(mainpage).find(".content > .Rooster.width5showTimedays > .Les ").eq(item-count).remove();
                    ++count;
                    found = true;
                }else{
                    found = false;
                }
                ++x;
                if(removeBlock.length<x+1||found){whileVar = false}else{whileVar=true}
            }while(whileVar);
            ++y;
            if(les.length < y+1){whileVar = false}else{whileVar=true}
        }while(whileVar);
        $( "#mainpage" ).append(mainpage);
        second_page_handler(htmlCode[1])
    }

    function second_page_handler(htmlCode){
        overlay = $.parseHTML(htmlCode);
        overlay = $(overlay).find(".content > .Rooster.width5showTimedays > .Les");
        $( "#mainpage > .main > .content >.Rooster.width5showTimedays  >.Les ").eq($( "#mainpage > .main > .content >.Rooster.width5showTimedays  >.Les ").length-1).after(overlay);
    }
    function ajax_function(type,value = ''){
        data = {};
        data[type] = value;

        $.ajax({
            type: 'POST',
            url: 'ajax.php',
            data: data,
            success: function (x) {
                x = x.split("%%");
                if(x[0] == 'true') {
                }else{
                    main_page_handler(x[1]);
                }
            }
        })
    }



</script>
</body>
</html>