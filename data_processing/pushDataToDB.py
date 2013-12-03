import serial
import MySQLdb
import datetime
import smtplib
from email.mime.text import MIMEText 


"""
----------Function Declaration----------
"""
def send_email(message,  password, subject="Dust Monitoring Notification", addr='jwj0831@gmail.com'):
	msg = MIMEText(message)
	msg['subject'] = subject
	msg['From'] = addr
	msg['To'] = addr
	
	server = smtplib.SMTP('smtp.gmail.com', 587)
	server.ehlo()
	server.starttls()
	server.ehlo()
	server.login(addr, password)
	server.sendmail(addr,addr, msg.as_string())
	server.close()


def getLatestData(curs, num):
	latest_list_in_window = []
	curs.execute("""SELECT raw_data FROM dust_data ORDER BY id DESC LIMIT 0, %s """, ( num ))
	results = curs.fetchall()
	for rs in results:
		latest_list_in_window.append(float(rs[0]))
	return latest_list_in_window

def getMailUserPassword(curs):
	curs.execute("""SELECT password FROM mail_user WHERE id = 'jwj0831@gmail.com'""");
	result = curs.fetchone()
	return result

def checkBeforeData(curs):
	curs.execute('SELECT COUNT(id) FROM dust_data');
	results = curs.fetchone()
	rows = int(results[0])
	if rows > 10:
		return True
	else:
		return False
	
def getMaxData(curs):
	isItMaxVal = curs.execute( 'SELECT * FROM max_data WHERE day = now()' )
	if isItMaxVal == 1:
		results = curs.fetchone()
		max_id = results[0];
		max_data = round(float(results[1]),2)
		return max_data
	else :
		return 0
	
def getConfigurationDic(curs):
	curs.execute("""SELECT * FROM dust_conf""");
	results= curs.fetchone()
	temp_dic = {}	
	temp_dic['lc'] = round(float(results[1]),2)
	temp_dic['lrc'] = round(float(results[2]),2)
	temp_dic['mc'] = round(float(results[3]),2)
	temp_dic['mrc'] = int(results[4])
	temp_dic['hc'] = round(float(results[5]),2)
	temp_dic['hrc'] = int(results[6])
	temp_dic['window'] = int(results[7])
	return temp_dic
	
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
max_data = getMaxData(curs)
dayFormat = datetime.date.today()
currentDay = dayFormat.day
conf_dic = getConfigurationDic(curs)
mail_password = getMailUserPassword(curs)
"""
----------------------------------------
"""

while 1 :
	# Read the data from Serial Cable...
	dustVal = ser.readline()
	convVal = str(round(float(dustVal), 3))
	
	# Insert Sensor Data to DB with indoor dust index(idi)
	if start_cond_check_flag == True:
		# calculate idi number
		idi = 0;
		conf_dic = getConfigurationDic(curs)
		latest_list_in_window = getLatestData(curs, conf_dic['window'] )
 
		# compare between lower constant=0 and lower relatice constant
		hc_frq = 0
		mc_frq = 0
		for i in range( conf_dic['window'] ):
			if latest_list_in_window[i] > conf_dic['hc']:
				hc_frq += 1
			elif latest_list_in_window[i] > conf_dic['mc']:
				mc_frq += 1
		
		if hc_frq > conf_dic['hrc']:
			idi = 2;
			msg = "Current Indoor Dust Envionment is Severe!!!"
			send_email(msg, mail_password)
			
		elif mc_frq > conf_dic['mrc']:
			idi = 1;
		else:
			idi = 0;
	
		curs.execute( """INSERT INTO dust_data VALUES(default, default, %s, %s)""", (convVal, idi))
		db.commit()

		#Max Value Check
		newDayFormat = datetime.date.today()
		newDay = newDayFormat.day
		
		if currentDay != newDay:
			max_data = 0
			currentDay = newDay
		
		if currentDay == newDay:	
			if float(convVal) > max_data:
				curs.execute( """INSERT INTO max_data VALUES(default, now(), %s)""", (convVal) )
				db.commit()
				max_data = float(convVal);

	else:
		curs.execute( 'INSERT INTO dust_data VALUES(default, default,"%s", default)'% convVal )
		db.commit()
		start_cond_check_flag = checkBeforeData(curs)
