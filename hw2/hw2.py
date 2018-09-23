# One Time Pad Encrypt / Decrypt Function
def one_time_pad(message, key):
    # Append empty string with the char of the ord of each letter in the message
    # XOR with the ord of each letter in the key.
    new_message = ''.join(chr(ord(letter_msg) ^ ord(letter_key)) for letter_msg, letter_key in zip(message, key))
    return new_message


# RC4 Encrypt / Decrypt Function
def rc4(message, key):
    # Setup variables
    keystream = ""
    S = []
    # Set S to be 0 - 255
    for x in range(0, 256):
        S.append(x)

    # Create a permutation of S
    # Set J to be (j + S[i] + K[i % key length]) % 256 for each position in S
    j = 0
    for i in range(0, 256):
        j = (j + S[i] + ord(key[i % len(key)])) % 256
        # Swap S[i] and S[j] to randomize.
        temp = S[i]
        S[i] = S[j]
        S[j] = temp

    # Reset Variables
    i = 0
    j = 0

    # Generate the keystream.
    while len(keystream) < len(message):
        i = (i + 1) % 256
        j = (j + S[i]) % 256
        temp = S[i]
        S[i] = S[j]
        S[j] = temp
        k = S[(S[i] + S[j]) % 256]
        keystream += chr(k)

    # The Encrypted message is the one time pad of the message and the keystream.
    new_message = one_time_pad(message, keystream)
    return new_message


# Create a menu for selecting options
ans = True
while ans:
    print("""
    1- One-Time Pad
    2- RC4
    3- Exit
    """)
    ans = input("?> ")
    if ans == "1":
        message = input("What Message Do You Want to Encrypt (One-Time Pad)? ")
        key = input("What Key of Length " + str(len(message)) + " Do You Want to Use? ")

        # If the message and key length don't match then exit.
        if len(message) != len(key):
            print("""The Key MUST be the Same Length as The Message.
            Got: """ + str(len(key)) + ". Expected: " + str(len(message)))
            break
        else:
            enc_msg = one_time_pad(message, key)
            print("The Encrypted Message is: " + enc_msg)
            print("The Decrypted Message is: " + one_time_pad(enc_msg, key))
    elif ans == "2":
        message = input("What Message Do You Want to Encrypt (RC4)? ")
        key = input("What Key Do You Want to Use? ")

        enc_msg = rc4(message, key)
        print("The Encoded Message is: " + enc_msg)
        print("The Decoded Message is: " + rc4(enc_msg, key))
    elif ans == "3":
        break
