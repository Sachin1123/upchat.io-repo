<div style="max-width: 750px; width: 100%; margin: 0px auto;  padding: 15px;">

	<table class="table" style="transform: scale(.45) translate(-60%, -60%); border-collapse: collapse; width: 100%; margin: 0 0 10px;font-size:12px; color: #000;">
		<thead style="border: 1px solid #fff;">
			<tr style="background-color: #ccc; border-radius: 4px;">
			
                        <th style="padding:5px 10px; border:1px solid #fff; text-align:left; width:max-content; background:#66a7d5; color:#fff;">#</th>
                        <th style="padding:5px 10px; border:1px solid #fff; text-align:left; width:max-content; background:#66a7d5; color:#fff;">Name</th>
                        <th style="padding:5px 10px; border:1px solid #fff; text-align:left; width:max-content; background:#66a7d5; color:#fff;">LeadId</th>
                        <th style="padding:5px 10px; border:1px solid #fff; text-align:left; width:max-content; background:#66a7d5; color:#fff;">ChatId</th>
                        <th style="padding:5px 10px; border:1px solid #fff; text-align:left; width:max-content; background:#66a7d5; color:#fff;">CompanyName</th>
                        <th style="padding:5px 10px; border:1px solid #fff; text-align:left; width:max-content; background:#66a7d5; color:#fff;">CompanyKey</th>
                        <th style="padding:5px 10px; border:1px solid #fff; text-align:left; width:max-content; background:#66a7d5; color:#fff;">Username</th>
                        <th style="padding:5px 10px; border:1px solid #fff; text-align:left; width:max-content; background:#66a7d5; color:#fff;">Email</th>
                        <th style="padding:5px 10px; border:1px solid #fff; text-align:left; width:max-content; background:#66a7d5; color:#fff;">Phone</th>
                        <th style="padding:5px 10px; border:1px solid #fff; text-align:left; width:max-content; background:#66a7d5; color:#fff;">IpAddress</th>
                        <th style="padding:5px 10px; border:1px solid #fff; text-align:left; width:max-content; background:#66a7d5; color:#fff;">Reason</th>
                        <th style="padding:5px 10px; border:1px solid #fff; text-align:left; width:max-content; background:#66a7d5; color:#fff;">LeadStatus</th>
                        <th style="padding:5px 10px; border:1px solid #fff; text-align:left; width:max-content; background:#66a7d5; color:#fff;">Created At</th>
			</tr>
		</thead>
		<tbody>
		
      <?php
          if (!empty($result)) {
          
            foreach ($result as $key => $value) {  ?>
              <tr>
                <td style="padding: 5px 10px;"><?php echo $value->id; ?></td>
                <td style="padding: 5px 10px;"><?php echo $value->name; ?></td>
                <td style="padding: 5px 10px;"><?php echo $value->leadId; ?></td>
                <td style="padding: 5px 10px;"><?php echo $value->chatId; ?></td>
                <td style="padding: 5px 10px;"><?php echo $value->companyName; ?></td>
                <td style="padding: 5px 10px;"><?php echo $value->companyKey; ?></td>
                <td style="padding: 5px 10px;"><?php echo $value->username; ?></td>
                <td style="padding: 5px 10px;"><?php echo $value->email; ?></td>
                <td style="padding: 5px 10px;"><?php echo $value->phone; ?></td>
                <td style="padding: 5px 10px;"><?php echo $value->ipAddress; ?></td>
                <td style="padding: 5px 10px;"><?php echo $value->reason; ?></td>
                <td style="padding: 5px 10px;"><?php echo $value->leadStatus; ?></td>
                <td style="padding: 5px 10px;"><?php echo $value->created_at; ?></td>
              </tr>
          <?php } } ?>
	
		</tbody>
	</table>
</div>
