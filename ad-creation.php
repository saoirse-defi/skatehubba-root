<?php 
    require('inc/config.php'); 
    include('inc/header.php');
?>

<div class="container" id="ad-form">
    <h2>Add item to marketplace:</h2>
    <form method="POST" action="ad_creation.php" enctype='multipart/form-data'>
        <div class="form-group">
            <label>Item: </label> <br>
            <input type="text" name="title" class="spot-control" required/>
        </div>
        <div class="form-group">
            <label>Description: </label> <br>
            <input type="text" name="description" class="spot-control" required/>
        </div>
        <div class="form-group">
            <label>Contact: </label> <br>
            <input type="text" name="contact" class="spot-control" required/>
        </div>
        <div class="form-group">
            <label>Asking Price: </label> <br>
            <input type="text" name="price" class="spot-control" required/>
        </div>
        <div class="form-group">
            <label for="county">County: </label><br>
            <select name='county' id='county'>
                <option value="Antrim">Antrim</option>
                <option value="Armagh">Armagh</option>
                <option value="Carlow">Carlow</option>
                <option value="Cavan">Cavan</option>
                <option value="Clare">Clare</option>
                <option value="Cork">Cork</option>
                <option value="Derry">Derry</option>
                <option value="Donegal">Donegal</option>
                <option value="Down">Down</option>
                <option value="Dublin">Dublin</option>
                <option value="Fermanagh">Fermanagh</option>
                <option value="Galway">Galway</option>
                <option value="Kerry">Kerry</option>
                <option value="Kildare">Kildare</option>
                <option value="Kilkenny">Kilkenny</option>
                <option value="Laois">Laois</option>
                <option value="Leitrim">Leitrim</option>
                <option value="Limerick">Limerick</option>
                <option value="Longford">Longford</option>
                <option value="Louth">Louth</option>
                <option value="Mayo">Mayo</option>
                <option value="Meath">Meath</option>
                <option value="Monaghan">Monaghan</option>
                <option value="Offaly">Offaly</option>
                <option value="Roscommon">Roscommon</option>
                <option value="Sligo">Sligo</option>
                <option value="Tipperary">Tipperary</option>
                <option value="Tyrone">Tyrone</option>
                <option value="Waterford">Waterford</option>
                <option value="Westmeath">Westmeath</option>
                <option value="Wexford">Wexford</option>
                <option value="Wicklow">Wicklow</option>
            </select><br><br>

            <label>Include a photo of the item here:  </label>
            <input type='file' name='ad-photo' required>
        </div>
        <button type="submit" name='submit-ad' class="btn btn-primary">Submit</button>
    </form>
</div>


<?php 
    require('inc/footer.php');
?>