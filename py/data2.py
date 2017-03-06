# -*- coding: utf-8 -*-
import MySQLdb
import fuzzy
import json
import base64
import sys
import collections
import re
from collections import defaultdict
reload(sys) # Python2.5 初始化后会删除 sys.setdefaultencoding 这个方法，我们需要重新载入
sys.setdefaultencoding('utf-8')

conn = MySQLdb.connect('127.0.0.1', 'root', '123456', 'data', charset = "utf8")
cursor = conn.cursor()


#get conditions
conditions = json.loads(base64.b64decode(sys.argv[1]))

ids = {}

#start
for name in fuzzy.get_attr_key_from_dict(conditions[u'商品名稱']):
    name_importance = conditions[u'商品名稱'][u'importance']
    name_conformity = conditions[u'商品名稱'][name]
    products_id = []

    #get products
    cursor.execute("SELECT * FROM product WHERE name LIKE '%s'" % ('%'+name+'%') )
    for x in cursor:
        if x[3] not in ids:
            products_id.append(x[3])
            ids[str(x[3])] = {}
            ids[str(x[3])]['name'] = x[0]
            ids[str(x[3])]['url'] = x[1]
            ids[str(x[3])]['pic'] = x[2]
            ids[str(x[3])]['shop'] = x[4]
            ids[str(x[3])]['score'] = 0.0
            ids[str(x[3])]['popularity'] = x[8]

    #counting score for product
    for current_id in products_id:
        product_attr = {}
        numerator_list = []
        denominator_list = []

        #counting name score
        name_triangular = fuzzy.get_triangular_fuzzy_number(name_importance)
        denominator_list.append(name_triangular)
        name_triangular = fuzzy.tensor_product(name_triangular, fuzzy.get_triangular_fuzzy_number(name_conformity))
        numerator_list.append(name_triangular)


        #get product attribute
        cursor.execute("SELECT * FROM attribute WHERE product_id = '%s'" % current_id )
        for x in cursor:
            product_attr[x[1]] = x[2]
        #print product_attr

        #loop attribute number set
        for conditions_key in conditions:
            if conditions_key == '商品名稱':
                continue

            drop = True
            denominator_list.append(fuzzy.get_triangular_fuzzy_number(conditions[conditions_key]['importance']))
            for product_key in product_attr:
                #i = i.encode('utf-8','ignore').decode('utf-8','ignore')

                if conditions_key in product_key:
                    discrete = conditions[conditions_key][u'discrete']
                    if ( type(discrete) == bool and discrete ) or discrete == 'True':
                        aux = fuzzy.discrete(product_attr[product_key],conditions[conditions_key])
                        numerator_list.append(aux)
                    else:
                        try:
                            attrv = re.findall("\d+\.\d+|\d+", product_attr[product_key])
                            aux = fuzzy.linear(float(attrv[0]) ,conditions[conditions_key])
                            numerator_list.append(aux)
                        except:
                            pass

                    drop = False
                    break

        if drop:
            ids.pop(str(current_id), None)
            continue

        #final defuzzy
        score = fuzzy.defuzzy(numerator_list, denominator_list)

        if score > ids[str(current_id)]['score']:
            ids[str(current_id)]['score'] = score

        #print str(current_id) + ' : ' + str(sc)  #print score
ids_x = json_dict = defaultdict(lambda: defaultdict(dict))
ids_x_score = {}
ids_x_popularity = {}
ids_sort_score = sorted(ids, key = lambda x : (ids[x]['score'], ids[x]['popularity']), reverse=True)
ids_sort_popularity = sorted(ids, key = lambda x : (ids[x]['popularity'], ids[x]['score']), reverse=True)
j = 0
for i in ids_sort_score:
    ids_x["0"][str(j)] = ids[i]
    ids_x["0"][str(j)]['id'] = i
    j+=1
j = 0
for i in ids_sort_popularity:
    ids_x["1"][str(j)] = ids[i]
    ids_x["1"][str(j)]['id'] = i
    j+=1

print base64.b64encode(json.dumps(ids_x))
