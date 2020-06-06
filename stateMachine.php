
<?php
/**Author: Bill Yang
5 24 2020
This program is to implement a state machine diagram for a online tutoring website, more details please check courseDeckFlow.pdf.
The input file is stateMachine.csv, format likes 1>0>2 or 1>1>4, the three integers respectively means the cur_state, check conditions and next_state.
Some codes from "A simple function to return 2 Dimensional array by parsing a CSV file" of https://www.php.net/manual/en/function.fgetcsv.php
References
https://www.php.net/manual/en/function.fgetcsv.php
fgetcsv ( resource $handle [, int $length = 0 [, string $delimiter = ">" [, string $enclosure = '"' [, string $escape = "\\" ]]]] ) : array
 * another way to express parameters, [, string $delimiter = ">"], belong to not


https://raw.githubusercontent.com/ishaberry/Covid19Canada/master/timeseries_prov/cases_timeseries_prov.csv
https://www.php.net/manual/en/function.str-getcsv.php
https://www.php.net/manual/en/function.count.php
 */

 function get2DArrayFromCsv($file,$delimiter) {
    $twoDArray = array();
    if (($handle = fopen($file, "r")) !== FALSE) {
        $i = 0;
        //count()
        while (($lineArray = fgetcsv($handle, 4000, $delimiter)) !== FALSE) {
            //empty line count 1, //TRANSITION TABLE count 1
            //1>1>4 count 3
            count($lineArray);
            if(count($lineArray) > 2 &&
                //the second line of csv: //CUR_STATE>INPUT>NEXT STATE count 3 as well
                is_numeric($lineArray[0] )){
                for ($j = 0; $j < count($lineArray); $j++) {
                   $twoDArray[$i][$j] = $lineArray[$j];
                }
            }else{
                continue;
            }
            $i++;
        }
    }
    fclose($handle);
    return $twoDArray;
}

function getPageContentFromCsv($file,$delimiter) {
    $twoDArray = array();
    if (($handle = fopen($file, "r")) !== FALSE) {
        $i = 0;
        //count()
        while (($lineArray = fgetcsv($handle, 4000, $delimiter)) !== FALSE) {
            //empty line count 1, //TRANSITION TABLE count 1
            count($lineArray);count($lineArray);
            if(
                //the second line of csv: //CUR_STATE>INPUT>NEXT STATE count 3 as well
                is_numeric($lineArray[0] )){
                for ($j = 0; $j < count($lineArray); $j++) {
                    $twoDArray[$i][$j] = $lineArray[$j];
                }
            }else{
                continue;
            }
            $i++;
        }
    }
    fclose($handle);
    return $twoDArray;
}
function traverse($stateMachine){
    for ($row = 0; $row < count($stateMachine); $row++) {
        for ($col = 0; $col < count($stateMachine[$row]); $col++) {
            echo $stateMachine[$row][$col]." ";
        }
        echo "<br>";
    }
}

function search($stateMachine, $cur_state, $check){
    //avoid calculate count($stateMachine) every time for loop runs
    $rowMax = count($stateMachine);
    //not $row< count($stateMachine)
    for ($row = 0; $row < $rowMax; $row++) {
        //for ($col = 0; $col < count($stateMachine[$row])-1; $col++) {
            //if($stateMachine[$row][$col] == $cur_state && $stateMachine[$row][$col+1] == $check) {
            if($stateMachine[$row][0] == $cur_state && $stateMachine[$row][1] == $check) {
                return $stateMachine[$row][2];
            }
    }
    return("Item not found <br>");
}

function searchImageSrc($stateMachine, $pageNum){
    //avoid calculate count($stateMachine) every time for loop runs
    $rowMax = count($stateMachine);
    //not $row< count($stateMachine)
    for ($row = 0; $row < $rowMax; $row++) {
        if($row == $pageNum-1 && $stateMachine[$row][1] !== " ") {
                return $stateMachine[$row][1];
        }
    }
    return("Image path not found <br>");
}

function searchText($stateMachine, $pageNum){
    //avoid calculate count($stateMachine) every time for loop runs
    $rowMax = count($stateMachine);
    //not $row< count($stateMachine)
    for ($row = 0; $row < $rowMax; $row++) {
        if($row == $pageNum-1 && $stateMachine[$row][4] !== " ") {
            return $stateMachine[$row][4];
        }
    }
    return("Text not found <br>");
}
//the link among pages
$data2DArray = array();
//every delimiter ">" counts 1
$data2DArray = get2DArrayFromCsv("stateMachine.csv", ">");
//traverse($data2DArray);
//echo  "Result is ". search($data2DArray,6,0)."<br>";

//read the photo path
$dataPageContent = array();
//every delimiter ">" counts 1
$dataPageContent = getPageContentFromCsv("pageContent.csv", ",");
//traverse($dataPageContent);
$imageSrc = searchImageSrc($dataPageContent,1);

//read the text
$text = searchText($dataPageContent,1);