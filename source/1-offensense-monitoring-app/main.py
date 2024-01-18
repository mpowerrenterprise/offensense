import speech_recognition as sr
import mysql.connector
from datetime import datetime

mydb = mysql.connector.connect(
    host="localhost",
    user="root",
    passwd="",
    database="db_offensence"
)

bad_words = []

SelectDataCursor = mydb.cursor()
SelectDataCursor.execute("SELECT * FROM words")
collecttedData = SelectDataCursor.fetchall()

for x in collecttedData:
    bad_words.append(x[1])

while True:
    r = sr.Recognizer()
    with sr.Microphone() as source:
        print("Listening...")
        r.pause_threshold = 1
        # audio = r.listen(source, phrase_time_limit=5)
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

                    # Assuming your table has columns named 'col1', 'col2', 'col3', 'col4', 'col5'
                    sqlCode = "INSERT INTO predictions (autoid, date, time, prediction, transcript) VALUES (%s, %s, %s, %s, %s)"

                    try:
                        # Assuming you have values for the first four columns, replace the placeholders accordingly
                        values = ('', currentDate, currentTime, word, dataText)

                        insert_cursor.execute(sqlCode, values)
                        mydb.commit()
                    except Exception as e:
                        print(e)
                    finally:
                        insert_cursor.close()

        except Exception as e:
            print(e)
