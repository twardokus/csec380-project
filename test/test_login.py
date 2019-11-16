# Basic unit test for the Hello World webpage

from bs4 import BeautifulSoup
import requests
import time

def login():
	url = "http://localhost/loginvalidate.php"	
	validCreds = {'username':'admin@rit.edu','password':'password'}
	result = requests.post(url, validCreds, allow_redirects=True)

	return result

def test_login():
	loginResponse = login()
	#assert(loginResponse.status_code == 302)
	#assert(loginResponse.headers["Location"]) == "videos.php"
	assert(loginResponse.url == "http://localhost/videos.php")

def wait_for_docker_compose():
	failures = 0
	while failures < 10:
		try:
			home = requests.get("http://localhost", allow_redirects=True)
			break
		except:
			failures += 1
			time.sleep(30)	


def test_connection():
	home = requests.get("http://127.0.0.1:80", allow_redirects=True)
	assert(home != None)


wait_for_docker_compose()
test_connection()
test_login()

