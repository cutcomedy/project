# -*- coding: utf-8 -*-
import math

def get_attr_key_from_dict(dict):
    for x in dict:
        if x != 'importance' and x != 'discrete':
            yield x

def triangular_to_LR(number):
    return [number[1],number[1]-number[0],number[2]-number[1]]

def LR_to_triangular(number):
    return [number[0]-number[1],number[0],number[0]+number[2]]

def tensor_product(a, b):
    a = triangular_to_LR(a)
    b = triangular_to_LR(b)
    result_of_LR_type = [a[0]*b[0], a[0]*b[1]+b[0]*a[1], a[0]*b[2]+b[0]*a[2]]
    return LR_to_triangular(result_of_LR_type)

def circled_plus(*arg):
    sum = [0.0, 0.0, 0.0]
    for i in range(len(arg)):
        sum = [sum[0]+arg[i][0], sum[1]+arg[i][1], sum[2]+arg[i][2]]
    return sum

def list_multiplie_by_float(a, b):
    for i in range(len(a)):
        a[i] = a[i]*b
    return a

def defuzzy(numerator, denominator):
    numerator_final = [0.0, 0.0, 0.0]
    denominator_final = [0.0, 0.0, 0.0]

    for i in numerator:
        numerator_final = circled_plus(numerator_final, i)
    for i in denominator:
        denominator_final = circled_plus(denominator_final, i)

    numerator_centroid_x = get_centroid_x(numerator_final)
    denominator_centroid_x = get_centroid_x(denominator_final)
    result = numerator_centroid_x / denominator_centroid_x
    return result

def get_centroid_x(triangle_x):
    centroid_x = float(triangle_x[0]+triangle_x[1]+triangle_x[2])/3
    result = math.sqrt((triangle_x[2]-triangle_x[0])*(triangle_x[1]-triangle_x[0])/2)+triangle_x[0]
    return result

def get_triangular_fuzzy_number(n):
    n = float(n)
    triangular_number = 4
    number = [(n-2)/triangular_number,(n-1)/triangular_number,(n)/triangular_number]

    for k in range(len(number)):
        if number[k] < 0:
            number[k] = 0.0
        if number[k] > 1:
            number[k] = 1.0
    return number

def discrete(source, condition):  #both are dict
    max = 0
    for key in condition:
        if key == 'importance' or key == 'discrete':
            continue
        if key in source and condition[key] > max:
            max = condition[key]

    degree_of_conformity = get_triangular_fuzzy_number(max)
    importance = get_triangular_fuzzy_number(condition['importance'])
    result = tensor_product(degree_of_conformity,importance)

    return result

def linear_sub(target, condition): #target = int condition = dict
    left = [-99999999,-1] #prince, importance
    right = [99999999,-1] #prince, importance
    top = [-99999999,-1]
    but = [99999999,1]

    for value in get_attr_key_from_dict(condition):
        value = float(value)

        if value == target:
            return condition[str(int(value))]/6.0

        if value < target and value > left[0]:
            left[0] = value
            left[1] = condition[str(int(value))]/6.0

        if value > target and value < right[0]:
            right[0] = value
            right[1] = condition[str(int(value))]/6.0

        if condition[str(int(value))] == 6:
            top[0] = value
            top[1] = 1

        if condition[str(int(value))] == 0:
            but[0] = value
            but[1] = 0


    if left[1] == -1:
        if right[1] == 0 or right[1] == 1:
            return right[1]

        if top[0] > but[0]:
            return 1
        else:
            return 0

    if right[1] == -1:
        if left[1] == 0 or left[1] == 0:
            return left[1]

        if top[0] > but[0]:
            return 0
        else:
            return 1


    x = ( (target - left[0]) * (right[1] - left[1])) / (right[0] - left[0]) + left[1]
    return x

def linear(target, condition): #target = int condition = dict
    aux = get_triangular_fuzzy_number(condition['importance'])
    return list_multiplie_by_float(aux, linear_sub(target, condition))
