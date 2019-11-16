# Basic unit test for the Hello World webpage

from bs4 import BeautifulSoup
import requests
import time


def get_test_page():
    page = requests.get("http://localhost/")

    content = page.content

    soup = BeautifulSoup(content, "html.parser")

    target = soup.find_all("p")
    
    return target[0].contents[0]

def test_get_test_page():
    assert(get_test_page()== "Hello World")


def login():
	url = "http://localhost/loginvalidate.php"	
	validCreds = {'username':'admin%40rit.edu','password':'password'}
	result = requests.post(url, validCreds)

	return result

def test_login():
	loginResponse = login()
	assert(loginResponse.status_code == 302)
	assert(loginResponse.headers["Location"]) == "videos.php"



def wait_for_docker_compose():
	failures = 0
	while failures < 10:
		try:
			home = requests.get("http://localhost")
			break
		except:
			failures += 1
			time.sleep(30)	


def test_connection():
	home = requests.get("http://127.0.0.1:80")
	assert(home != None)


wait_for_docker_compose()
test_connection()
test_login()

