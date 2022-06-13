from pymongo import MongoClient as MC

client = MC("localhost", 27017)
COLLEGE_DB = client.Exercise2
COLLECTION = COLLEGE_DB.Students

to_insert = [ {"_id":1,
"Name":"Anjali",
"Place":"Kollam",
"Phone":8582639562,
"Vaccination_status":"Both vaccinated",
"RTPCR":"negative","Lab_mark":{"Internal":30,"External":45},"Department":"MCA"},

{"_id":2,
"Name":"Anuradha",
"Place":"Varkala",
"Phone":9992639562,
"Vaccination_status":"Both vaccinated",
"RTPCR":"negative",
"Lab_mark":{"Internal":40,"External":48},
"Department":"Civil"},

{"_id":3,
"Name":"Bismiya",
"Place":"Kollam",
"Phone":9446639562,
"Vaccination_status":"not vaccinated",
"RTPCR":"positive",
"Lab_mark":{"Internal":50,"External":39},
"Department":"MCA"},

{"_id":4,
"Name":"Vimal",
"Place":"Ernakulam",
"Phone":8582639568,
"Vaccination_status":"First dose only",
"RTPCR":"positive",
"Lab_mark":{"Internal":40,"External":42},
"Department":"Civil"},

{"_id":5,
"Name":"Vivek",
"Place":"Kollam",
"Phone":8582639777,
"Vaccination_status":"Both vaccinated",
"RTPCR":"negative",
"Lab_mark":{"Internal":50,"External":50},
"Department":"MCA"}]


#COLLECTION.insert_many(to_insert)

print("Those who are both not vaccinated: ")
f = COLLECTION.find({"Vaccination_status":{"$ne":"Both vaccinated"}})
for i in f:
    print(i['Name'], i['Phone'])

print("Top 2 students of MCA: ")
f = COLLECTION.find({"Department":"MCA"}).sort("Lab_mark.External", -1).limit(2)
for i in f:
    print(i['Name'], i['Phone'])

print("the id, name and department of students whose name starts with ‘A’")
f = COLLECTION.find({"Name":{"$regex":"^A"}})
for i in f:
    print(i['_id'], i['Name'], i['Department'])



#update the vaccination status as ‘both vaccinated’ of the student whose id=4

COLLECTION.update_many({"_id":4}, {"$set":{"Vaccination_status":"Both Vaccinated"}})

print("The name of students in descending order based on the lab external mark.")
f = COLLECTION.find({}).sort("Lab_mark.External", -1)

for i in f:
    print(i['Name'])
