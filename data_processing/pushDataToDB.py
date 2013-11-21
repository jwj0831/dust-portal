import serial
import MySQLdb
import datetime

"""
----------Function Declaration----------
"""
def getLatestData(curs, num):
	latest_data = []
	curs.execute("""SELECT raw_data FROM dust_data ORDER BY id DESC LIMIT 0, %s """, ( num ))
	results = curs.fetchall()
	for rs in results:
		latest_data.append(float(rs[0]))
	return latest_data

def checkBeforeData(curs):
	curs.execute('SELECT COUNT(id) FROM dust_data');
	results = curs.fetchone()
	rows = int(results[0])
	if rows > 10:
		return True
	else:
		return False
	
def checkMaxData(curs):
	isItMaxVal = curs.execute( 'SELET * FROM max_data WHERE day = now()' )
	if isItMaxVal == 1:
		results = curs.fetchone()
		max_id = results[0];
		max_data = round(float(results[1]),2)
	else:
		curs.execute( 'INSERT INTO max_data VALUES(default, now(), "0"' )
		db.commit()
		curs.commit
	
"""
----------------------------------------
"""

"""
----------Default Configuration----------
"""
db = MySQLdb.connect("localhost", "root", "1234", "dust")
curs = db.cursor()
ser = serial.Serial('/dev/ttyACM0', 9600)
start_cond_check_flag = checkBeforeData(curs)
max_data = 0
today = datetime.date.today()
newday = today.day
"""
----------------------------------------
"""

"""Load Configuration Val---------------------------------"""
curs.execute("""SELECT * FROM dust_conf""");
results= curs.fetchone()
conf_dic = {}	
conf_dic['lc'] = round(float(results[1]),2)
conf_dic['lrc'] = round(float(results[2]),2)
conf_dic['mc'] = round(float(results[3]),2)
conf_dic['mrc'] = int(results[4])
conf_dic['hc'] = round(float(results[5]),2)
conf_dic['hrc'] = int(results[6])
conf_dic['window'] = int(results[7])
"""-------------------------------------------------------"""

while 1 :
	# Read the data from Serial Cable...
	dustVal = ser.readline()
	convVal = str(round(float(dustVal), 3))
	
	# Insert Sensor Data to DB with indoor dust index(idi)
	if start_cond_check_flag == True:
		# calculate idi number
		idi = 0;
		latest_data = getLatestData(curs, 10)
 
		# compare between lower constant=0 and lower relatice constant
		hc_num = 0
		mc_num = 0
		for i in range(10):
			if latest_data[i] > conf_dic['hc']:
				hc_num += 1
			elif latest_data[i] > conf_dic['mc']:
				mc_num += 1
		
		if hc_num > conf_dic['hrc']:
			idi = 2;
		elif mc_num > conf_dic['mrc']:
			idi = 1;
		else:
			idi = 0;
	
		curs.execute( """INSERT INTO dust_data VALUES(default, default, %s, %s)""", (convVal, idi))
		db.commit()

		#Max Value Check
		checkDay = datetime.date.today()
		if today == checkDay:	
			if convVal > max_data:
				curs.execute( """INSERT INTO max_data VALUES(default, now(), %s)""", (convVal) )
				db.commit()
		else:
			max_data = 0
	else:
		curs.execute( 'INSERT INTO dust_data VALUES(default, default,"%s", default)'% convVal )
		db.commit()
		start_cond_check_flag = checkBeforeData(curs)
