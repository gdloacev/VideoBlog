select 
	t.Title,
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
	concat_ws(\' \',u.FirstName,u.LastName) as \'Name\',
	th.Title
from 
	udtthread t
	join udtuser u 
		on t.idUser = u.id
	join udttheme th 
		on t.idTheme = th.id