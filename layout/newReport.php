<label for="txtDescription">Description</label>
<input type="text" id="txtDescription"><br>
<label for="filSignature">Signature</label>
<input type="file" id="filSignature"><br>
<label for="selCustomer">Customer</label>
<label for="txtName"></label>
<select class="select-customer">

</select><button onclick="newCustomerWin('<?php $panelname = "edit-report";echo $panelname ?>')">new</button>
<div>
    <div>
        <button onclick="newActivityWin('<?php echo $panelname?>')">add</button>

    </div>
    <div>
        <div><p id="type">testbla</p><p id="description">mdmjnfdfkmjnhdfdnhhmzdfsg</p><button id="remove">remove</button></div>
    </div>
</div>
<?php include_once "popup.php";?>