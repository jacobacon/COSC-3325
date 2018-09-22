def encrypt( key, message ):
    fixedKey = int(key)%26
    newMessage = ''.join(chr(ord(letter) + int(fixedKey)) for letter in message)
    fileObject = open('ciphertext.txt', 'w+')
    fileObject.write(newMessage)
    print(newMessage)

def decrypt( key, message ):
    fixedKey = int(key)%26
    newMessage = ''.join(chr(ord(letter) - int(fixedKey)) for letter in message)
    fileObject = open('plaintext.txt', 'w+')
    fileObject.write(newMessage)
    print(newMessage)

def breakMessage( message ):
    key = 0
    found = False
    while key < 26 and found != True:
      key += 1
      newMessage = ''.join(chr(ord(letter) - int(key)) for letter in message)
      print(newMessage + ' generated using key: ' + str(key))
      input = input("Is this a valid message? (y/n) ")
      if(input.lower() == "y"):
        print("The key is: " + str(key))
        fileObject = open('plaintext.txt', 'w+')
        fileObject.write(newMessage)
        found = True
      else:
        found = False

ans=True
while ans:
    print ("""
    1. Encrypt
    2. Decrypt
    3. Break
    4. Exit
    """)
    ans=input("What would you like to do? ")
    if ans=="1": 
      fileName = input("What File Do You Want to Encrypt? ")
      fileObject = open(fileName, "r")
      fileContents = fileObject.read()
      key = input("What's The Key You Want to Use? ")
      encrypt( key, fileContents )
    elif ans=="2":
      fileName = input("What File Do You Want to Decrypt? ")
      fileObject = open(fileName, 'r')
      fileContents = fileObject.read()
      key = input("What's The Key You Want to Use? ")
      decrypt( key, fileContents )
    elif ans=="3":
      fileName = input("What File Do You Want to Try to Break? ")
      fileObject = open(fileName, 'r')
      fileContents = fileObject.read()
      breakMessage(fileContents)
    elif ans=="4":
      print("\n Goodbye")
      break
    elif ans !="":
      print("\n Not Valid Choice Try again")
