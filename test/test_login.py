# Basic unit test for the Hello World webpage

from bs4 import BeautifulSoup
import requests

"""
def get_test_page():
    page = requests.get("http://localhost/")

    content = page.content

    soup = BeautifulSoup(content, "html.parser")

    target = soup.find_all("p")
    
    return target[0].contents[0]

def test_get_test_page():
    assert(get_test_page()== "Hello World")
"""

def login():
	url = "http://localhost/loginvalidate.php"	
	validCreds = {'username':'admin%40rit.edu','password':'password'}
	result = requests.post(url, validCreds)

	return result

def test_login():
	loginResponse = login()
	assert(loginResponse.status_code == 302)
	assert(loginResponse.headers["Location"] == "videos.php"
