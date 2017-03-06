import MySQLdb
import random
import base64
import sys
import time
import collections
import re

reload(sys)
sys.setdefaultencoding('utf-8')

conn = MySQLdb.connect('127.0.0.1', 'root', '123456', 'data', charset = "utf8")
cursor = conn.cursor()
con = conn.cursor()
cursor.execute("SELECT * FROM product" )

for x in cursor:
    pid = str(x[3])
    s = random.randint(0, 100)
    t = random.randint(0, 250)
    c = random.randint(50, 999)
    p = 0.5*s + 0.4*t + 0.1*c
    print(x[3])
    up = "UPDATE product SET count_shop = " + str(c) + ",count_track = " + str(t) + ",count_share = " + str(s) + ",popularity = " + str(p) +  " WHERE product_id = " + str(pid)
    cursor.execute(up)
    cursor.connection.commit()
