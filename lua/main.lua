--必须在这个位置定义PROJECT和VERSION变量
--PROJECT：ascii string类型，可以随便定义，只要不使用,就行
--VERSION：ascii string类型，如果使用Luat物联云平台固件升级的功能，必须按照"X.X.X"定义，X表示1位数字；否则可随便定义
PROJECT = "MQTT"
VERSION = "1.0.0"

ddcid = "10001";
city  = "ningbo"


require"sys"

--[[
如果使用UART输出trace，打开这行注释的代码"--sys.opntrace(true,1)"即可，第2个参数1表示UART1输出trace，根据自己的需要修改这个参数
这里是最早可以设置trace口的地方，代码写在这里可以保证UART口尽可能的输出“开机就出现的错误信息”
如果写在后面的其他位置，很有可能无法输出错误信息，从而增加调试难度
]]
--sys.opntrace(true,1)

require"codes"

--S3开发板：硬件上已经打开了看门狗功能，使用S3开发板的用户，要打开这行注释的代码"--require"wdt""，否则4分钟左右会重启一次
require"wdt"

sys.init(0,0)
sys.run()