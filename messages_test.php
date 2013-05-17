<?php 
	if(!isset($_SESSION))
	{
		session_start();
	}
?>
<div>
	<?php 
		$Index = new Index(); 
		$DBConn = $Index -> ConnectDB();
		
		$Query = 
		'select
			m.id,
			u.id as \'UserId\',
			m.Message,
			m.Message,
			concat(cast(case
				when month(m.DateFrom) = 1 then \'Enero\'
				when month(m.DateFrom) = 2 then \'Febrero\'
				when month(m.DateFrom) = 3 then \'Marzo\'
				when month(m.DateFrom) = 4 then \'Abril\'
				when month(m.DateFrom) = 5 then \'Mayo\'
				when month(m.DateFrom) = 6 then \'Junio\'
				when month(m.DateFrom) = 7 then \'Julio\'
				when month(m.DateFrom) = 8 then \'Agosto\'
				when month(m.DateFrom) = 9 then \'Septiembre\'
				when month(m.DateFrom) = 10 then \'Octubre\'
				when month(m.DateFrom) = 11 then \'Noviembre\'
				when month(m.DateFrom) = 12 then \'Diciembre\'
			end as char), \' \', day(m.DateFrom), \', \', year(m.DateFrom)) as \'Date\',
			date_format(m.DateFrom,\'%r\') as \'Time\',
			m.Title,
			concat_ws(\' \',u.FirstName,u.LastName) as \'Name\',
			t.id as \'TID\'
		from 
			udtmessage m
			join udtuser u
				on m.idUser = u.id
			join udtthread t
				on m.idThread = t.id
		where
			u.id = 1
			and t.idType = 1
		order by
			m.DateFrom desc';
				
		$Results = mysql_query($Query,$DBConn);
		
		if(@mysql_num_rows($Results) > 0)
		{
			while($row = @mysql_fetch_array($Results))
			{ ?>
				<div id="Messages">
						<div id="Message">
							<?php 
								echo 'Asunto:' . ' <span>' . $row['Title'] . '</span><br>';
								echo 'Por:' . ' <span>' . $row['Name'] . '</span><br>';
								echo 'Fecha:' . ' <span>' . $row['Date'] . ' - ' . $row['Time'] . '</span>'; 
							?>
						</div>
						<div>
					<?php
						if( strlen($row['Message']) > 600 )
						{
							$row['Message']=str_replace(chr(13),"<br>",$row['Message']);
							echo substr($row['Message'],0,600);
							echo ' '.'<a href="Message.php?id=' . $row['TID'] . '">Leer Mas...</a>';
						}
						else
						{
							$row['Message']=str_replace(chr(13),"<br>",$row['Message']);
							echo $row['Message'];
							echo ' '.'<a href="Message.php?id=' . $row['TID'] . '">Leer Mas...</a>';
						}?>
							</div>
						<?php	
						$QueryImages = 
						'select 
							mi.Title,
							mi.Path
						from 
							udtmessageimages mi
							join udtmessage m 
								on mi.idMessage = m.id
						where m.id = ' . $row['id'];
						
						$DBConn2 = $Index -> ConnectDB();
						$ImageResults = mysql_query($QueryImages,$DBConn2);
						
						if(mysql_num_rows($ImageResults) > 0)
						{?>
							<div style="margin-top:14px;text-align:center;">
								<?php
								while($rowImage = mysql_fetch_array($ImageResults))
								{?>
									<a target="_blank" href="Images/<?php echo $rowImage['Path'];?>">
										<img style="height:25%;width:25%;" alt="<?php echo $rowImage['Title']; ?>" src="Images/<?php echo $rowImage['Path'];?>">
									</a>
								<?php } ?>
							</div>
						<?php }
						if(isset($_SESSION['UserId']) && $_SESSION['UserId'] == 1)
						{ ?>
							<div style="width:100%;margin-top:10px;text-align:right;background:#99CCFF;">
								Herramientas de Usuario:
								<a href="MessageDelete.php?id=<?php echo $row['id'];?>">Borrar</a>, 
								<a href="MessageEdit.php?id=<?php echo $row['id'];?>">Modificar</a>,
								<a href="Reply.php?id=<?php echo $row['TID'];?>">Responder</a>
							</div>
						<?php } else if(isset($_SESSION['UserId'])) {?>
							<div style="width:100%;margin-top:10px;text-align:right;background:#99CCFF;">
								Herramientas de Usuario:
								<a href="Reply.php?id=<?php echo $row['TID'];?>">Responder</a>
							</div>
						<?php } ?>
				</div>						
			<?php }
			mysql_free_result($Results);
			mysql_close($DBConn);
		}
		else
		{
			@mysql_free_result($Results);
			mysql_close($DBConn);
		}
	?>
	<?php 
		$Index = new Index(); 
		$DBConn = $Index -> ConnectDB();
		
		$Query2 = 
		'select
			t.id,
			u.id as \'UserId\',
			th.Title as \'Theme\',
			concat(cast(case
				when month(t.DateFrom) = 1 then \'Enero\'
				when month(t.DateFrom) = 2 then \'Febrero\'
				when month(t.DateFrom) = 3 then \'Marzo\'
				when month(t.DateFrom) = 4 then \'Abril\'
				when month(t.DateFrom) = 5 then \'Mayo\'
				when month(t.DateFrom) = 6 then \'Junio\'
				when month(t.DateFrom) = 7 then \'Julio\'
				when month(t.DateFrom) = 8 then \'Agosto\'
				when month(t.DateFrom) = 9 then \'Septiembre\'
				when month(t.DateFrom) = 10 then \'Octubre\'
				when month(t.DateFrom) = 11 then \'Noviembre\'
				when month(t.DateFrom) = 12 then \'Diciembre\'
			end as char), \' \', day(t.DateFrom), \', \', year(t.DateFrom)) as \'Date\',
			date_format(t.DateFrom,\'%r\') as \'Time\',
			t.Title,
			concat_ws(\' \',u.FirstName,u.LastName) as \'Name\'
		from 
			udtthread t
			join udtuser u
				on t.idUser = u.id
			join udttheme th
				on t.idTheme = th.id
		order by
			t.DateFrom desc';
				
		$Results = mysql_query($Query2,$DBConn);
		
		if(@mysql_num_rows($Results) > 0)
		{
			while($row = mysql_fetch_array($Results))
			{ ?>
				<div id="Thread" style="display:none;">
					<table cellpadding="0" cellspacing="0">
						<tr>
							<?php if(strlen($row['Title']) > 30) { ?>
								<td nowrap>
									<a href="Message.php?id=<?php echo $row['id']; ?>"><?php echo substr($row['Title'],0,30) . '...'; ?></a>
								</td>
							<?php } else {?>
								<td nowrap>
									<a href="Message.php?id=<?php echo $row['id']; ?>"><?php echo $row['Title']; ?></a>
								</td>
							<?php } ?>
							<td nowrap><?php echo $row['Name']; ?></td>
							<td nowrap><?php echo $row['Date'] . ' - ' . $row['Time']; ?></td>
							<!--<td nowrap><?php echo $row['Theme']; ?></td>-->
						</tr>
					</table>
				</div>					
			<?php }
			mysql_free_result($Results);
			mysql_close($DBConn);
		}
		else
		{
			@mysql_free_result($Results);
			mysql_close($DBConn);
		}
	?>
</div>