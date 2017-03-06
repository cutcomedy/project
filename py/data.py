# -*- coding: utf-8 -*-
import MySQLdb
import jieba
import fuzzy
import json
import base64
import sys
import time
import collections
import operator

reload(sys) # Python2.5 初始化后会删除 sys.setdefaultencoding 这个方法，我们需要重新载入
sys.setdefaultencoding('utf-8')

conn = MySQLdb.connect('127.0.0.1', 'root', '123456', 'data', charset = "utf8")
cursor = conn.cursor()

start = time.time()

#get condition
condition = json.loads(base64.b64decode(sys.argv[1]))


total_count = 0
score = {}

#start
for name in fuzzy.get_attr_key_from_dict(condition[u'商品名稱']):
    name_importance = condition[u'商品名稱'][u'importance']
    name_conformity = condition[u'商品名稱'][name]
    products_id = []
    count = 0
    cut = jieba.lcut(name)

    #get products
    for i in cut:
        cursor.execute("SELECT * FROM product WHERE name LIKE '%s'" % ('%'+i+'%') )
        for x in cursor:
            if x[3] not in products_id:
                products_id.append(x[3])
                count += 1
                total_count += 1

    #test
    #products_id = []
    #products_id.append(37215)
    #count = 1
    #*****************************************

    while count > 0 :        #counting scores for products
        current_id = products_id[count-1]
        product_attr = {}
        numerator = []
        denominator = []

        #counting name score
        name_match = 0
        cursor.execute("SELECT * FROM product WHERE product_id = '%s'" % current_id )
        for i in cursor:
            for j in cut:
                if j in i[0]:
                    name_match += 1
        name_score = float(name_match)/len(cut)
        name_triangular = fuzzy.get_triangular_fuzzy_number(name_importance)
        denominator.append(name_triangular)
        name_triangular = fuzzy.tensor_product(name_triangular, fuzzy.get_triangular_fuzzy_number(name_conformity))
        name_triangular = fuzzy.list_multiplie_by_float(name_triangular, name_score)
        numerator.append(name_triangular)


        #get product attribute
        cursor.execute("SELECT * FROM attribute WHERE product_id = '%s'" % current_id )
        for x in cursor:
            product_attr[x[1]] = x[2]
        #print product_attr

        #loop attribute number set
        for condition_attr_key in condition:
            if condition_attr_key == '商品名稱':
                continue

            denominator.append(fuzzy.get_triangular_fuzzy_number(condition[condition_attr_key][u'importance']))
            for i in product_attr:
                #i = i.encode('utf-8','ignore').decode('utf-8','ignore')

                if condition_attr_key in i:
                    discrete = condition[condition_attr_key][u'discrete']
                    if ( type(discrete) == bool and discrete ) or discrete == 'True':
                        aux = fuzzy.discrete(product_attr[i],condition[condition_attr_key])
                        numerator.append(aux)
                    else:
                    	try:
	                        aux = fuzzy.linear(float(product_attr[i]) ,condition[condition_attr_key])
	                        aux2 = fuzzy.get_triangular_fuzzy_number(condition[condition_attr_key][u'importance'])
	                        numerator.append(fuzzy.list_multiplie_by_float(aux2, aux))
						except:
							pass


        #final
        numerator_final = [0.0, 0.0, 0.0]
        denominator_final = [0.0, 0.0, 0.0]

        for i in numerator:
            numerator_final = fuzzy.circled_plus(numerator_final, i)
        for i in denominator:
            denominator_final = fuzzy.circled_plus(denominator_final, i)

        sc = fuzzy.defuzzy(numerator_final, denominator_final)


        if current_id not in score.keys():
            score[current_id] = sc
        else:
            if sc > score[current_id]:
                score[current_id] = sc

        #print str(current_id) + ' : ' + str(sc)

        count -= 1


print base64.b64encode(json.dumps(score))
