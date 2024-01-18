import pyttsx3
import speech_recognition as sr
import subprocess
import mysql.connector
from datetime import datetime

engine = pyttsx3.init('sapi5')

en_voice_id = "HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\Speech\Voices\Tokens\TTS_MS_EN-US_ZIRA_11.0"  # female
ru_voice_id = "HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\Speech\Voices\Tokens\TTS_MS_RU-RU_IRINA_11.0"  # male

file = open("place.txt", 'r')
place = file.readline().strip()
file.close()


mydb = mysql.connector.connect(

  host="localhost",
  user="root",
  passwd="",
  database="bad_words_predictor"
)

bad_words = []

SelectDataCursor = mydb.cursor()
SelectDataCursor.execute("SELECT * FROM word")
collecttedData = SelectDataCursor.fetchall()

for x in collecttedData:
	bad_words.append(x[1])


while True:

    r = sr.Recognizer()
    with sr.Microphone() as source:
        print("Listening...")
       	r.pause_threshold = 1
       	#audio = r.listen(source, phrase_time_limit=5)
        audio = r.listen(source)

        try:
            text = r.recognize_google(audio)
            print("Recognizing...")
            dataText = format(text)
            dataText = dataText.strip()

            print(dataText)

            for word in bad_words:
            	if word.lower() in dataText.lower():

            		now = datetime.now()
            		currentTime = now.strftime("%I:%M:%S %p")
            		currentDate = datetime.today().strftime('%Y-%m-%d')

            		insert_cursor = mydb.cursor()
            		sqlCode = "INSERT INTO data VALUES ('{}', '{}', '{}','{}', '{}','{}')".format("",place, currentDate ,currentTime,word,dataText)
            		insert_cursor.execute(sqlCode)
            		mydb.commit()

        except Exception as e:
        	print(e)
            