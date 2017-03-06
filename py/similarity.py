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

def get_data(item, score):
    tmp = {}
    tmp['name'] = item[1]
    tmp['url'] = item[2]
    tmp['shop'] = item[3]
    #popularity = share*0.5 + track*0.4 + click*0.1
    tmp['popularity'] = item[5]*0.5 + item[6]*0.4 + item[7]*0.1
    tmp['pic'] = item[4]
    tmp['score'] = score
    return tmp

def compute_score(other_id, self_id, table):
    cursor.execute("SELECT * FROM " + table + " WHERE ID = '%s' " %other_id)
    product_num_other = math.sqrt(cursor.rowcount)
    product_num_self = 0
    score = 0
    product_sum = 0
    for other in cursor:
        cursor.execute("SELECT * FROM " + table + " WHERE ID = '%s'" %self_id)
        product_num_self = math.sqrt(cursor.rowcount)
        for user in cursor:
            if other[1] == user[1]:
                product_sum+=1
                break
    if product_num_self != 0 and product_num_other != 0:
        score = product_sum/(product_num_other * product_num_self)
    else:
        score = 0
    return score

def insert_data(ids, id_product):
    j = 0
    output = {}
    for i in ids:
        output[str(j)] = id_product[i]
        output[str(j)]['id'] = i
        j+=1
    return output


name = str(sys.argv[1])
user_id = int(sys.argv[2])
#name = "筆電,筆記型電腦,"
#user_id = 9

conn = MySQLdb.connect('127.0.0.1', 'root', '123456', 'data', charset = "utf8")
cursor = conn.cursor()
ids = {}

# get other user
cursor.execute("SELECT * FROM account WHERE ID != '%s'" %user_id)

#compute
for x in cursor:
    score_share = compute_score(x[0], user_id, "share")
    score_track = compute_score(x[0], user_id, "track")
    if score_track != 0 or score_share != 0:
        ids[str(x[0])] = score_track * 0.5 + score_share * 0.5
#keywords => sql
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

for other in ids:
    #get data form track
    query = "SELECT track.url, product.name, product.url, product.shop, product.pic, product.count_share, product.count_track, product.count_shop, product.product_id FROM track, product WHERE (track.ID = " + other + " AND product.url = track.url) AND " + key_word + ")"
    cursor.execute(query)
    for item in cursor:
        if item[8] not in id_product:
            id_product[str(item[8])] = get_data(item, ids[other])
    #get data form share
    query = "SELECT share.url, product.name, product.url, product.shop, product.pic, product.count_share, product.count_track, product.count_shop, product.product_id FROM share, product WHERE (share.ID = " + other + " AND product.url = share.url) AND " + key_word + ")"
    cursor.execute(query)
    for item in cursor:
        if item[8] not in id_product:
            id_product[str(item[8])] = get_data(item, ids[other])

#create 3 level dict{}
ids_x = json_dict = defaultdict(lambda: defaultdict(dict))
ids_x_score = {}
ids_x_popularity = {}
ids_sort_score = sorted(id_product, key = lambda x : (id_product[x]['score'], id_product[x]['popularity']), reverse=True)
ids_sort_popularity = sorted(id_product, key = lambda x : (id_product[x]['popularity'], id_product[x]['score']), reverse=True)

#insert data in ids_x
ids_x["score"] = insert_data(ids_sort_score, id_product)
ids_x['hot'] = insert_data(ids_sort_popularity, id_product)

print base64.b64encode(json.dumps(ids_x))
