<# Connect to local mysql database via powershell #>

$username = 'root'						#Replace with your username
$databaseHost = '127.0.0.1' 			#Only change this if you have a different host than localhost
$pathToMySql = 'c:\xampp\mysql\bin\' 	#Change this if you installed xampp in a custom folder

cd $pathToMySql 
.\mysql.exe -h $databaseHost -u $username -p
