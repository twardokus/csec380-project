# Basic unit test for the Hello World webpage

from bs4 import BeautifulSoup
import requests

def get_test_page():
    page = requests.get("http://localhost/")

    content = page.content

    soup = BeautifulSoup(content)

    target = soup.find_all("p")
    
    return target[0].contents[0]

def test_get_test_page():
    assert(get_test_page()== "Hello World")