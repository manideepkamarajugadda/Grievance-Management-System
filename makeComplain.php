<form action="process.php?action=makeComplain" method="post">

<table width="600" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#336699" class="entryTable">
  <tr id="entryTableHeader">
    <td>:: Make Complains ::</td>
  </tr>
  <tr>
    <td class="contentArea"><div class="errorMessage" align="center"></div>
        <table width="100%" border="0" cellpadding="2" cellspacing="1" class="text">
          <tr align="center">
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr class="entryTable">
            <td class="label">&nbsp;Complain Type </td>
            <td class="content">
			<select name="compType" class="box">
				<option value="civil">Civil</option>
				<option value="criminal">Criminal</option>
				<option value="bail">Bail/Other</option>
		  </select>          </tr>
          <tr class="entryTable">
            <td class="label">&nbsp;Complain Title </td>
            <td class="content"><input name="compTitle" type="text" class="box" id="compTitle" value="" size="50" maxlength="100" /></td>
          </tr>

          <tr class="entryTable">
            <td valign="top" class="label">&nbsp;Complain Description </td>
            <td class="content"><textarea name="compDesc" cols="50" rows="6" class="box" id="compDesc"></textarea></td>
          </tr>
	<tr class="entryTable">
            <td class="label">&nbsp;Desired Attorney</td>
            <td class="content">
			<select name="AttorneyName" class="box">
				
				<option value="Any">Any</option>
				<option value="Att1">Attorney1</option>
				<option value="Att2">Attorney2</option>
				<option value="Att3">Attorney3</option>
				<option value="Att4">Attorney4</option>
				<option value="Att5">Attorney5</option>
				<option value="Att6">Attorney6</option>
				<option value="Att7">Attorney7</option>
		  </select>          </tr>


          <tr>
            <td width="200">&nbsp;</td>
            <td width="372">&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><input name="btnLogin" type="submit" id="btnLogin" value=" Make Complain  "></td>
          </tr>
      </table></td>
  </tr>
</table>
</form>
<center><img src="/images/2.png" height="500" width="800"></center>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>