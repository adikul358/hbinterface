number_file = open("gpy.py", "r")
# number = number_file.read()
number_arr = []
for a in number_file:
    number_arr.append(a.rstrip("\n"))
number_file.close()
print(number_arr)

number_sum = 0
text = ""
counter = 0
for r in number_arr:
    counter += 1
    num = number_sum
    number_sum += int(r)
    print(str(num) + " + " + r + " = " + str(number_sum))

print(str(number_sum))
counter = 1
for a in list(str(number_sum)):
    if counter < 11:
        text+=a
    counter+=1
print("First Ten Digits are: " + text)  