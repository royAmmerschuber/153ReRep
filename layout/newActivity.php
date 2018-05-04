<label for="select-type">type</label><button onclick="newATypeWin('<?php $panelname = "edit-Activity";echo $panelname?>')">new</button>
<select class="select-location"></select>
<label for="txtDescription">Description</label>
<input type="text" id="txtDescription"><br>
<label for="filSignature">Signature</label>
<input type="file" id="filSignature"><br>
<label for="selCustomer">Customer</label>
<label for="select-location">location</label>
<select class="select-location"></select><button onclick="newLocationWin('<?php echo $panelname ?>')">new</button>

<?php include_once "popup.php";?>