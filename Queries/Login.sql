select
	id,
	FirstName,
	LastName,
	concat_ws(' ',FirstName, LastName) as 'FullName',
	UserName,
	Mail,
	DateFrom,
	case
		when Active = 1 then 'Activo'
		else 'Suspendido'
	end as 'Status'
from 
	udtuser
where
	UserName = 'lghernandez'
	and Passwrd = aes_encrypt('claudia','index!secure$key')
