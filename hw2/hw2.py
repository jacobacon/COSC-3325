# The Encrypt / Decrypt Function
def one_time_pad(message, key):
    # Append empty string with the char of the ord of each letter in the message XOR with the ord of letter in the key.

    new_message = ''.join(chr(ord(letter_msg) ^ ord(letter_key)) for letter_msg, letter_key in zip(message, key))
    return new_message


def rc4():
    exit()


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
        break
    elif ans == "3":
        break
