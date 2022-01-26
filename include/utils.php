<?php
/**
 * configures file mode can be either of value 'JSON' for JSON files or 'CSV' for CSV file format
 */
define('FILE_MODE','CSV');

/***
 * @param string $json_file_name
 * @return array an associative array containing loaded data from the json file
 */
function loadAndDecodeJsonFile(string $json_file_name):array{
    return json_decode(file_get_contents($json_file_name),true);
}

/**
 * @param string $csv_filen_name
 * @return array
 */
function loadAndDecodeCSVFIle(string $csv_filen_name):array{
    $file =fopen($csv_filen_name,'r');
    $data=array();
    while(!feof($file)){
        $data[]=fgetcsv($file);
    }
    return $data;
}

/**
 * used to retreive students's data from the data
 * @return array
 */
function getStudentsData():array{
    if(constant('FILE_MODE')=='JSON'){
        return loadAndDecodeJsonFile('data/students.json');
    }elseif(constant('FILE_MODE')=='CSV'){
        $csvArray=loadAndDecodeCSVFIle('data/students.csv');
        for($i=1;$i<sizeof($csvArray);$i++) {
            $data[]=array('name'=>$csvArray[$i][0],
                'email'=>$csvArray[$i][1],
                'phone'=>$csvArray[$i][2],
                'enrolNbr'=>$csvArray[$i][3],
                'dateAdmission'=>$csvArray[$i][4]);
        }
        return $data;
    }
    else return array();
}
function getPaymentsData():array{
    if(constant('FILE_MODE')=='JSON'){
        return loadAndDecodeJsonFile('data/payments.json');
    }elseif(constant('FILE_MODE')=='CSV'){
        $csvArray=loadAndDecodeCSVFIle('data/payments.csv');
        for($i=1;$i<sizeof($csvArray)-1;$i++) {
            //TODO: change index names
            $data[]=array('name'=>$csvArray[$i][0],
                'paymentSchudule'=>$csvArray[$i][1],
                'billNumber'=>$csvArray[$i][2],
                'amountPaid'=>$csvArray[$i][3],
                'balanceAmount'=>$csvArray[$i][4],
                'date'=>$csvArray[$i][5]);
        }
        return $data;
    }

    else return array();
}