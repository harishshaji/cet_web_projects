import pymongo
url="mongodb://localhost:27017/"
client=pymongo.MongoClient(url)
db=client["college"]
coll=db["studlist"]
for s in coll.find({"course":"MCA"}).sort("mark",-1).limit(1):
	print(s)
"""for s in coll.find({"gender":"male","grade":"A+"}):
	print(s)"""
"""for s in coll.find({"course":"Mechanical"}).sort("mark",-1).limit(3):
	print(s)"""
"""for s in coll.find({"gender":"female"},{"_id":0,"name.fname":1,"name.lname":1,"mark":1}):
 print(s)
"""
"""for s in coll.find({"mark": { '$gt':80 , '$lt':90}}):
	print(s)"""
"""for s in coll.find({"name.fname":{"$regex":"^V"}}):
	print(s)"""
"""print("first name" + "       " + "last name")
for s in coll.find({"address.city":"Kollam"}):
 print(s["name"]["fname"] + "       " + s["name"]["lname"])"""
"""for s in coll.find({"$nor":[{"address.city":"Kollam"},{"address.city":"Thiruvananthapuram"}]}):
	print(s)"""
#for s in coll.find({"$or":[{"address.city":"Kollam"},{"address.city":"Thiruvananthapuram"}],"gender":"female"}):
#	print(s)
