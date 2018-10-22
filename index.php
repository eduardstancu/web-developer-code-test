<!DOCTYPE html>
<TITLE>JSON FORMULAR TEST</TITLE>

<head>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
</head>

<body>

    <div class="container">
        <div class="row">
            <h1>Insert an image coresponding to the description</h1>
        <?php
        require_once("clsOperations.php");
        $Obj = new DataOperations();
        $data = file_get_contents("test_data.json");
        $decodData = json_decode($data, true);
        ?>
        
        <?php    
        foreach($decodData as $items){ ?>
        <form id="regform_<?php echo $items["id"] ;?>" method="post">
        <div class="form-inline">  
        <div  class="input-group" >  
        <input type="text" class="form-control col-1" id="id"   value="<?php echo $items["id"] ;?>">
        <input type="text" class="form-control col-7" id="descr<?php echo $items["id"] ;?>"   value="<?php echo $items["descr"]; ?>">
 
        <input type="file" class="input-group-prepend" name="file" id="file<?php echo $items["id"] ;?>" accept="image/*">

        <button type="submit" class="btn btn-primary" onclick="sendData(<?php echo $items['id'] ; ?>); return false;">Save</button>
        
        <?php
        if ($Obj->verifyDataSaved($items["id"])==true){
            echo '<span id="situation'. $items["id"] .'"> Saved</span>';
        } else {
            echo '<span id="situation'. $items["id"] .'"></span>';
        }
        ?>
        </div>    
        </div>
        </form>
        <?php
        }
        
        ?>
        


        </div>
        <div id="testdiv"></div><div id="img_msg"></div><div id="datacleared"></div>


    </div>
    <div class="container">
        <div class="row">
        <form>
        <button type="submit" class="btn btn-primary" onclick="clearData()">Clear all data</button>
        <button type="submit" class="btn btn-primary" onclick="showData()">Show all Data in Database</button>
        </form>
        </div>
    </div>
    <div class="container">
        <div>
    <?php
    // Show the data saved
    
    
    $Obj->retrieveAllData();

    ?>
        </div>
    </div>
<script>
 function sendData(id) {
    // alert(id);
     descr = document.getElementById("descr"+id).value;
    // alert(descr);
     filepath = document.getElementById("file"+id).value;
    // alert(filepath);
     filepath = 'img/'+filepath.substring(filepath.indexOf('h') + 2);
    // alert(filepath);
    if (id=="") { 
        document.getElementById("testdiv").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                copy_file(id); // call the function who copy the file to the new destination
                document.getElementById("testdiv").innerHTML = this.responseText;
                document.getElementById("situation"+id).innerHTML = "Saved";

            }
        };
        xmlhttp.open("POST", "saveData.php?id="+id+"&descr="+descr+"&filepath="+filepath, true);
        // xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send();
    }
}

function copy_file(id){
    //alert("copy_file "+id);
    var form = new FormData();
    var myFormData = document.getElementById('file'+id).files[0]; //get the file 
    
    if (myFormData) {   //Check the file is emty or not
        form.append('inputFile', myFormData); //append files
    }    
    $.ajax({
            type: 'POST',               
            processData: false,
            contentType: false, 
            data: form,
            url: "saveFiles.php", 
            dataType : 'json',  
            success: function(jsonData){
                if(jsonData == 1)
                    $('#img_msg').html("Image Uploaded Successfully");
                else
                    $('#img_msg').html("Error While Image Uploading");
            }
    });
}


function clearData() {
// Clear the table
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                  
                window.location.reload();
                document.getElementById("datacleared").innerHTML = " Data were cleared";  
            }
        };
        xmlhttp.open("POST", "clearData.php", true);
        xmlhttp.send();
    }


function showData() {
// Show all the data in database
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
        
        xmlhttp.open("POST", "showData.php", true);
        xmlhttp.send();
    };
}
</script>
</body>


</html>