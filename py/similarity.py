#encoding=utf-8
import MySQLdb
import json
import sys
import base64
import collections
import re
import math
import operator
from collections import defaultdict

#reload(sys) # Python2.5 初始化后会删除 sys.setdefaultencoding 这个方法，我们需要重新载入
#sys.setdefaultencoding('utf-8')

name = str(sys.argv[1])
user_id = int(sys.argv[2])


conn = MySQLdb.connect('127.0.0.1', 'root', '123456', 'data', charset = "utf8")
cursor = conn.cursor()
#name = "筆電,筆記型電腦,"
#user_id = 9
ids = {}
# get other user
cursor.execute("SELECT * FROM account WHERE ID != '%s'" %user_id)
for x in cursor:
    #compute share
    cursor.execute("SELECT * FROM share WHERE ID = '%s' " %x[0])
    product_num_other = math.sqrt(cursor.rowcount)
    product_num_self = 0
    sum_share = 0
    for y in cursor:
        cursor.execute("SELECT * FROM share WHERE ID = '%s'" %user_id)
        product_num_self = math.sqrt(cursor.rowcount)
        for z in cursor:
            if y[1] == z[1]:
                sum_share+=1
                break
    if product_num_self != 0 and product_num_other != 0:
        score_share = sum_share/(product_num_other * product_num_self)
    else:
        score_share = 0

#   compute track
    cursor.execute("SELECT * FROM track WHERE ID = '%s' " %x[0])
    product_num_other = math.sqrt(cursor.rowcount)
    product_num_self = 0
    sum_track = 0;
    for y in cursor:
        cursor.execute("SELECT * FROM track WHERE ID = '%s'" %user_id)
        product_num_self = math.sqrt(cursor.rowcount)
        for z in cursor:
            if y[1] == z[1]:
                sum_track+=1
                break
    if product_num_self != 0 and product_num_other != 0:
        score_track = sum_track/(product_num_other * product_num_self)
    else:
        score_track = 0
    if score_track != 0 or score_share != 0:
        ids[str(x[0])] = score_track * 0.5 + score_share * 0.5

ids_sort = sorted(ids.items(), key = operator.itemgetter(1), reverse = True)

id_product = {}
key_word = ""
first = True
for x in name.split(","):
    if x == '':
        break
    if first:
        key_word = "(product.name LIKE '%" + x + "%'"
        first = False
    else:
        key_word = key_word + " OR product.name LIKE '%" + x + "%'"

for user in ids_sort:
    query = "SELECT track.url, product.name, product.url, product.shop, product.popularity, product.pic FROM track, product WHERE (track.ID = " + user[0] + " AND product.url = track.url) AND " + key_word + ")"
    cursor.execute(query)
    for item in cursor:
        if item[0] not in id_product:
            id_product[str(item[0])] = {}
            id_product[str(item[0])]['name'] = item[1]
            id_product[str(item[0])]['url'] = item[2]
            id_product[str(item[0])]['shop'] = item[3]
            id_product[str(item[0])]['popularity'] = item[4]
            id_product[str(item[0])]['pic'] = item[5]
            id_product[str(item[0])]['score'] = user[1]


ids_x = json_dict = defaultdict(lambda: defaultdict(dict))
ids_x_score = {}
ids_x_popularity = {}
ids_sort_score = sorted(id_product, key = lambda x : (id_product[x]['score'], id_product[x]['popularity']), reverse=True)
ids_sort_popularity = sorted(id_product, key = lambda x : (id_product[x]['popularity'], id_product[x]['score']), reverse=True)
j = 0
for i in ids_sort_score:
    ids_x["0"][str(j)] = id_product[i]
    ids_x["0"][str(j)]['id'] = i
    j+=1
j = 0
for i in ids_sort_popularity:
    ids_x["1"][str(j)] = id_product[i]
    ids_x["1"][str(j)]['id'] = i
    j+=1

print base64.b64encode(json.dumps(ids_x))
