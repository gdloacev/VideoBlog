<?php 
	if(!isset($_SESSION))
	{
		session_start();
	}
?>
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
			t.idType = 1
		order by
			m.DateFrom desc';
				
		$Results = @mysql_query($Query,$DBConn);
		
		if(@mysql_num_rows($Results) > 0)
		{
			while($row = @mysql_fetch_array($Results))
			{ ?>
				<article id=<?php echo($row['id']);?>>
						<?php	
						$QueryImages = 
						'select 
							mi.Title,
							mi.Path
						from 
							udtmessageimages mi
							join udtmessage m 
								on mi.idMessage = m.id
						where m.id = ' . $row['id'] .
						' limit 0,1';
						
						$DBConn2 = $Index -> ConnectDB();
						$ImageResults = @mysql_query($QueryImages,$DBConn2);
						
						if(@mysql_num_rows($ImageResults) > 0)
						{?>
							<figure>
								<?php
								while($rowImage = @mysql_fetch_array($ImageResults))
								{?>
									<a target="_blank" class="lightwindow page-options" href="images_blog/<?php echo $rowImage['Path'];?>">
										<img alt="<?php echo $rowImage['Title']; ?>" src="images_blog/<?php echo $rowImage['Path'];?>">
									</a>
								<?php } ?>
							</figure>
							<figcaption>
								<?php 
									echo '<small><strong>Titulo:</strong>' . ' <span>' . $row['Title'] . '</span>';
									echo ' <strong>Por:</strong>' . ' <span>' . $row['Name'] . '</span>';
									echo ' <strong>Fecha:</strong>' . ' <span>' . $row['Date'] . ' - ' . $row['Time'] . '</span></small>'; 
								?>
							</figcaption>
							<div>
								<?php
									if( strlen($row['Message']) > 600 )
									{
										$row['Message']=str_replace(chr(13),"<br/>",$row['Message']);
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
						<?php }
						if(isset($_SESSION['UserId']) && $_SESSION['UserName'] == "admin")
						{ ?>
							<div id=<?php echo('tools' . $row['id']); ?>>
								<a href="MessageDelete.php?id=<?php echo $row['id'];?>">Borrar</a>
								<a href="MessageEdit.php?id=<?php echo $row['id'];?>">Modificar</a>
								<a href="Reply.php?id=<?php echo $row['TID'];?>">Comentar</a>
							</div>
						<?php } else if(isset($_SESSION['UserId'])) {?>
							<div id=<?php echo('tools' . $row['id']); ?>>
								<a href="Reply.php?id=<?php echo $row['TID'];?>">Comentar</a>
							</div>
						<?php } ?>
				</article>						
			<?php }
			@mysql_free_result($Results);
			@mysql_close($DBConn);
		}
		else
		{
			@mysql_free_result($Results);
			@mysql_close($DBConn);
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
				
		$Results = @mysql_query($Query2,$DBConn);
		
		if(@mysql_num_rows($Results) > 0)
		{
			while($row = @mysql_fetch_array($Results))
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
			@mysql_free_result($Results);
			@mysql_close($DBConn);
		}
		else
		{
			@mysql_free_result($Results);
			@mysql_close($DBConn);
		}
	?>
