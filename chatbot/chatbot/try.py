import requests
r = requests.get('http://localhost:3000/getuser')
print(r.json())
'''
if r.json()['logged_in'] == 'no':
	print('nah mate')
else:
	print('yes mate')
'''
