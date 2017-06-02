import MySQLdb
import dropbox
import sys
import os
import json

key='SdvpGtPWBpMAAAAAAAActHRS6WRwhTcOfMwhSXX869RlA4-YBzrZ9-FLAI6ozUT0'
client = dropbox.client.DropboxClient(key)

# Open database connection
db = MySQLdb.connect("localhost","root","seiter","carritoe_ave")

# prepare a cursor object using cursor() method
cursor = db.cursor()

# execute SQL query using execute() method.
cursor.execute("SELECT idarchivos,url FROM archivos where dropbox=0 and estado=1 limit 1")

# Fetch a single row using fetchone() method.
rows_count=cursor.rowcount
if rows_count !=0:
	
	results = cursor.fetchall()
	for row in results:
		  fname = row[0]
		  nombremini = row[1]


	
	direccion= 'Aplicaciones/Archivosave/anexos/'+nombremini
	origen='/var/www/html/Ave/subir/server/php/files/'+nombremini
	try:
	
		f = open(origen, 'rb')
		respuesta = client.put_file(direccion, f)
		
		#print direccion
		
		info=client.share(direccion,short_url=True)
		j = json.loads(json.dumps(info))
		urlDropbox=j['url']
		
		#print urlDropbox
		
		sql1 = "UPDATE archivos SET dropbox =1,urlDropbox='%s' WHERE idarchivos = '%s'" % (urlDropbox,fname)
		cursor.execute(sql1)
		db.commit()
		
		os.remove('/var/www/html/Ave/subir/server/php/files/'+nombremini)
		
		print "ok"
		



	except:
	   # Rollback in case there is any error
	   db.rollback()
	   print "ERROR"
   
else:
	print "salio"  
	# disconnect from server
	db.close()