<?php
if(isset($_POST["feedbackSubmit"])){
    $feedback = isset($_POST['feedbackTextarea']) ? $_POST['feedbackTextarea'] : '';
    $studyPart = isset($_POST['study_part']) ? $_POST['study_part'] : '';
    $prolificID = isset($_COOKIE['prolific_id']) ? $_COOKIE['prolific_id'] : '';

    $path = '';
    if($studyPart == '1'){
        $path = realpath(__DIR__) . "/results/submissions_part1";
    } elseif ($studyPart == '2'){
        $path = realpath(__DIR__) . "/results/submissions_part2";
    }

    if(file_exists($path)){
        /**
        print_r("im if");
        print("<br>");
        $dataSrc = $path;
        $dataFile = fopen($dataSrc, "r+") or die("Unable to open file!");
        while(false !== ($csv = fgetcsv($dataFile))) {
            if($csv[0] == $prolificID){
                print("im inneren if");
                print("<br>");
                $csv[44] = $feedback;
                var_dump($csv);
                print($feedback);
                fputcsv($dataFile, $csv);
                break;
            }
        }
        fclose($dataFile);
*/ 
        $feedback = str_replace(array("\r", "\n"), "___", $feedback);
        $dataSrc = $path . ".csv";
        $dataDest = $path . "temp.csv";

        $dataFile = fopen($dataSrc, "r") or die("Unable to open file!");
        $outFile = fopen($dataDest, "w") or die("Unable to open file!");

        while(false !== ($csv = fgetcsv($dataFile))) {
            if($csv[0] == $prolificID){
                if(strlen($csv[44]) <= 1){
                    $csv[44] = $feedback;
                }
            }
            fputcsv($outFile, $csv);
        }

        fclose($dataFile);
        fclose($outFile);

        rename($dataDest, $dataSrc); //rename dest to the source name, this will overwrite $dataSrc with $dataDest and remove $dataDest

    }
}

if(isset($_POST['demographicSubmit'])){
    //Collect form data
    $ageInput = isset($_POST['ageInput']) ? $_POST['ageInput'] : '';
    $genderSelect = isset($_POST['genderSelect']) ? $_POST['genderSelect'] : '';
    $eduSelect = isset($_POST['eduSelect']) ? $_POST['eduSelect'] : '';
    $proStatusSelect = isset($_POST['proStatusSelect']) ? $_POST['proStatusSelect'] : '';
    $drivingLicenseInput = isset($_POST['drivingLicenseInput']) ? $_POST['drivingLicenseInput'] : '';
    $drivingFreqSelect = isset($_POST['drivingFreqSelect']) ? $_POST['drivingFreqSelect'] : '';
    $drivingDistSelect = isset($_POST['drivingDistSelect']) ? $_POST['drivingDistSelect'] : '';
    $IntAutoDriveQuestion1 = isset($_POST['IntAutoDriveQuestion1']) ? $_POST['IntAutoDriveQuestion1'] : '';
    $IntAutoDriveQuestion2 = isset($_POST['IntAutoDriveQuestion2']) ? $_POST['IntAutoDriveQuestion2'] : '';
    $IntAutoDriveQuestion3 = isset($_POST['IntAutoDriveQuestion3']) ? $_POST['IntAutoDriveQuestion3'] : '';

    $studyPartDemo = isset($_POST['demo_part']) ? $_POST['demo_part'] : '';
    $prolificID = isset($_COOKIE['prolific_id']) ? $_COOKIE['prolific_id'] : '';

    // The header row of the CSV.
    $header = "ProlificID,Age,Gender,Education,Job,License,DrivingFrequency,Distance,InterestQ1,InterestQ2,InterestQ3\n";

    // The data of the CSV.
    $newdata = "$prolificID,$ageInput,$genderSelect,$eduSelect,$proStatusSelect,$drivingLicenseInput,$drivingFreqSelect,$drivingDistSelect,$IntAutoDriveQuestion1,$IntAutoDriveQuestion2,$IntAutoDriveQuestion3\n";

    //path to csv
    $path = '';
    if($studyPartDemo == '1'){
        $path = realpath(__DIR__) . "/results/demographic_part1.csv";
    } elseif ($studyPartDemo == '2'){
        $path = realpath(__DIR__) . "/results/demographic_part2.csv";
    }

    if(file_exists($path)){
        $dataSrc = $path;
        $dataFile = fopen($dataSrc, "r+") or die("Unable to open file!");
        $duplicate = false;
        while(false !== ($csv = fgetcsv($dataFile))) {
            if($csv[0] == $prolificID){
                $duplicate = true;
                break;
            }
        }
        if(!$duplicate){
            fwrite($dataFile, $newdata);
        }
        fclose($dataFile);

    } else {
        file_put_contents($path, $header . $newdata);
    }
}

if (isset($_POST['questionsSubmit'])) {
    // Collect the form data.
    //$inlRadOpt1 = isset($_POST['inlineRadioOptions']) ? $_POST['inlineRadioOptions'] : '';
    //$inlRadOpt2 = isset($_POST['inlineRadioOptions2']) ? $_POST['inlineRadioOptions2'] : '';
    //$inlRadOpt3 = isset($_POST['inlineRadioOptions3']) ? $_POST['inlineRadioOptions3'] : '';
    $SARTQ1 = isset($_POST['SARTQuestion1']) ? $_POST['SARTQuestion1'] : '';
    $SARTQ2 = isset($_POST['SARTQuestion2']) ? $_POST['SARTQuestion2'] : '';
    $SARTQ3 = isset($_POST['SARTQuestion3']) ? $_POST['SARTQuestion3'] : '';
    $SARTQ4 = isset($_POST['SARTQuestion4']) ? $_POST['SARTQuestion4'] : '';
    $SARTQ5 = isset($_POST['SARTQuestion5']) ? $_POST['SARTQuestion5'] : '';
    $SARTQ6 = isset($_POST['SARTQuestion6']) ? $_POST['SARTQuestion6'] : '';
    $SARTQ7 = isset($_POST['SARTQuestion7']) ? $_POST['SARTQuestion7'] : '';
    $SARTQ8 = isset($_POST['SARTQuestion8']) ? $_POST['SARTQuestion8'] : '';
    $SARTQ9 = isset($_POST['SARTQuestion9']) ? $_POST['SARTQuestion9'] : '';
    $SARTQ10 = isset($_POST['SARTQuestion10']) ? $_POST['SARTQuestion10'] : '';
    $TLXQ1 = isset($_POST['TLXQuestion1']) ? $_POST['TLXQuestion1'] : '';
    $PSQ1 = isset($_POST['PSQuestion1']) ? $_POST['PSQuestion1'] : '';
    $PSQ2 = isset($_POST['PSQuestion2']) ? $_POST['PSQuestion2'] : '';
    $PSQ3 = isset($_POST['PSQuestion3']) ? $_POST['PSQuestion3'] : '';
    $PSQ4 = isset($_POST['PSQuestion4']) ? $_POST['PSQuestion4'] : '';
    $TQ1 = isset($_POST['TrustQuestion1']) ? $_POST['TrustQuestion1'] : '';
    $TQ2 = isset($_POST['TrustQuestion2']) ? $_POST['TrustQuestion2'] : '';
    $TQ3 = isset($_POST['TrustQuestion3']) ? $_POST['TrustQuestion3'] : '';
    $TQ4 = isset($_POST['TrustQuestion4']) ? $_POST['TrustQuestion4'] : '';
    $TQ5 = isset($_POST['TrustQuestion5']) ? $_POST['TrustQuestion5'] : '';
    $TQ6 = isset($_POST['TrustQuestion6']) ? $_POST['TrustQuestion6'] : '';
    $CSUSQ1 = isset($_POST['CSUSQuestion1']) ? $_POST['CSUSQuestion1'] : '';
    $CSUSQ2 = isset($_POST['CSUSQuestion2']) ? $_POST['CSUSQuestion2'] : '';
    $PQ1 = isset($_POST['PerceptionQuestion1']) ? $_POST['PerceptionQuestion1'] : '';
    $PQ2 = isset($_POST['PerceptionQuestion2']) ? $_POST['PerceptionQuestion2'] : '';
    $PQ3 = isset($_POST['PerceptionQuestion3']) ? $_POST['PerceptionQuestion3'] : '';
    $PQ4 = isset($_POST['PerceptionQuestion4']) ? $_POST['PerceptionQuestion4'] : '';
    $PQ5 = isset($_POST['PerceptionQuestion5']) ? $_POST['PerceptionQuestion5'] : '';
    $PQ6 = isset($_POST['PerceptionQuestion6']) ? $_POST['PerceptionQuestion6'] : '';
    $PQ7 = isset($_POST['PerceptionQuestion7']) ? $_POST['PerceptionQuestion7'] : '';
    $PQ8 = isset($_POST['PerceptionQuestion8']) ? $_POST['PerceptionQuestion8'] : '';
    $PQ9 = isset($_POST['PerceptionQuestion9']) ? $_POST['PerceptionQuestion9'] : '';
    $PQ10 = isset($_POST['PerceptionQuestion10']) ? $_POST['PerceptionQuestion10'] : '';
    $OQ1 = isset($_POST['OwnQuestion1']) ? $_POST['OwnQuestion1'] : '';
    $OQ2 = isset($_POST['OwnQuestion2']) ? $_POST['OwnQuestion2'] : '';
    $OQ3 = isset($_POST['OwnQuestion3']) ? $_POST['OwnQuestion3'] : '';
    $OQ4 = isset($_POST['OwnQuestion4']) ? $_POST['OwnQuestion4'] : '';
    $OQ5 = isset($_POST['OwnQuestion5']) ? $_POST['OwnQuestion5'] : '';
    $OQ6 = isset($_POST['OwnQuestion6']) ? $_POST['OwnQuestion6'] : '';
    $OQ7 = isset($_POST['OwnQuestion7']) ? $_POST['OwnQuestion7'] : '';
    $OQ8 = isset($_POST['OwnQuestion8']) ? $_POST['OwnQuestion8'] : '';

    $DQ1 = isset($_POST['DistractorQuestion1']) ? $_POST['DistractorQuestion1'] : '';
    $DQ2 = isset($_POST['DistractorQuestion2']) ? $_POST['DistractorQuestion2'] : '';

    $attentionCheck1FailedBool = false;
    $attentionCheck2FailedBool = false;

    $questionPage = isset($_POST['current_page']) ? $_POST['current_page'] : '';
    $studyPart = isset($_POST['study_part']) ? $_POST['study_part'] : '';
    $condition = isset($_POST['condition']) ? $_POST['condition'] : '';
    //$inlRadOpt = htmlspecialchars($_POST['inlineRadioOptions']);
    $attentionCheckFailedNum = 0;
    
    $prolificID = isset($_COOKIE['prolific_id']) ? $_COOKIE['prolific_id'] : '';

    if ($DQ1 != '' && $DQ1 != "1") {
        $attentionCheck1FailedBool = true;
        $attentionCheckFailedNum++;
    }

    if ($DQ2 != '' && $DQ2 != "5") {
        $attentionCheck2FailedBool = true;
        $attentionCheckFailedNum++;
    }

    if (!isset($errors)) {
        $conditionText = "";
        if($condition == '1') $conditionText = "Visualization";
        if($condition == '0') $conditionText = "Baseline";

        $path = '';
        if($studyPart == '1'){
            $path = realpath(__DIR__) . "/results/submissions_part1.csv";
        } elseif ($studyPart == '2'){
            $path = realpath(__DIR__) . "/results/submissions_part2.csv";
        }
        //get old attentionCheckFailedNum
        $pageNum = substr($questionPage, 4, 1);
        $oldAttentionCheckFailedNum = 0;
        $oldCondition = "";
        $duplicateEntry = false;
        $entryCounter = 0;
        
        if(file_exists($path)){
            $fp = fopen($path, 'r') or die("Unable to open file!");
            $fp_temp = fopen($path, 'r') or die("Unable to open file!");
            while(false !== ($csv = fgetcsv($fp))) {
                if($csv[0] == $prolificID){
                    $entryCounter++;
                    $oldCondition = $csv[2];
                    if($entryCounter >= 2){
                        $duplicateEntry = true;
                        break;
                    }
                    if($pageNum == '2'){
                        $oldAttentionCheckFailedNum = $csv[1];
                        $oldCondition = $csv[2];
                    }
                }
            }
            fclose($fp);
        }

        $attentionCheckFailedNum += $oldAttentionCheckFailedNum;

        // The header row of the CSV.
        $header = "ProlificID,AttentioncheckFails,Condition,SARTQ1,SARTQ2,SARTQ3,SARTQ4,SARTQ5,SARTQ6,SARTQ7,SARTQ8,SARTQ9,SARTQ10,"
                . "TLXQ1,PSQ1,PSQ2,PSQ3,PSQ4,TQ1,TQ2,TQ3,TQ4,TQ5,TQ6,CSUSQ1,CSUSQ2,PQ1,PQ2,PQ3,PQ4,PQ5,PQ6,PQ7,PQ8,PQ9,PQ10,"
                . "OQ1,OQ2,OQ3,OQ4,OQ5,OQ6,OQ7,OQ8,Feedback\n";
        
        $emptyString = "";
        // The data of the CSV.
        $newdata = "$prolificID,$attentionCheckFailedNum,$conditionText,$SARTQ1,$SARTQ2,$SARTQ3,$SARTQ4,$SARTQ5,$SARTQ6,$SARTQ7,$SARTQ8,$SARTQ9,$SARTQ10,"
                . "$TLXQ1,$PSQ1,$PSQ2,$PSQ3,$PSQ4,$TQ1,$TQ2,$TQ3,$TQ4,$TQ5,$TQ6,$CSUSQ1,$CSUSQ2,$PQ1,$PQ2,$PQ3,$PQ4,$PQ5,$PQ6,$PQ7,$PQ8,$PQ9,$PQ10,"
                . "$OQ1,$OQ2,$OQ3,$OQ4,$OQ5,$OQ6,$OQ7,$OQ8,$emptyString\n";

        
        

        if(file_exists($path)){
            $dataSrc = $path;
            $dataFile = fopen($dataSrc, "a") or die("Unable to open file!");
            if($entryCounter < 2 && $oldCondition != $conditionText){
                fwrite($dataFile, $newdata);
            }
            fclose($dataFile);
    
        } else {
            file_put_contents($path, $header . $newdata);
        }
    }
}
?>