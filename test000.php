<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Untitled Document</title>
</head>
<body>
    <?php
        $pyscript = '.\py\data2.py';
        $python = 'C:\Python27\python.exe';

/*        $json = '{
          "商品名稱": {"importance":5,
                      "手機殼":6,
                      "保護套":3,
                      "discrete":"True"
          },
          "價格":    {"importance":3,
                      "500":5,
                      "1500":3,
                      "discrete":"False"
          },
          "顏色":    {"importance":4,
                      "白":6,
                      "黑":4,
                      "迷彩":5,
                      "彩虹":5,
                      "紅":2,
                      "discrete":"True"
          },
          "產地":    {"importance":6,
                      "中國":3,
                      "台灣":6,
                      "discrete":"True"
          }
        }';
       $json = '{
        "商品名稱":{"importance":4,
                    "固態硬碟":6,
                    "discrete":"True"
        },
        "價格":    {"importance":3,
                      "1500":5,
                      "6500":3,
                      "discrete":"False"
                }
        }';*/
        $json = '{"商品名稱":{
                    "importance":6,
                    "筆記型電腦":5,
                    "筆電":5,
                    "Notebook":4,
                    "NB":3,
                    "discrete":"True"
                  },
                  "重量":{
                    "importance":3,
                    "1200":6,
                    "1500":0,
                    "discrete":"False"
                  },
                  "價格":{
                    "importance":5,
                    "25000":6,
                    "37000":0,
                    "30000":4,
                    "discrete":"False"
                  },
                  "容量":{
                    "importance":5,
                    "256G":6,
                    "128G":4,
                    "discrete":"True"
                  }
                }';
  /**      $json = '{"商品名稱":{
                 "importance":6,
                 "asus":5,
                 "discrete":"True"}}';*/
        #$obj = json_decode($json, true);
        #var_dump(json_decode($json, true));

        #$ar = array('a'=>1,'b'=>2,'c'=>'gg','d'=>'yy');
        #$arg3 = json_encode($ar);

        $cmd = "$python $pyscript " . base64_encode($json);

        $output = shell_exec("$cmd");

        $result = json_decode(base64_decode($output));
        echo base64_decode($output);
    ?>
</body>
</html>
