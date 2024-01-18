import pyttsx3
import speech_recognition as sr


engine = pyttsx3.init()
bad_words = ["dog", "kill"]

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
                    engine.say("Offensive language is strictly prohibited")
                    engine.runAndWait()

        except Exception as e:
            print(e)
