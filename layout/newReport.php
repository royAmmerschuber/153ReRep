<label for="txtDescription">Description</label>
<input type="text" id="txtDescription"><br>
<label for="filSignature">Signature</label>
<input type="file" id="filSignature"><br>
<label for="selCustomer">Customer</label>
<label for="txtName"></label>
<select class="select-customer">

</select>
<div>
    <div>

    </div>
    <div>
        <div><input type="text" placeholder="description"></div>
    </div>
</div>
<button onclick="newCustomerWin('<?php $panelname = "edit-report";echo $panelname ?>')">new</button>

<?php include_once "popup.php";?>