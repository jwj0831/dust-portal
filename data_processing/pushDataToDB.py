import serial
import MySQLdb
import datetime
import smtplib
from email.mime.text import MIMEText 

"""
----------Function Declaration----------
"""
def send_email(message,  password, subject="Dust Monitoring Notification", from_addr='mustardenial@gmail.com', to_addr='jwj0831@gmail.com'):
	msg = MIMEText(message)
	msg['subject'] = subject
	msg['From'] = from_addr
	msg['To'] = to_addr
	
	server = smtplib.SMTP('smtp.gmail.com', 587)
	server.ehlo()
	server.starttls()
	server.ehlo()
	server.login(from_addr, password)
	server.sendmail(from_addr, to_addr, msg.as_string())
	server.close()

def getLatestData(curs, num):
	llw = []
	curs.execute("""SELECT raw_data FROM dust_data ORDER BY id DESC LIMIT 0, %s """, ( num ))
	results = curs.fetchall()
	for rs in results:
		llw.append(float(rs[0]))
	return llw

def getMailUserPassword(curs):
	curs.execute("""SELECT password FROM mail_user WHERE id = 'mustardenial@gmail.com'""");
	results = curs.fetchone()
	password = results[0]
	return password

def checkBeforeData(curs):
	curs.execute('SELECT COUNT(id) FROM dust_data');
	results = curs.fetchone()
	rows = int(results[0])
	if rows >= 10:
		return True
	else:
		return False
	
def getStatDic(curs):
	temp_dic = {}
	temp_dic['stat_id'] = 1
	temp_dic['max_val'] = 0
	temp_dic['min_val'] = 0
	temp_dic['good_ratio'] = 0
	temp_dic['notbad_ratio'] = 0
	temp_dic['severe_ratio'] = 0
	resultRow = curs.execute( 'SELECT * FROM stat_data ORDER BY day DESC LIMIT 1' )
	if resultRow == 1:
		results = curs.fetchone()
		temp_dic['stat_id'] = int(results[0])
		temp_dic['max_val'] = round(float(results[2]),2)
		temp_dic['min_val'] = round(float(results[3]),2)
		temp_dic['good_ratio'] = float(round(results[4]))
		temp_dic['notbad_ratio'] = float(round(results[5]))
		temp_dic['severe_ratio'] = float(round(results[6]))
		return max_data
	else :
		curs.execute( "INSERT INTO stat_data VALUES(default, now(), default, default, default, default, default)"  )
		db.commit()
		
		return temp_dic
	
def getConfigurationDic(curs):
	curs.execute("""SELECT * FROM dust_conf""");
	results= curs.fetchone()
	temp_dic = {}
	temp_dic['pws'] = int(results[1])
	temp_dic['hrc'] = round(float(results[2]),2)
	temp_dic['rfhrc'] = int(results[3])	
	temp_dic['mrc'] = round(float(results[4]),2)
	temp_dic['rfmrc'] = int(results[5])
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
stat_dic =  getStatDic(curs)
dayFormat = datetime.date.today()
currentDay = dayFormat.day
today_idi_num_dic = {}
today_idi_num_dic['total'] = 0
today_idi_num_dic['good'] = 0
today_idi_num_dic['notbad'] = 0
today_idi_num_dic['severe'] = 0
conf_dic = getConfigurationDic(curs)
mail_password = getMailUserPassword(curs)
"""
----------------------------------------
"""

while 1 :
	# Read the data from Serial Cable...
	dustVal = ser.readline()
	convVal = round(float(dustVal), 3)
	today_idi_num_dic['total'] = today_idi_num_dic['total'] + 1
	
	# Insert Sensor Data to DB with indoor dust index(idi)
	if start_cond_check_flag == True:
		# calculate idi number
		idi = 0
		hrc_frq = 0
		mrc_frq = 0
		conf_dic = getConfigurationDic(curs)		# load current setting configuration variables
		llw = getLatestData(curs, conf_dic['pws'] )	# Latest List in Window
 
 		# Comparaison
		for i in range( conf_dic['pws'] ):
			if llw[i] > conf_dic['hrc']:
				hrc_frq += 1
			elif llw[i] > conf_dic['mrc']:
				mrc_frq += 1
		
		if hrc_frq > conf_dic['rfhrc']:
			idi = 2;		# Decided to "Severe"
			today_idi_num_dic['severe'] = today_idi_num_dic['severe'] + 1
			msg = "Current Indoor Dust Envionment is Severe!!!"
			send_email(msg, mail_password)
		elif mrc_frq > conf_dic['rfmrc']:
			idi = 1;		# Decided to "Not Bad"
			today_idi_num_dic['notbad'] = today_idi_num_dic['notbad'] + 1
		else:
			idi = 0;		# Decided to "Good"
			today_idi_num_dic['good'] = today_idi_num_dic['good'] + 1
			
		stat_dic['good_ratio'] = str( float( round( (today_idi_num_dic['good'] / today_idi_num_dic['total']) * 100)  ) )
		stat_dic['notbad_ratio'] = str( float( round( (today_idi_num_dic['notbad'] / today_idi_num_dic['total']) * 100) ) )
		stat_dic['severe_ratio'] = str( float( round( (today_idi_num_dic['severe'] / today_idi_num_dic['total']) * 100) ) )
		
		curs.execute( """UPDATE stat_data SET good_ratio = %s, notbad_ratio = %s, severe_ratio = %s""", (stat_dic['good_ratio'], stat_dic['notbad_ratio'], stat_dic['severe_ratio'] ))
		
		#Put data to DB
		curs.execute( """INSERT INTO dust_data VALUES(default, default, %s, %s)""", (convVal, idi))
		db.commit()

	else:
		curs.execute( 'INSERT INTO dust_data VALUES(default, default,"%s", default)'% convVal )
		db.commit()
		start_cond_check_flag = checkBeforeData(curs)
		
	#MAX / Min Value Check
	newDayFormat = datetime.date.today()
	newDay = newDayFormat.day
	
	if currentDay != newDay:
		stat_dic['stat_id'] = stat_dic['stat_id'] + 1
		stat_dic['max_val'] = 0
		stat_dic['min_val'] = 0
		stat_dic['good_ratio'] = 0
		stat_dic['notbad_ratio'] = 0
		stat_dic['severe_ratio'] = 0
		currentDay = newDay
		curs.execute( "INSERT INTO stat_data VALUES(default, now(), default, default, default, default, default)"  )
		
	if currentDay == newDay:
		if convVal > stat_dic['max_val']:
			stat_dic['max_val'] = convVal
			convMaxVal = str(convVal)
			curs.execute( """UPDATE stat_data SET max_val = %s WHERE day = now()""", (convMaxVal))
		elif stat_dic['min_val'] == 0 or convVal < stat_dic['min_val']:
			stat_dic['min_val'] = convVal
			convMinVal = str(convVal)
			curs.execute( """UPDATE stat_data SET min_val = %s WHERE day = now() """, (convMinVal))
			
		db.commit()
			
		
