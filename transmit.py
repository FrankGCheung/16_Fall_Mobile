from urllib import request,parse
import json
send_data = parse.urlencode([
    ('token','passwd'),
    ('sensor_1',90),
    ('sensor_2',91),
    ('sensor_3',93),
    ])
req = request.Request('http://119.29.87.174/downup.php')
with request.urlopen(req,data = send_data.encode(encoding='utf_8')) as f:
    recv_data = f.read().decode('utf_8')
sensor_state = json.loads(recv_data)
print(sensor_state)
switch_1 = sensor_state['switch_1']
switch_2 = sensor_state['switch_2']
