<?php
/**
 * configures file mode can be either of value 'JSON' for JSON files or 'CSV' for CSV file format
 */
define('FILE_MODE','CSV');

/**
 * constants for students data in the forms
 */
$STUDENT_ID='sid';
$STUDENT_NAME='student_name';
$STUDENT_EMAIL='student_email';
$STUDENT_PHONE='student_phone';
$STUDENT_ENROLL_NBR='enroll_number';
$STUDENT_ADMISSION_DATE='date_admission';

/**
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
    fclose($file);
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
        for($i=1;$i<sizeof($csvArray)-1;$i++) {
            $data[]=array(
                'id'=>$csvArray[$i][0],
                'name'=>$csvArray[$i][1],
                'email'=>$csvArray[$i][2],
                'phone'=>$csvArray[$i][3],
                'enrolNbr'=>$csvArray[$i][4],
                'dateAdmission'=>$csvArray[$i][5]);
        }
        return $data;
    }
    else return array();
}
/**
 * used to retreive payments's data from the data
 * @return array
 */
function getPaymentsData():array{
    if(constant('FILE_MODE')=='JSON'){
        return loadAndDecodeJsonFile('data/payments.json');
    }elseif(constant('FILE_MODE')=='CSV'){

        $csvArray=loadAndDecodeCSVFIle('data/payments.csv');
        for($i=1;$i<sizeof($csvArray)-1;$i++) {
            $data[]=array(
                'id'=>$csvArray[$i][0],
                'name'=>$csvArray[$i][1],
                'paymentSchudule'=>$csvArray[$i][2],
                'billNumber'=>$csvArray[$i][3],
                'amountPaid'=>$csvArray[$i][4],
                'balanceAmount'=>$csvArray[$i][5],
                'date'=>$csvArray[$i][6]);
        }
        return $data;
    }

    else return array();
}
function getStudentsIndex():int{
    $file_path='data/studentsCount';
    if(!file_exists($file_path)) {
        $file_pointer=fopen($file_path,'w');
        fclose($file_pointer);
    }
    $index=file_get_contents($file_path);
    return $index !=null? $index:0;
}
function increamentStudentsIndex(){
    file_put_contents('data/studentsCount',getStudentsIndex()+1);
}
function addStudentInCSV(array $studentData){

}
/**
 * takes post data and adds astudent with it or shows an error
 * @param array $studentData an array containing the student data
 * @return bool weather the opertaion was successfull or not
 */
function addStudentFromPostFields(){
    global $STUDENT_NAME,$STUDENT_EMAIL,$STUDENT_PHONE;
    $studentFields=array($STUDENT_NAME,$STUDENT_EMAIL,$STUDENT_PHONE);
    if(areAllFieldsSet($studentFields,'POST')){
        //add the student here
    }else{
        //not all data has been supplied
        die("<h1 color='red'>not all fields have been supplied !</h1>");
    }
}
function areAllFieldsSet(array $fields,string $method) :bool{

    foreach ($fields as $field){
        if($method=='GET' and !isset($_GET[$method]) or ($method =='POST' and !isset($_POST[$method]) ))
            return false;
    }
    return true;
}