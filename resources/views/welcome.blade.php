<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no"/>
    <title>Laravel ISBN Validator</title>
    <link rel="stylesheet" href="{{ URL::to("/") }}/css/sample.css">
    <script type="text/javascript" src="{{ URL::to("/") }}/js/sample.js"></script>
</head>
<body>
<div id="sample2">
    <div class='headline1'>
        BOOK ENTRY & ISBN VALIDATION
    </div>
    <div class='spacer'><br></div>
    <form onsubmit="validator(); return false;">
        <input type="text" id="bookName" class="title_box" value="" placeholder="Title"><br>
        <span class="responses" id="bookNameResp"></span><br>
        <input type="text" id="bookAuthor" class="title_box" value="" placeholder="Author"><br>
        <span class="responses" id="bookAuthorResp"></span><br>
        <input type="text" id="copyright" class="date_box" value="" placeholder="Copyright Date: MM/DD/YYYY"><br>
        <span class="responses" id="copyrightResp"></span><br>
        <input type="text" id="isbn" value="" placeholder="ISBN"><br>
        <span class="responses" id="isbnResp"></span><br>
        <button>Submit</button>
        <button onclick="clearEntries(); return false;">Clear</button>
    </form>

    <div id="responder" class="goodResponseHide"><span class="successful"> Submission successful. </span>
        <span class="greyText"> (Data can be stored or updated in database.)</span>
    </div>
    <br>
</div>

<div id="sample1">

    <span class='headline2'>ISBN VALIDATION EXAMPLES</span>

    <div class='examples'>
        <?php
        $line = '<input type="text" value="{isbn}" class="text_box" readonly="readonly"><br><span{class}> {response}</span><br>';
        foreach ($evaluated as $key => $sample) {

            $eval = $sample['err'];
            $textColor = $sample['valid'] ? " class='blackText'" : " class='redText'";
            echo str_replace(["{isbn}", "{response}", "{class}"], [$key, $eval, $textColor], $line) . "\n";
        }
        ?>
        <br>
        <a target="_blank" href="https://en.wikipedia.org/wiki/International_Standard_Book_Number">What is an
            ISBN?</a>
    </div>
</div>
</body>
</html>
