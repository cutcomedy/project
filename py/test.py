import sys
import base64
reload(sys)
sys.setdefaultencoding('utf-8')

aa = sys.argv[1]
bb = sys.argv[2]
ids_x = aa + "___" + bb
print ids_x + type(aa)
