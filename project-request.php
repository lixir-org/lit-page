<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Project Request Form</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel='icon' href='./images/brand_logo.png' type='image/x-icon'/>
    <link rel="stylesheet" href="css/project-request.css">
</head>

<body> <?php require_once "./Fragments/header.php" ?>

    <main>
        <section class="form_container">
            <h3 class="title">Project Request Form</h3>
            <?php
                $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                if(strpos($url, 'sent') !== false){
                    echo "<div style='color: green; font-size: 18px; font-weight: bold; padding: 20px;'>Project Request Sent Successfully!!!.</div>";
                }
                if(strpos($url, 'failed') !== false){
                    echo "<div style='color: red; font-size: 18px; font-weight: bold; padding: 20px;'>Request Not Sent!!!<br> Please Try Again Later.</div>";
                }
                if(strpos($url, 'file-error') !== false){
                    echo "<div style='color: red; font-size: 18px; font-weight: bold; padding: 20px;'>You can upload only image or pdf file.</div>";
                }
            ?>
            <form action="submit_request.php" method="POST"">
                <div class="form_group">    
                    <label for="p_info">General Project Information</label>
                    <input type="text" placeholder="Project Name" name="projName" required>
                    <input type="text" placeholder="Project Duration" name="projDur" required>
                    <input type="text" placeholder="Requested By">
                </div>
                <div class="form_group">
                    <label for="c_info">Customer Information</label>
                    <input type="text" placeholder="Customer Name" name="cusName" required>
                    <input type="text" placeholder="Organization Name" name="orgName" required>
                </div>
                <div class="form_group">
                    <label for="project_scope">Project Scope</label>
                    <textarea name="scope" id="p_scope" placeholder="Project Description" cols="30" rows="5"></textarea>
                    <input type="text" placeholder="Project High-Level Objectives" name="highObj" required>
                    <input type="text"
                        placeholder="Project Low-Level Objectives" name="lowObj" required>
                </div>
                <div class="form_group">
                    <input type="button" value="Attach File" id="attachFile" class="btn">
                    <input type="file" name="projFile" id="file">
                </div>

                <input type="submit" value="Submit" name="submit" class="btn submit"> <br>
                <input type="reset" value="Reset Form" class="reset btn">
            </form>
        </section>
    </main>
    <?php require_once "./Fragments/footer.php" ?>
</body>

<script>
    let attachFile = document.getElementById("attachFile");
    let fileInput = document.getElementById("file");
    attachFile.addEventListener("click", () => { fileInput.style.visibility = "visible" })
</script>

</html>